<?php

use App\Http\Controllers\ProfileController;
use App\Mail\BookingSuccessMail;
use App\Mail\BookingAdminMail;
use App\Mail\TailorMadeMail;
use App\Mail\ContactUsMail;
use App\Mail\CustomizeTripMail;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';


Route::get('/dashboard', function () {
    return view('dashboard.home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Test routes for email functionality
Route::get('/test/booking-success/{id}', function ($id) {
    $booking = Booking::with('tour')->findOrFail($id);
    $admin = User::role('Administrator')->first();
    
    // Send confirmation email to client
    Mail::to($booking->email)->send(new BookingSuccessMail($booking));
    
    // Send notification email to admin
    if ($admin) {
        Mail::to($admin->email)->send(new BookingAdminMail($booking));
    }
    
    return response()->json([
        'message' => 'Booking success emails sent successfully!',
        'client_email' => $booking->email,
        'admin_email' => $admin ? $admin->email : 'No admin found'
    ]);
})->name('test.booking.success');

Route::get('/test/tailor-made', function () {
    $formData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+1234567890',
        'nationality' => 'American',
        'destination' => 'Egypt',
        'duration' => '7 days',
        'adults' => 2,
        'children' => 1,
        'budget' => 5000,
        'travel_date' => '2024-06-15',
        'requirements' => 'We would like to visit the pyramids and take a Nile cruise.'
    ];
    
    $admin = User::role('Administrator')->first();
    
    // Send confirmation email to client
    Mail::to($formData['email'])->send(new TailorMadeMail($formData, false));
    
    // Send notification email to admin
    if ($admin) {
        Mail::to($admin->email)->send(new TailorMadeMail($formData, true));
    }
    
    return response()->json([
        'message' => 'Tailor made emails sent successfully!',
        'client_email' => $formData['email'],
        'admin_email' => $admin ? $admin->email : 'No admin found'
    ]);
})->name('test.tailor.made');

Route::get('/test/contact-us', function () {
    $formData = [
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
        'phone' => '+1987654321',
        'subject' => 'General Inquiry',
        'message' => 'I would like to know more about your tour packages and pricing.',
        'additional_info' => 'I am planning a family trip for next summer.'
    ];
    
    $admin = User::role('Administrator')->first();
    
    // Send confirmation email to client
    Mail::to($formData['email'])->send(new ContactUsMail($formData, false));
    
    // Send notification email to admin
    if ($admin) {
        Mail::to($admin->email)->send(new ContactUsMail($formData, true));
    }
    
    return response()->json([
        'message' => 'Contact us emails sent successfully!',
        'client_email' => $formData['email'],
        'admin_email' => $admin ? $admin->email : 'No admin found'
    ]);
})->name('test.contact.us');

// Test route for contact form functionality
Route::get('/test/contact-form', function () {
    try {
        // Test database connection
        $contact = new \App\Models\Contact();
        $contact->name = 'Test User';
        $contact->email = 'test@example.com';
        $contact->phone = '+1234567890';
        $contact->subject = 'Test Subject';
        $contact->message = 'Test message';
        $contact->type = 'test';
        $contact->save();
        
        // Test settings
        $settings = \App\Models\Setting::pluck('option_value', 'option_key')->toArray();
        
        // Test admin user
        $admin = \App\Models\User::role('Administrator')->first();
        
        return response()->json([
            'message' => 'Contact form test successful!',
            'database' => 'Connected',
            'contact_created' => $contact->id,
            'settings_count' => count($settings),
            'admin_found' => $admin ? 'Yes' : 'No',
            'admin_email' => $admin ? $admin->email : 'No admin found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Contact form test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.contact.form');

// Simple test route for contact form submission
Route::post('/test/contact-submit', function (Request $request) {
    try {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'phone'=> 'required|string|max:20',
            'subject'=> 'required|string|max:255',
            'message'=> 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        $data['type'] = 'contact_form';
        
        // Create contact record
        $contact = \App\Models\Contact::create($data);
        
        return response()->json([
            'message' => "Your Request Sent To Us Successfully",
            'message2' => "We Will Call U Soon",
            'contact_id' => $contact->id
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Contact form submission failed: ' . $e->getMessage()
        ], 500);
    }
})->name('test.contact.submit');

// Test route for tailor made form functionality
Route::post('/test/tailor-submit', function (Request $request) {
    try {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
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
            'arrival_date' => ['required', 'string'],
            'departure_date' => ['required', 'string'],
            'destinations' => ['required', 'array', 'min:1'],
            'destinations.*' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Test admin user
        $admin = \App\Models\User::role('Administrator')->first();
        
        return response()->json([
            'message' => 'Tailor made form test successful!',
            'data_received' => $data,
            'admin_found' => $admin ? 'Yes' : 'No',
            'admin_email' => $admin ? $admin->email : 'No admin found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Tailor made form test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.tailor.submit');

// Test route for customize trip form functionality
Route::post('/test/customize-trip-submit', function (Request $request) {
    try {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'codePhone' => ['required', 'string', 'max:5'],
            'nationality' => ['required', 'string', 'max:100'],
            'date_from' => ['required', 'string'],
            'date_to' => ['required', 'string'],
            'adults' => ['required', 'integer', 'min:1', 'max:100'],
            'child' => ['required', 'integer', 'min:0', 'max:100'],
            'infant' => ['required', 'integer', 'min:0', 'max:100'],
            'note' => ['required', 'string', 'max:1000'],
            'request' => ['nullable', 'string', 'max:255'],
            'age_range' => ['nullable', 'string', 'max:50'],
            'travel_to' => ['required', 'string', 'max:255'],
            'accommodation_choices' => ['required', 'string', 'max:255'],
            'how_did_you_hear_about_us' => ['required', 'string', 'max:255'],
            'children_ages' => ['nullable', 'array'],
            'children_ages.*' => ['integer', 'min:0', 'max:17'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Test admin user
        $admin = \App\Models\User::role('Administrator')->first();
        
        return response()->json([
            'message' => 'Customize trip form test successful!',
            'data_received' => $data,
            'admin_found' => $admin ? 'Yes' : 'No',
            'admin_email' => $admin ? $admin->email : 'No admin found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Customize trip form test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.customize.trip.submit');

// Simple test route for customize trip form submission
Route::post('/test/customize-trip-simple', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Test customize trip form data:', $request->all());
        
        // Test basic validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'codePhone' => 'required|string',
            'nationality' => 'required|string',
            'date_from' => 'required|string',
            'date_to' => 'required|string',
            'adults' => 'required|integer',
            'child' => 'required|integer',
            'infant' => 'required|integer',
            'note' => 'required|string',
            'travel_to' => 'required|string',
            'accommodation_choices' => 'required|string',
            'how_did_you_hear_about_us' => 'required|string',
            'children_ages' => 'nullable|array',
            'children_ages.*' => 'nullable|numeric|min:0|max:17',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Convert children_ages strings to integers
        if (isset($data['children_ages']) && is_array($data['children_ages'])) {
            $data['children_ages'] = array_map('intval', $data['children_ages']);
        }
        
        // Test model creation
        try {
            $trip = \App\Models\CustomizedTrip::create([
                'first_name' => $data['first_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'codePhone' => $data['codePhone'],
                'nationality' => $data['nationality'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
                'adults' => $data['adults'],
                'child' => $data['child'],
                'infant' => $data['infant'],
                'note' => $data['note'],
                'destination' => $data['travel_to'],
                'travel_to' => $data['travel_to'],
                'accommodation_choices' => $data['accommodation_choices'],
                'how_did_you_hear_about_us' => $data['how_did_you_hear_about_us'],
                'days' => 1,
                'date_type' => 'exact', // Add the missing date_type field
            ]);
            
            return response()->json([
                'message' => 'Test successful! Trip created with ID: ' . $trip->id,
                'trip_id' => $trip->id
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Model creation failed: ' . $e->getMessage()
            ], 500);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Test failed: ' . $e->getMessage()
        ], 500);
    }
})->name('test.customize.trip.simple');

// Test route to send emails to bedo67444@gmail.com
Route::get('/test/email-to-bedo', function () {
    try {
        // Test basic mail functionality
        \Mail::raw('Test email from Laravel - Basic functionality test', function($message) {
            $message->to('bedo67444@gmail.com')->subject('Test Email - Basic Functionality');
        });
        
        // Test TailorMadeMail
        $formData = [
            'name' => 'Test User',
            'email' => 'bedo67444@gmail.com',
            'phone' => '(+1) 1234567890',
            'nationality' => 'Test Nationality',
            'destination' => 'Test Destination',
            'duration' => '7 days',
            'adults' => 2,
            'children' => 1,
            'infants' => 0,
            'budget' => 'Test Budget',
            'travel_date' => '2024-12-01',
            'requirements' => 'Test requirements for bedo67444@gmail.com'
        ];
        
        // Send client confirmation email
        \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\TailorMadeMail($formData, false));
        
        // Send admin notification email
        $admin = \App\Models\User::role('Administrator')->first();
        if ($admin) {
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\TailorMadeMail($formData, true));
        }
        
        return response()->json([
            'message' => 'Test emails sent successfully to bedo67444@gmail.com',
            'emails_sent' => [
                'basic_test' => 'Test Email - Basic Functionality',
                'client_confirmation' => 'Your Tailor Made Tour Request Received',
                'admin_notification' => 'New Tailor Made Tour Request'
            ],
            'admin_found' => $admin ? 'Yes - ' . $admin->email : 'No admin found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Email test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.email.to.bedo');

// Test route for customize trip with email to bedo67444@gmail.com
Route::post('/test/customize-trip-with-email', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Customize trip test with email data:', $request->all());
        
        // Test validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'codePhone' => 'required|string',
            'nationality' => 'required|string',
            'date_from' => 'required|string',
            'date_to' => 'required|string',
            'adults' => 'required|integer',
            'child' => 'required|integer',
            'infant' => 'required|integer',
            'note' => 'required|string',
            'travel_to' => 'required|string',
            'accommodation_choices' => 'required|string',
            'how_did_you_hear_about_us' => 'required|string',
            'children_ages' => 'nullable|array',
            'children_ages.*' => 'nullable|numeric|min:0|max:17',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Convert children_ages strings to integers
        if (isset($data['children_ages']) && is_array($data['children_ages'])) {
            $data['children_ages'] = array_map('intval', $data['children_ages']);
        }
        
        // Create the trip
        $trip = \App\Models\CustomizedTrip::create([
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'codePhone' => $data['codePhone'],
            'nationality' => $data['nationality'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
            'adults' => $data['adults'],
            'child' => $data['child'],
            'infant' => $data['infant'],
            'note' => $data['note'],
            'destination' => $data['travel_to'],
            'travel_to' => $data['travel_to'],
            'accommodation_choices' => $data['accommodation_choices'],
            'how_did_you_hear_about_us' => $data['how_did_you_hear_about_us'],
            'days' => \Carbon\Carbon::parse($data['date_from'])->diffInDays($data['date_to']) + 1,
            'date_type' => 'exact', // Add the missing date_type field
        ]);
        
        // Format data for email
        $formData = [
            'name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => '(' . $data['codePhone'] . ') ' . $data['phone'],
            'nationality' => $data['nationality'],
            'destination' => $data['travel_to'],
            'duration' => \Carbon\Carbon::parse($data['date_from'])->diffInDays($data['date_to']) + 1 . ' days',
            'adults' => $data['adults'],
            'children' => $data['child'],
            'infants' => $data['infant'],
            'budget' => $data['accommodation_choices'],
            'travel_date' => $data['date_from'],
            'requirements' => $data['note']
        ];
        
        // Send emails to bedo67444@gmail.com
        try {
            \Log::info('Starting test email sending process', [
                'test_type' => 'customize_trip_with_email',
                'trip_id' => $trip->id,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\CustomizeTripMail($formData, false));
            \Log::info('Test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for test email', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\CustomizeTripMail($formData, true, $trip->id));
                \Log::info('Test admin notification email sent successfully');
            }
            
            \Log::info('Test email process completed successfully', [
                'trip_id' => $trip->id,
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Customize trip created and emails sent successfully to bedo67444@gmail.com',
                'trip_id' => $trip->id,
                'emails_sent' => [
                    'client_confirmation' => 'Your Customized Trip Request Confirmation',
                    'admin_notification' => 'New Customized Trip Request Received'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trip_id' => $trip->id,
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Trip created but email failed: ' . $e->getMessage(),
                'trip_id' => $trip->id
            ], 200);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.customize.trip.with.email');

// Test route to verify dashboard link
Route::get('/test/dashboard-link/{id}', function ($id) {
    try {
        $trip = \App\Models\CustomizedTrip::findOrFail($id);
        
        return response()->json([
            'message' => 'Trip found successfully',
            'trip_id' => $trip->id,
            'trip_details' => [
                'name' => $trip->first_name,
                'email' => $trip->email,
                'destination' => $trip->destination,
                'date_from' => $trip->date_from,
                'date_to' => $trip->date_to,
            ],
            'dashboard_link' => url('/dashboard/customized-trips/' . $trip->id),
            'admin_email' => \App\Models\User::role('Administrator')->first()->email ?? 'No admin found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Trip not found: ' . $e->getMessage()
        ], 404);
    }
})->name('test.dashboard.link');

// Simple test route without CSRF protection for testing
Route::post('/test/customize-trip-no-csrf', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Test customize trip form data (no CSRF):', $request->all());
        
        // Test basic validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'codePhone' => 'required|string',
            'nationality' => 'required|string',
            'date_from' => 'required|string',
            'date_to' => 'required|string',
            'adults' => 'required|integer',
            'child' => 'required|integer',
            'infant' => 'required|integer',
            'note' => 'required|string',
            'travel_to' => 'required|string',
            'accommodation_choices' => 'required|string',
            'how_did_you_hear_about_us' => 'required|string',
            'children_ages' => 'nullable|array',
            'children_ages.*' => 'nullable|numeric|min:0|max:17',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Convert children_ages strings to integers
        if (isset($data['children_ages']) && is_array($data['children_ages'])) {
            $data['children_ages'] = array_map('intval', $data['children_ages']);
        }
        
        // Create the trip
        $trip = \App\Models\CustomizedTrip::create([
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'codePhone' => $data['codePhone'],
            'nationality' => $data['nationality'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
            'adults' => $data['adults'],
            'child' => $data['child'],
            'infant' => $data['infant'],
            'note' => $data['note'],
            'destination' => $data['travel_to'],
            'travel_to' => $data['travel_to'],
            'accommodation_choices' => $data['accommodation_choices'],
            'how_did_you_hear_about_us' => $data['how_did_you_hear_about_us'],
            'days' => \Carbon\Carbon::parse($data['date_from'])->diffInDays($data['date_to']) + 1,
            'date_type' => 'exact',
        ]);
        
        // Format data for email
        $formData = [
            'name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => '(' . $data['codePhone'] . ') ' . $data['phone'],
            'nationality' => $data['nationality'],
            'destination' => $data['travel_to'],
            'duration' => \Carbon\Carbon::parse($data['date_from'])->diffInDays($data['date_to']) + 1 . ' days',
            'adults' => $data['adults'],
            'children' => $data['child'],
            'infants' => $data['infant'],
            'budget' => $data['accommodation_choices'],
            'travel_date' => $data['date_from'],
            'requirements' => $data['note']
        ];
        
        // Send emails to bedo67444@gmail.com
        try {
            \Log::info('Starting no-CSRF test email sending process', [
                'test_type' => 'customize_trip_no_csrf',
                'trip_id' => $trip->id,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending no-CSRF test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\CustomizeTripMail($formData, false));
            \Log::info('No-CSRF test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for no-CSRF test email', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending no-CSRF test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\CustomizeTripMail($formData, true, $trip->id));
                \Log::info('No-CSRF test admin notification email sent successfully');
            }
            
            \Log::info('No-CSRF test email process completed successfully', [
                'trip_id' => $trip->id,
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Customize trip created and emails sent successfully to bedo67444@gmail.com (No CSRF)',
                'trip_id' => $trip->id,
                'emails_sent' => [
                    'client_confirmation' => 'Your Customized Trip Request Confirmation',
                    'admin_notification' => 'New Customized Trip Request Received'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('No-CSRF test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trip_id' => $trip->id,
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Trip created but email failed: ' . $e->getMessage(),
                'trip_id' => $trip->id
            ], 200);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.customize.trip.no.csrf');

// Test route for Microsoft Graph API email functionality
Route::get('/test/microsoft-graph-email', function () {
    try {
        // Test basic Microsoft Graph mail functionality
        \Log::info('Testing Microsoft Graph API email functionality');
        
        // Test simple email
        \Mail::raw('Test email from Laravel using Microsoft Graph API', function($message) {
            $message->to('bedo67444@gmail.com')->subject('Test Email - Microsoft Graph API');
        });
        
        // Test with one of our Mailable classes
        $formData = [
            'name' => 'Test User',
            'email' => 'bedo67444@gmail.com',
            'phone' => '(+1) 1234567890',
            'nationality' => 'Test Nationality',
            'destination' => 'Test Destination',
            'duration' => '7 days',
            'adults' => 2,
            'children' => 1,
            'infants' => 0,
            'budget' => 'Test Budget',
            'travel_date' => '2024-12-01',
            'requirements' => 'Test requirements for Microsoft Graph API'
        ];
        
        // Test with CustomizeTripMail
        \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\CustomizeTripMail($formData, false));
        
        return response()->json([
            'message' => 'Microsoft Graph API email test successful!',
            'emails_sent' => [
                'basic_test' => 'Test Email - Microsoft Graph API',
                'mailable_test' => 'Your Customized Trip Request Confirmation'
            ],
            'mail_driver' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'microsoft_graph_configured' => !empty(config('mail.mailers.microsoft-graph.client_id'))
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Microsoft Graph API email test failed', [
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'stack_trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'error' => 'Microsoft Graph API email test failed: ' . $e->getMessage(),
            'mail_driver' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'microsoft_graph_configured' => !empty(config('mail.mailers.microsoft-graph.client_id')),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.microsoft.graph.email');

// Test route to check Microsoft Graph configuration
Route::get('/test/microsoft-graph-config', function () {
    try {
        $config = [
            'mail_driver' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'microsoft_graph_configured' => !empty(config('mail.mailers.microsoft-graph.client_id')),
            'client_id_set' => !empty(config('mail.mailers.microsoft-graph.client_id')),
            'client_secret_set' => !empty(config('mail.mailers.microsoft-graph.client_secret')),
            'tenant_id_set' => !empty(config('mail.mailers.microsoft-graph.tenant_id')),
            'mailers_available' => array_keys(config('mail.mailers')),
            'env_variables' => [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'MICROSOFT_GRAPH_CLIENT_ID' => env('MICROSOFT_GRAPH_CLIENT_ID') ? 'SET' : 'NOT SET',
                'MICROSOFT_GRAPH_CLIENT_SECRET' => env('MICROSOFT_GRAPH_CLIENT_SECRET') ? 'SET' : 'NOT SET',
                'MICROSOFT_GRAPH_TENANT_ID' => env('MICROSOFT_GRAPH_TENANT_ID') ? 'SET' : 'NOT SET',
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
            ]
        ];
        
        return response()->json([
            'message' => 'Microsoft Graph configuration check',
            'configuration' => $config,
            'status' => $config['microsoft_graph_configured'] ? 'CONFIGURED' : 'NOT CONFIGURED'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Configuration check failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.microsoft.graph.config');

// Test route for Contact Us email functionality with Microsoft Graph API
Route::get('/test/contact-us-email', function () {
    try {
        // Test Contact Us email functionality
        \Log::info('Testing Contact Us email functionality with Microsoft Graph API');
        
        $formData = [
            'name' => 'Test Contact User',
            'email' => 'bedo67444@gmail.com',
            'phone' => '(+1) 1234567890',
            'subject' => 'Test Contact Form Submission',
            'message' => 'This is a test message from the Contact Us form to verify Microsoft Graph API email functionality.',
            'type' => 'contact_form'
        ];
        
        // Test client confirmation email
        \Log::info('Sending Contact Us client confirmation email');
        \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\ContactUsMail($formData, false));
        \Log::info('Contact Us client confirmation email sent successfully');
        
        // Test admin notification email
        $contactEmailSetting = setting('contact_email');
        $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
        \Log::info('Admin email lookup for Contact Us test', [
            'contact_email_setting' => $contactEmailSetting,
            'admin_email_extracted' => $adminEmail,
            'admin_email_found' => !empty($adminEmail)
        ]);
        
        if (!empty($adminEmail)) {
            \Log::info('Sending Contact Us admin notification email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\ContactUsMail($formData, true));
            \Log::info('Contact Us admin notification email sent successfully');
        }
        
        return response()->json([
            'message' => 'Contact Us email test successful with Microsoft Graph API!',
            'emails_sent' => [
                'client_confirmation' => 'Thank You for Contacting Us',
                'admin_notification' => 'New Contact Form Submission'
            ],
            'form_data' => $formData,
            'mail_driver' => config('mail.default'),
            'admin_email_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Contact Us email test failed', [
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'stack_trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'error' => 'Contact Us email test failed: ' . $e->getMessage(),
            'mail_driver' => config('mail.default'),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.contact.us.email');

// Test route for Contact Us form submission with database
Route::post('/test/contact-us-submit', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Contact Us form submission test data:', $request->all());
        
        // Test validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'type' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Set default type if not provided
        if (!isset($data['type']) || empty($data['type'])) {
            $data['type'] = 'contact_form';
        }
        
        // Create contact record
        $contact = \App\Models\Contact::create($data);
        \Log::info('Contact record created for test', ['id' => $contact->id]);
        
        // Send emails to bedo67444@gmail.com for testing
        try {
            \Log::info('Starting Contact Us test email sending process', [
                'test_type' => 'contact_us_submit',
                'contact_id' => $contact->id,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending Contact Us test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\ContactUsMail($data, false));
            \Log::info('Contact Us test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for Contact Us test', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending Contact Us test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\ContactUsMail($data, true));
                \Log::info('Contact Us test admin notification email sent successfully');
            }
            
            \Log::info('Contact Us test email process completed successfully', [
                'contact_id' => $contact->id,
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Contact Us form submitted and emails sent successfully to bedo67444@gmail.com',
                'contact_id' => $contact->id,
                'emails_sent' => [
                    'client_confirmation' => 'Thank You for Contacting Us',
                    'admin_notification' => 'New Contact Form Submission'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Contact Us test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'contact_id' => $contact->id,
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Contact record created but email failed: ' . $e->getMessage(),
                'contact_id' => $contact->id
            ], 200);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Contact Us test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.contact.us.submit');

// Test route for Book This Tour form
Route::post('/test/book-tour', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Book This Tour form test data:', $request->all());
        
        // Test validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'date' => 'required|string|date|after_or_equal:today',
            'notes' => 'nullable|string',
            'nationality' => 'nullable|string',
            'tour_id' => 'required|integer|exists:tours,id',
            'accommodation_type' => 'nullable|string',
            'price_category' => 'nullable|string',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Create a mock booking for testing
        $booking = new \App\Models\Booking();
        $booking->id = 999;
        $booking->name = $data['name'];
        $booking->email = $data['email'];
        $booking->phone = $data['phone'];
        $booking->date = $data['date'];
        $booking->nationality = $data['nationality'] ?? 'Test Nationality';
        $booking->tour_id = $data['tour_id'];
        $booking->adults_count = $data['adults'];
        $booking->children_count = $data['children'];
        $booking->total_price = ($data['adults'] * 100) + ($data['children'] * 50);
        $booking->notes = $data['notes'] ?? 'Test booking notes';
        
        // Send emails to bedo67444@gmail.com for testing
        try {
            \Log::info('Starting Book This Tour test email sending process', [
                'test_type' => 'book_tour',
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending Book This Tour test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\BookingSuccessMail($booking));
            \Log::info('Book This Tour test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for Book This Tour test', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending Book This Tour test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\BookingAdminMail($booking));
                \Log::info('Book This Tour test admin notification email sent successfully');
            }
            
            \Log::info('Book This Tour test email process completed successfully', [
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Book This Tour test successful! Emails sent to bedo67444@gmail.com',
                'emails_sent' => [
                    'client_confirmation' => 'Your Tour Booking is Confirmed!',
                    'admin_notification' => 'New Tour Booking Received'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Book This Tour test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Email test failed: ' . $e->getMessage()
            ], 500);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Book This Tour test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.book.tour');

// Test route for Plan your trip with CrocoNileEgypt form
Route::post('/test/plan-trip', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Plan your trip form test data:', $request->all());
        
        // Test validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nickname' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date',
            'notes' => 'nullable|string',
            'nationality' => 'required',
            'hotel_choice' => 'required',
            'age_range' => 'required',
            'hear_about_us' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Create appointment record
        $appointment = \App\Models\Appointment::create($data);
        \Log::info('Plan your trip appointment created for test', ['id' => $appointment->id]);
        
        // Send emails to bedo67444@gmail.com for testing
        try {
            \Log::info('Starting Plan your trip test email sending process', [
                'test_type' => 'plan_trip',
                'appointment_id' => $appointment->id,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending Plan your trip test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\AppointmentMail($data, false, 'appointment'));
            \Log::info('Plan your trip test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for Plan your trip test', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending Plan your trip test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\AppointmentMail($data, true, 'appointment'));
                \Log::info('Plan your trip test admin notification email sent successfully');
            }
            
            \Log::info('Plan your trip test email process completed successfully', [
                'appointment_id' => $appointment->id,
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Plan your trip test successful! Emails sent to bedo67444@gmail.com',
                'appointment_id' => $appointment->id,
                'emails_sent' => [
                    'client_confirmation' => 'Thank You for Your Appointment Request',
                    'admin_notification' => 'New Appointment Request Received'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Plan your trip test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'appointment_id' => $appointment->id,
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Appointment created but email failed: ' . $e->getMessage(),
                'appointment_id' => $appointment->id
            ], 200);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Plan your trip test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.plan.trip');

// Test route for Customize Your Nile River Cruise form
Route::post('/test/nile-cruise', function (Request $request) {
    try {
        // Log the incoming data
        \Log::info('Nile River Cruise form test data:', $request->all());
        
        // Test validation
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nickname' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date',
            'notes' => 'nullable|string',
            'nationality' => 'required',
            'hotel_choice' => 'required',
            'age_range' => 'required',
            'hear_about_us' => 'required',
            // Nile Cruise specific fields
            'cruise_type' => 'nullable|array',
            'cruise_type.*' => 'nullable|string',
            'cruise_pick_drop_off' => 'nullable|array',
            'cruise_pick_drop_off.*' => 'nullable|string',
            'cruise_duration' => 'nullable|array',
            'cruise_duration.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed: ' . $validator->errors()->first()
            ], 422);
        }

        $data = $validator->validated();
        
        // Process array fields for Nile Cruise
        $data['cruise_type'] = is_array($data['cruise_type']) ? implode(', ', array_filter($data['cruise_type'])) : $data['cruise_type'];
        $data['cruise_pick_drop_off'] = is_array($data['cruise_pick_drop_off']) ? implode(', ', array_filter($data['cruise_pick_drop_off'])) : $data['cruise_pick_drop_off'];
        $data['cruise_duration'] = is_array($data['cruise_duration']) ? implode(', ', array_filter($data['cruise_duration'])) : $data['cruise_duration'];
        
        // Create appointment record
        $appointment = \App\Models\Appointment::create($data);
        \Log::info('Nile River Cruise appointment created for test', ['id' => $appointment->id]);
        
        // Send emails to bedo67444@gmail.com for testing
        try {
            \Log::info('Starting Nile River Cruise test email sending process', [
                'test_type' => 'nile_cruise',
                'appointment_id' => $appointment->id,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            // Send client confirmation
            \Log::info('Sending Nile River Cruise test client confirmation email');
            \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\AppointmentMail($data, false, 'nile_cruise'));
            \Log::info('Nile River Cruise test client confirmation email sent successfully');
            
            // Send admin notification
            $contactEmailSetting = setting('contact_email');
            $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
            \Log::info('Admin email lookup for Nile River Cruise test', [
                'contact_email_setting' => $contactEmailSetting,
                'admin_email_extracted' => $adminEmail,
                'admin_email_found' => !empty($adminEmail)
            ]);
            
            if (!empty($adminEmail)) {
                \Log::info('Sending Nile River Cruise test admin notification email');
                \Mail::to('bedo67444@gmail.com')->send(new \App\Mail\AppointmentMail($data, true, 'nile_cruise'));
                \Log::info('Nile River Cruise test admin notification email sent successfully');
            }
            
            \Log::info('Nile River Cruise test email process completed successfully', [
                'appointment_id' => $appointment->id,
                'emails_sent' => 2,
                'target_email' => 'bedo67444@gmail.com'
            ]);
            
            return response()->json([
                'message' => 'Nile River Cruise test successful! Emails sent to bedo67444@gmail.com',
                'appointment_id' => $appointment->id,
                'emails_sent' => [
                    'client_confirmation' => 'Thank You for Your Nile Cruise Request',
                    'admin_notification' => 'New Nile Cruise Request Received'
                ],
                'admin_found' => !empty($adminEmail) ? 'Yes - ' . $adminEmail : 'No admin email found in settings'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Nile River Cruise test email sending failed', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'appointment_id' => $appointment->id,
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Appointment created but email failed: ' . $e->getMessage(),
                'appointment_id' => $appointment->id
            ], 200);
        }
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Nile River Cruise test failed: ' . $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
})->name('test.nile.cruise');
