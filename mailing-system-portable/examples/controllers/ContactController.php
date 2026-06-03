<?php

namespace App\Http\Controllers\Site;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormGuestMail;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact.index');
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'type' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $validator->errors()->first()], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $validator->validated();
            Contact::create($data);

            $this->sendContactEmails($data);

            $successMessage = 'Your request was sent successfully! We will contact you soon.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $successMessage]);
            }

            return redirect()->route('site.contact')
                ->with('success', $successMessage);
        } catch (QueryException $exception) {
            report($exception);

            if ($request->expectsJson()) {
                return response()->json(['error' => __('main.unexpected-error')], 500);
            }

            return redirect()->back()
                ->with('error', __('main.unexpected-error'))
                ->withInput();
        } catch (Exception $exception) {
            Log::error('Contact form failed: ' . $exception->getMessage(), [
                'trace' => $exception->getTraceAsString(),
            ]);

            if ($request->expectsJson()) {
                return response()->json(['error' => __('main.unexpected-error')], 500);
            }

            return redirect()->route('site.contact')
                ->with('success', 'Your request was sent successfully! We will contact you soon.');
        }
    }

    private function sendContactEmails(array $data): void
    {
        $isBooking = EmailHelper::isBookingInquiry($data['type']);
        $mailType = $isBooking ? 'booking' : 'contact';

        $this->sendAdminContactEmail($data, $mailType);
        $this->sendGuestContactEmail($data, $isBooking);
    }

    private function sendAdminContactEmail(array $data, string $mailType): void
    {
        try {
            $recipients = EmailHelper::getNotificationRecipientEmails();
            Mail::to($recipients)->send(new ContactFormMail($data, $mailType));

            Log::info('Contact form admin email sent', [
                'recipients' => $recipients,
                'type' => $data['type'] ?? null,
            ]);
        } catch (Exception $exception) {
            Log::error('Contact form admin email failed: ' . $exception->getMessage(), [
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }

    private function sendGuestContactEmail(array $data, bool $isBooking): void
    {
        $guestEmail = trim((string) ($data['email'] ?? ''));

        if ($guestEmail === '' || !filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        try {
            Mail::to($guestEmail)->send(new ContactFormGuestMail($data, $isBooking));

            Log::info('Contact form guest email sent', ['guest_email' => $guestEmail]);
        } catch (Exception $exception) {
            Log::error('Contact form guest email failed: ' . $exception->getMessage(), [
                'guest_email' => $guestEmail,
            ]);
        }
    }
}
