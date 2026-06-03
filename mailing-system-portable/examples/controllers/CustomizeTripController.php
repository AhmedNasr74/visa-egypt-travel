<?php

namespace App\Http\Controllers\Site;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\CustomizedTripAdminMail;
use App\Mail\CustomizedTripGuestMail;
use App\Models\CustomizedCategory;
use App\Models\CustomizedTrip;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CustomizeTripController extends Controller
{
    public function index(){
        $relations = [
            'Destinations' => CustomizedCategory::all(),
            'Country'=>Country::all()
        ];

        return view('site.customize_trip.index', compact('relations'));
    }



    public function store(Request $request)
    {
        try {
            $customizedTrip = CustomizedTrip::create($request->all());
            $destinations = $request->get('Destination', $request->get('Destinations', []));
            $customizedTrip->categories()->sync((array) $destinations);
            $customizedTrip->load('categories');

            $this->sendTripEmails($customizedTrip);

            session()->flash('message', 'CustomizedTrip Created Successfully!');
            session()->flash('type', 'success');
            return response()->json([
                    'message'=>'Your Customized Trip Created Successfully!',
                    'link'=>route('site.home')
            ]);
        } catch (Exception $exception) {
            report($exception);
            return response()->json([
                'm' => $exception->getMessage(),
                'error' => __('main.unexpected-error')
            ], 500);
        }

    }

    private function sendTripEmails(CustomizedTrip $customizedTrip): void
    {
        $trip = $customizedTrip->loadMissing('categories');
        $data = $this->buildTripEmailData($trip);

        $this->sendAdminTripEmail($trip, $data);
        $this->sendGuestTripEmail($trip, $data);
    }

    private function buildTripEmailData(CustomizedTrip $trip): array
    {
        $phone = trim(($trip->codePhone ? '+' . ltrim($trip->codePhone, '+') . ' ' : '') . $trip->phone);
        $destinations = $trip->categories->pluck('title')->filter()->implode(', ') ?: 'N/A';

        return [
            'request_id' => $trip->id,
            'name' => $trip->first_name ?? 'N/A',
            'email' => $trip->email ?? 'N/A',
            'phone' => $phone ?: 'N/A',
            'nationality' => $trip->nationality ?: 'N/A',
            'destinations' => $destinations,
            'date_type' => $trip->date_type ?: 'N/A',
            'date_from' => $trip->date_from ?: 'N/A',
            'date_to' => $trip->date_to ?: 'N/A',
            'month' => $trip->month ?: 'N/A',
            'days' => $trip->days ?: 'N/A',
            'adults' => $trip->adults ?? 0,
            'children' => $trip->child ?? 0,
            'infants' => $trip->infant ?? 0,
            'notes' => $trip->note ?: 'No notes',
        ];
    }

    private function sendAdminTripEmail(CustomizedTrip $trip, array $data): void
    {
        try {
            $recipients = EmailHelper::getNotificationRecipientEmails();
            Mail::to($recipients)->send(new CustomizedTripAdminMail($trip, $data));

            Log::info('Customize trip admin email sent', [
                'trip_id' => $trip->id,
                'recipients' => $recipients,
            ]);
        } catch (Exception $exception) {
            Log::error('Customize trip admin email failed: ' . $exception->getMessage(), [
                'trip_id' => $trip->id,
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }

    private function sendGuestTripEmail(CustomizedTrip $trip, array $data): void
    {
        $guestEmail = trim((string) ($trip->email ?? ''));

        if ($guestEmail === '' || !filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
            Log::warning('Customize trip guest email skipped: invalid address', [
                'trip_id' => $trip->id,
            ]);
            return;
        }

        try {
            Mail::to($guestEmail)->send(new CustomizedTripGuestMail($trip, $data));

            Log::info('Customize trip guest email sent', [
                'trip_id' => $trip->id,
                'guest_email' => $guestEmail,
            ]);
        } catch (Exception $exception) {
            Log::error('Customize trip guest email failed: ' . $exception->getMessage(), [
                'trip_id' => $trip->id,
                'guest_email' => $guestEmail,
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }


    public function show(CustomizedTrip $customizedTrip)
    {

        return view('dashboard.customized-trips.show', compact('customizedTrip'));

    }


}
