<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\CustomizeTripMail;
use App\Models\CustomizedCategory;
use App\Models\CustomizedTrip;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomizeTripController extends Controller
{
    public function index(){
        $destinations = CustomizedCategory::all();
        $countries = Country::all();

        return view('site.customize_trip.index', compact('destinations', 'countries'));
    }

    public function store(Request $request)
    {
        try {
            // Debug: Log the incoming request data
            \Log::info('Customize trip form data received:', $request->all());
            
            $validator = Validator::make($request->all(), [
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
                'children_ages.*' => ['nullable', 'numeric', 'min:0', 'max:17'],
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed:', $validator->errors()->toArray());
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $data = $validator->validated();
            \Log::info('Validated data:', $data);
            
            // Convert children_ages strings to integers
            if (isset($data['children_ages']) && is_array($data['children_ages'])) {
                $data['children_ages'] = array_map('intval', $data['children_ages']);
            }
            
            // Validate dates manually
            if (!empty($data['date_from'])) {
                $dateFrom = \DateTime::createFromFormat('Y-m-d', $data['date_from']);
                if (!$dateFrom || $dateFrom->format('Y-m-d') !== $data['date_from']) {
                    \Log::error('Invalid date_from format:', ['date_from' => $data['date_from']]);
                    return response()->json(['error' => 'Invalid arrival date format. Please use YYYY-MM-DD format.'], 422);
                }
                if ($dateFrom < new \DateTime('today')) {
                    return response()->json(['error' => 'Arrival date must be today or in the future.'], 422);
                }
            }
            
            if (!empty($data['date_to'])) {
                $dateTo = \DateTime::createFromFormat('Y-m-d', $data['date_to']);
                if (!$dateTo || $dateTo->format('Y-m-d') !== $data['date_to']) {
                    \Log::error('Invalid date_to format:', ['date_to' => $data['date_to']]);
                    return response()->json(['error' => 'Invalid departure date format. Please use YYYY-MM-DD format.'], 422);
                }
                
                if (!empty($data['date_from'])) {
                    $dateFrom = \DateTime::createFromFormat('Y-m-d', $data['date_from']);
                    if ($dateTo <= $dateFrom) {
                        return response()->json(['error' => 'Departure date must be after arrival date.'], 422);
                    }
                }
            }
            
            // Prepare data for database insertion
            $tripData = [
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
                'days' => \Carbon\Carbon::parse($data['date_from'])->diffInDays($data['date_to']) + 1,
                'request' => $data['request'] ?? null,
                'age_range' => $data['age_range'] ?? null,
                'travel_to' => $data['travel_to'],
                'accommodation_choices' => $data['accommodation_choices'],
                'how_did_you_hear_about_us' => $data['how_did_you_hear_about_us'],
                'children_ages' => $data['children_ages'] ?? [],
                'date_type' => 'exact', // Add the missing date_type field
            ];

            \Log::info('Attempting to create trip with data:', $tripData);
            
            // Create the customized trip
            $customizedTrip = CustomizedTrip::create($tripData);

            \Log::info('Customized trip created successfully:', ['id' => $customizedTrip->id]);

            // Format the data for email
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
                'requirements' => $data['note'] . (isset($data['request']) ? ' | Request: ' . $data['request'] : '')
            ];

            // Send confirmation email to client
            try {
                \Log::info('Starting client confirmation email process', [
                    'client_email' => $data['email'],
                    'trip_id' => $customizedTrip->id
                ]);
                
                \Log::info('Sending client confirmation email', [
                    'client_email' => $data['email'],
                    'trip_id' => $customizedTrip->id,
                    'form_data_keys' => array_keys($formData),
                    'email_subject' => 'Your Customized Trip Request Confirmation'
                ]);
                
                Mail::to($data['email'])->send(new CustomizeTripMail($formData, false));
                
                \Log::info('Client confirmation email sent successfully', [
                    'client_email' => $data['email'],
                    'trip_id' => $customizedTrip->id,
                    'email_sent_at' => now()->toDateTimeString()
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to send client confirmation email', [
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'client_email' => $data['email'],
                    'trip_id' => $customizedTrip->id,
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
                    'trip_id' => $customizedTrip->id
                ]);
                
                if (!empty($adminEmail)) {
                    \Log::info('Sending admin notification email', [
                        'admin_email' => $adminEmail,
                        'trip_id' => $customizedTrip->id,
                        'form_data_keys' => array_keys($formData),
                        'email_subject' => 'New Customized Trip Request Received'
                    ]);
                    
                    Mail::to($adminEmail)->send(new CustomizeTripMail($formData, true, $customizedTrip->id));
                    
                    \Log::info('Admin notification email sent successfully', [
                        'admin_email' => $adminEmail,
                        'trip_id' => $customizedTrip->id,
                        'email_sent_at' => now()->toDateTimeString()
                    ]);
                } else {
                    \Log::warning('No admin email found in settings', [
                        'setting_key' => 'contact_email',
                        'setting_value' => $contactEmailSetting,
                        'available_settings' => \App\Models\Setting::pluck('option_key')->toArray(),
                        'trip_id' => $customizedTrip->id
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send admin notification email', [
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'trip_id' => $customizedTrip->id,
                    'admin_email' => $adminEmail ?? 'No admin email found',
                    'stack_trace' => $e->getTraceAsString()
                ]);
                // Don't fail the entire request if email fails
            }

            return response()->json([
                'message' => 'Your Customized Trip Created Successfully!',
                'link' => route('site.home')
            ]);
            
        } catch (QueryException $exception) {
            \Log::error('Customize trip form submission error (QueryException): ' . $exception->getMessage());
            \Log::error('SQL: ' . $exception->getSql());
            \Log::error('Bindings: ' . json_encode($exception->getBindings()));
            return response()->json([
                'error' => __('main.unexpected-error')
            ], 500);
        } catch (\Exception $exception) {
            \Log::error('Customize trip form submission error (Exception): ' . $exception->getMessage());
            \Log::error('Stack trace: ' . $exception->getTraceAsString());
            return response()->json([
                'error' => __('main.unexpected-error')
            ], 500);
        }
    }

    public function show(CustomizedTrip $customizedTrip)
    {
        return view('dashboard.customized-trips.show', compact('customizedTrip'));
    }
}
