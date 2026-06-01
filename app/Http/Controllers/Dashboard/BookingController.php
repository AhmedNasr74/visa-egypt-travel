<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BookingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateBookingRequest;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(BookingDataTable $dataTable)
    {
        return $dataTable->render('dashboard.bookings.index');
    }

    public function create()
    {
        $tours = Tour::with('translation:id,title')->select(['id'])->get();

        $countries = Country::get();
        return view('dashboard.bookings.create', compact('tours', 'countries'));
    }

    public function store(CreateBookingRequest $request)
    {
        Booking::create($request->getSanitized());
        session()->flash('type', 'success');
        session()->flash('message', 'Your booking has been created successfully');
        return back();
    }

    public function show(Booking $booking)
    {
        $booking->setAttribute('tour', Tour::withTrashed()->find($booking->tour_id));
        return view('dashboard.bookings.show', compact('booking'));
    }

    public function update(Booking $booking, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tour_operator_id' => ['required', 'integer', 'exists:users,id']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $booking->update($validator->validated());

        $booking->refresh();

        return response()->json([
            'message' => "Booking has been assigned to: " . $booking->tour_operator->name,
            'operator' => $booking->tour_operator->name
        ]);
    }
}
