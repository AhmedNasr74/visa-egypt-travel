<?php

namespace App\Http\Controllers\Site;

use App\Enums\SettingKey;
use App\Http\Controllers\Controller;
use App\Mail\TailorMadeMail;
use App\Models\Destination;
use App\Services\DualEmailSender;
use App\Support\SiteSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourTailorController extends Controller
{

    public function index()
    {
        $destinations = Destination::all();
        SiteSeo::publishPage(__('site.tour_tailor'), 'Create your custom Egypt tour itinerary with ' . SiteSeo::siteName() . '.');

        return view('site.tour_tailor.index', compact('destinations'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nickname' => ['required', 'string', 'max:10'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
                'country_phone_code' => ['required', 'string', 'max:5'],
                'budget' => ['required', 'string', 'max:255'],
                'notes' => ['nullable', 'string', 'max:1000'],
                'nationality' => ['required', 'string', 'max:100'],
                'adults' => ['required', 'integer', 'min:1', 'max:100'],
                'children' => ['required', 'integer', 'min:0', 'max:100'],
                'infants' => ['required', 'integer', 'min:0', 'max:100'],
                'arrival_date' => ['required', 'string'], // Changed from date to string
                'departure_date' => ['required', 'string'], // Changed from date to string
                'destinations' => ['required', 'array', 'min:1'],
                'destinations.*' => ['string', 'max:255'],
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $data = $validator->validated();
            
            // Validate dates manually if they are provided
            if (!empty($data['arrival_date'])) {
                $arrivalDate = \DateTime::createFromFormat('Y-m-d', $data['arrival_date']);
                if (!$arrivalDate || $arrivalDate->format('Y-m-d') !== $data['arrival_date']) {
                    return response()->json(['error' => 'Invalid arrival date format.'], 422);
                }
                if ($arrivalDate < new \DateTime('today')) {
                    return response()->json(['error' => 'Arrival date must be today or in the future.'], 422);
                }
            }
            
            if (!empty($data['departure_date'])) {
                $departureDate = \DateTime::createFromFormat('Y-m-d', $data['departure_date']);
                if (!$departureDate || $departureDate->format('Y-m-d') !== $data['departure_date']) {
                    return response()->json(['error' => 'Invalid departure date format.'], 422);
                }
                
                if (!empty($data['arrival_date'])) {
                    $arrivalDate = \DateTime::createFromFormat('Y-m-d', $data['arrival_date']);
                    if ($departureDate <= $arrivalDate) {
                        return response()->json(['error' => 'Departure date must be after arrival date.'], 422);
                    }
                }
            }
            
            // Format the data for email
            $formData = [
                'name' => $data['nickname'] . '. ' . $data['name'],
                'email' => $data['email'],
                'phone' => '(' . $data['country_phone_code'] . ') ' . $data['phone'],
                'nationality' => $data['nationality'],
                'destination' => implode(', ', $data['destinations']),
                'duration' => 'From ' . $data['arrival_date'] . ' to ' . $data['departure_date'],
                'adults' => $data['adults'],
                'children' => $data['children'],
                'infants' => $data['infants'],
                'budget' => $data['budget'],
                'travel_date' => $data['arrival_date'],
                'requirements' => $data['notes'] ?? 'No special requirements specified.'
            ];

            DualEmailSender::sendGuest(
                $data['email'],
                new TailorMadeMail($formData, false),
                'tailor_made',
                ['email' => $data['email']]
            );

            DualEmailSender::sendAdmin(
                new TailorMadeMail($formData, true),
                'tailor_made',
                ['email' => $data['email']]
            );

            return response()->json(['message' => __('main.your-request-have-been-sent')]);
            
        } catch (\Exception $exception) {
            \Log::error('Tailor made form submission error: ' . $exception->getMessage());
            return response()->json([
                'error' => __('main.unexpected-error')
            ], 500);
        }
    }
}
