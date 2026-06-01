<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BookingDataTable;
use App\Http\Requests\Dashboard\CreateBookingRequest;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ReportController extends Controller
{
    public function sells(Request $request,BookingDataTable $dataTable)
    {
        if(!$request->all()){
            $bookings=Booking::all();
            $data=null;

        }else{
            if (!$request->to_date) {
                $request->merge(['to_date' => Carbon::today()->toDateString()]);
            }
            $validator = Validator::make($request->all(), [
                'from_date' => ['required', 'string', 'date'],
                'to_date' => ['required', 'string', 'date', 'after_or_equal:from_date'],
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }
            $data = $validator->validated();
            // dd($data);
            $endDate = Carbon::parse($data['to_date'])->addDay();
            $bookings = Booking::whereBetween('created_at', [$data['from_date'],$endDate])->get();
        }
        $remain_egpSum = $bookings->where('currency_code', 'EGP')->sum('remaining_amount');
        $remain_aedSum = $bookings->where('currency_code', 'AED')->sum('remaining_amount');
        $aedSum = ($bookings->where('currency_code', 'AED')->sum('total_price'))-$remain_aedSum;
        $egpSum = ($bookings->where('currency_code', 'EGP')->sum('total_price'))-$remain_egpSum;

        return view('dashboard.reports.sells', compact('data','aedSum','egpSum','remain_egpSum','remain_aedSum'));
    }
    public function tours(Request $request){
        // dd($request->all());
        $categories=[];
        $cat_count=[];
        $tours=[];
        $categories=[];
        $tour_count=[];
        if(!$request->all()){
            $data=null;

        }else{
            if (!$request->to_date) {
                $request->merge(['to_date' => Carbon::today()->toDateString()]);
            }
            $validator = Validator::make($request->all(), [
                'from_date' => ['required', 'string', 'date'],
                'to_date' => ['required', 'string', 'date', 'after_or_equal:from_date'],
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ], 422);
            }
            $data = $validator->validated();
            $endDate = Carbon::parse($data['to_date'])->addDay();
            $bookings = Booking::whereBetween('created_at', [$data['from_date'],$endDate])->get();

            if($request->tourType=="tour"){
                $tour_count = $bookings->groupBy('tour_id')
            ->map(function ($bookings) {
                return $bookings->count();
            })
            ->sortDesc();
            $id = $tour_count->keys()->take(5);
            $tours = Tour::whereIn('id', $id)->get();
            }else{
                $cat_count = $bookings->flatMap(function ($booking) {
                    return $booking->tour->categories;
                })
                ->groupBy('id')
                ->map(function ($category) {
                    return $category->count();
                })
                ->sortDesc();
                $ids = $cat_count->keys()->take(5);
                $categories = Category::whereIn('id', $ids)->get();
            }
        }
        return view('dashboard.reports.tours',compact('tours','categories','cat_count','tour_count'));

    }
}
