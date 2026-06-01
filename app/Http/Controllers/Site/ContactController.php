<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('site.contact.index');
    }
    
    public function store(Request $request){
        try {
            // Debug: Log the incoming request data
            \Log::info('Contact form data received:', $request->all());
            
            $validator = Validator::make($request->all(), [
                'name'=> 'required|string|max:255',
                'email'=> 'required|email|max:255',
                'phone'=> 'required|string|max:20',
                'subject'=> 'required|string|max:255',
                'message'=> 'required|string|max:1000',
                'type'=> 'nullable|string|max:50'
            ]);

            if ($validator->fails()) {
                \Log::error('Contact form validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }

            $data = $validator->validated();
            \Log::info('Contact form validated data:', $data);
            
            // Set default type if not provided
            if (!isset($data['type']) || empty($data['type'])) {
                $data['type'] = 'contact_form';
            }
            
            // Create contact record
            $contact = Contact::create($data);
            \Log::info('Contact record created successfully:', ['id' => $contact->id]);
            
            // Send confirmation email to client
            try {
                \Log::info('Starting client confirmation email process', [
                    'client_email' => $data['email'],
                    'contact_id' => $contact->id
                ]);
                
                Mail::to($data['email'])->send(new ContactUsMail($data, false));
                
                \Log::info('Client confirmation email sent successfully', [
                    'client_email' => $data['email'],
                    'contact_id' => $contact->id,
                    'email_sent_at' => now()->toDateTimeString()
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to send client confirmation email', [
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'client_email' => $data['email'],
                    'contact_id' => $contact->id,
                    'stack_trace' => $e->getTraceAsString()
                ]);
                // Don't fail the entire request if email fails
            }
            
            // Send notification email to admin
            try {
                \Log::info('Starting admin notification email process');
                
                // Get admin email from settings instead of user role
                $contactEmailSetting = setting('contact_email');
                $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
                
                \Log::info('Admin email lookup from settings', [
                    'contact_email_setting' => $contactEmailSetting,
                    'admin_email_extracted' => $adminEmail,
                    'admin_email_found' => !empty($adminEmail),
                    'contact_id' => $contact->id
                ]);
                
                if (!empty($adminEmail)) {
                    \Log::info('Sending admin notification email', [
                        'admin_email' => $adminEmail,
                        'contact_id' => $contact->id,
                        'email_subject' => 'New Contact Form Submission'
                    ]);
                    
                    Mail::to($adminEmail)->send(new ContactUsMail($data, true));
                    
                    \Log::info('Admin notification email sent successfully', [
                        'admin_email' => $adminEmail,
                        'contact_id' => $contact->id,
                        'email_sent_at' => now()->toDateTimeString()
                    ]);
                } else {
                    \Log::warning('No admin email found in settings', [
                        'setting_key' => 'contact_email',
                        'setting_value' => $contactEmailSetting,
                        'available_settings' => \App\Models\Setting::pluck('option_key')->toArray(),
                        'contact_id' => $contact->id
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send admin notification email', [
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'contact_id' => $contact->id,
                    'admin_email' => $adminEmail ?? 'No admin email found',
                    'stack_trace' => $e->getTraceAsString()
                ]);
                // Don't fail the entire request if email fails
            }
            
            return response()->json([
                'message' => "Your Request Sent To Us Successfully",
                'message2' => "We Will Call U Soon",
                'contact_id' => $contact->id
            ]);
            
        } catch (QueryException $exception) {
            \Log::error('Contact form submission error (QueryException): ' . $exception->getMessage());
            \Log::error('SQL: ' . $exception->getSql());
            \Log::error('Bindings: ' . json_encode($exception->getBindings()));
            return response()->json([
                'error' => __('main.unexpected-error')
            ], 500);
        } catch (\Exception $exception) {
            \Log::error('Contact form submission error (Exception): ' . $exception->getMessage());
            \Log::error('Stack trace: ' . $exception->getTraceAsString());
            return response()->json([
                'error' => __('main.unexpected-error')
            ], 500);
        }
    }
}
