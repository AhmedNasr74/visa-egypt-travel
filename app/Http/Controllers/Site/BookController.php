<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\BookingAdminMail;
use App\Mail\BookingSuccessMail;
use App\Models\Booking;
use App\Services\DualEmailSender;
use App\Models\Country;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

                $this->sendTourBookingEmails($booking);

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

    private function sendTourBookingEmails(Booking $booking): void
    {
        DualEmailSender::sendGuest(
            $booking->email,
            new BookingSuccessMail($booking),
            'tour_booking',
            ['booking_id' => $booking->id]
        );

        DualEmailSender::sendAdmin(
            new BookingAdminMail($booking),
            'tour_booking',
            ['booking_id' => $booking->id]
        );
    }
}
