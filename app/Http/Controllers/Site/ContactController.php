<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\Contact;
use App\Services\DualEmailSender;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact.index');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'type' => 'nullable|string|max:50',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first(),
                ], 422);
            }

            $data = $validator->validated();
            if (!isset($data['type']) || $data['type'] === '') {
                $data['type'] = 'contact_form';
            }

            $contact = Contact::create($data);

            DualEmailSender::sendGuest(
                $data['email'],
                new ContactUsMail($data, false),
                'contact_form',
                ['contact_id' => $contact->id]
            );

            DualEmailSender::sendAdmin(
                new ContactUsMail($data, true),
                'contact_form',
                ['contact_id' => $contact->id, 'type' => $data['type']]
            );

            return response()->json([
                'message' => 'Your Request Sent To Us Successfully',
                'message2' => 'We Will Call U Soon',
                'contact_id' => $contact->id,
            ]);
        } catch (QueryException $exception) {
            Log::error('Contact form submission error (QueryException): ' . $exception->getMessage());

            return response()->json([
                'error' => __('main.unexpected-error'),
            ], 500);
        } catch (\Exception $exception) {
            Log::error('Contact form submission error: ' . $exception->getMessage());

            return response()->json([
                'error' => __('main.unexpected-error'),
            ], 500);
        }
    }
}
