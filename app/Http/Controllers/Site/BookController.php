<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\BookingSuccessMail;
use App\Mail\BookingAdminMail;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BookController extends Controller
{
    public function book(Request $request)
    {
        try {
            // Debug: Log the incoming request data
            \Log::info('Tour booking form data received:', $request->all());
            
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'string', 'min:10'],
                'date' => ['required', 'string', 'date', 'after_or_equal:today'],
                'notes' => ['nullable', 'string'],
                'nationality' => ['nullable', 'string'],
                'tour_id' => ['required', 'integer', 'exists:tours,id'],
                'accommodation_type' => ['nullable', 'string'],
                'price_category' => ['nullable', 'string'],
                'adults' => ['required', 'integer', 'min:1'],
                'children' => ['required', 'integer', 'min:0'],
            ]);

            if ($validator->fails()) {
                \Log::error('Tour booking validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }

            $data = $validator->validated();
            \Log::info('Tour booking validated data:', $data);

            $tour = Tour::find($request->tour_id);

            $price = $tour->getPrice(
                $request->date,
                $request->adults,
                $request->accommodation_type,
                $request->price_category,
            );

            $total_price = ($request->adults * $price['adult_price']) + ($request->children * $price['child_price']);

            try {
                DB::beginTransaction();

                $booking = Booking::create([
                    'date' => Carbon::parse($request->date)->toDateString(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'nationality' => $request->nationality,
                    'tour_id' => $request->tour_id,
                    'adult_price' => $price['adult_price'],
                    'child_price' => $price['child_price'],
                    'adults_count' => $request->adults,
                    'children_count' => $request->children,
                    'total_price' => $total_price,
                    'notes' => $request->notes,
                    'client_id' => auth()->guard('client')->id(),
                    'currency_code' => user_currency()->name,
                    'type' => $request->type,
                ]);

                \Log::info('Tour booking created successfully:', ['id' => $booking->id]);

                // Send confirmation email to client
                try {
                    \Log::info('Starting client booking confirmation email process', [
                        'client_email' => $booking->email,
                        'booking_id' => $booking->id
                    ]);
                    
                    Mail::to($booking->email)->send(new BookingSuccessMail($booking));
                    
                    \Log::info('Client booking confirmation email sent successfully', [
                        'client_email' => $booking->email,
                        'booking_id' => $booking->id,
                        'email_sent_at' => now()->toDateTimeString()
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Failed to send client booking confirmation email', [
                        'error_message' => $e->getMessage(),
                        'error_file' => $e->getFile(),
                        'error_line' => $e->getLine(),
                        'client_email' => $booking->email,
                        'booking_id' => $booking->id,
                        'stack_trace' => $e->getTraceAsString()
                    ]);
                    // Don't fail the entire request if email fails
                }
                
                // Send notification email to admin
                try {
                    \Log::info('Starting admin booking notification email process');
                    
                    // Get admin email from settings
                    $contactEmailSetting = setting('contact_email');
                    $adminEmail = is_array($contactEmailSetting) ? $contactEmailSetting[0] : $contactEmailSetting;
                    
                    \Log::info('Admin email lookup from settings', [
                        'contact_email_setting' => $contactEmailSetting,
                        'admin_email_extracted' => $adminEmail,
                        'admin_email_found' => !empty($adminEmail),
                        'booking_id' => $booking->id
                    ]);
                    
                    if (!empty($adminEmail)) {
                        \Log::info('Sending admin booking notification email', [
                            'admin_email' => $adminEmail,
                            'booking_id' => $booking->id,
                            'email_subject' => 'New Tour Booking Received'
                        ]);
                        
                        Mail::to($adminEmail)->send(new BookingAdminMail($booking));
                        
                        \Log::info('Admin booking notification email sent successfully', [
                            'admin_email' => $adminEmail,
                            'booking_id' => $booking->id,
                            'email_sent_at' => now()->toDateTimeString()
                        ]);
                    } else {
                        \Log::warning('No admin email found in settings', [
                            'setting_key' => 'contact_email',
                            'setting_value' => $contactEmailSetting,
                            'available_settings' => \App\Models\Setting::pluck('option_key')->toArray(),
                            'booking_id' => $booking->id
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('Failed to send admin booking notification email', [
                        'error_message' => $e->getMessage(),
                        'error_file' => $e->getFile(),
                        'error_line' => $e->getLine(),
                        'booking_id' => $booking->id,
                        'admin_email' => $adminEmail ?? 'No admin email found',
                        'stack_trace' => $e->getTraceAsString()
                    ]);
                    // Don't fail the entire request if email fails
                }

                DB::commit();

                return response()->json([
                    'price' => $price,
                    'booking' => $booking,
                    'message' => 'Booking Created Successfully, Will contact you soon!',
                    'booking_id' => $booking->id
                ], 201);

            } catch (Exception|Throwable $exception) {
                DB::rollBack();
                \Log::error('Tour booking creation error (Exception/Throwable): ' . $exception->getMessage());
                \Log::error('Stack trace: ' . $exception->getTraceAsString());
                return response()->json([
                    'error' => 'Unexpected Error. Please Try Again Later',
                    'debug' => config('app.debug') ? [
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTrace(),
                    ] : null,
                ], 500);
            }

        } catch (Exception|Throwable $exception) {
            \Log::error('Tour booking form submission error (Exception/Throwable): ' . $exception->getMessage());
            \Log::error('Stack trace: ' . $exception->getTraceAsString());
            return response()->json([
                'error' => 'Unexpected Error. Please Try Again Later',
                'debug' => config('app.debug') ? [
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTrace(),
                ] : null,
            ], 500);
        }
    }
}
