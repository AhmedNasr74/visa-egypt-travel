<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tour;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if(auth()->guard('client')->user()){
            $client=auth()->guard('client')->user();
        }
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required',
            'money_rate' => 'required',
            'destination_rate' => 'required',
            'accommodation_rate' => 'required',
            'transport_rate' => 'required',
            'terms' => "required"
        ]);


        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        try {
            $data = $validator->validated();
            $comment=Comment::create($data);
            if(auth()->guard('client')->user()){
                $client=auth()->guard('client')->user();
                $client->comments()->save($comment);
            }
            $tour = Tour::find($request->tour_id);
            $tour->comments()->save($comment);
            return response()->json([
                "message"=>"Your Comment Applied"
            ]);

               } catch (Exception $exception) {
            report($exception);
            return response()->json([
                'm' => $exception->getMessage(),
                'error' => __('main.unexpected-error')
            ], 500);
        }
    }

    public function index($tour_id)
    {
        $tour = Tour::find($tour_id);
        $comments = $tour->comments;
        return view('comments.index', compact('comments'));
    }
}
