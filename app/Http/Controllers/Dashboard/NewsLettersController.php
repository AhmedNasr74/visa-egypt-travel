<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\NewsLettersDataTable;
use App\Http\Controllers\Controller;
use App\Jobs\bookJob;
use App\Models\NewsLetters;
use App\Models\NewsLettersLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsLettersController extends Controller
{

    public function index(NewsLettersDataTable $dataTable)
    {
        return $dataTable->render('Dashboard.NewsLetters.index');
    }

    public function destroy($id)
    {
        $NewsLetters = NewsLetters::findOrFail($id);
        $NewsLetters->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'NewsLetters is deleted Successfully');
        return redirect()->back();
    }


    public function creatNewsLetters(Request $request)
    {
        $NewsLetter = $request->input('selected_NewsLetterss');

        if (!NewsLetter) {
            session()->flash('type', 'warning');
            session()->flash('message', 'you should select some NewsLetterss first...');
            return redirect()->back();
        }

        return view('Dashboard.NewsLetters.create', compact('NewsLetterss'));
    }

    public function sendNewsLetters(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'subject' => 'required|string|min:1',
                'NewsLetterss' => 'required|array|min:1',
                'content' => ['required', 'string', 'min:10'],
        ]);

        if ($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        $NewsLetter = $request->collect('NewsLetterss');
        $count = NewsLettersLogs::whereDate('created_at', today()->toDateString())->count();

        $max = config('mail.max_reach_user_per_day');
        if (($count + NewsLetter->count()) >= $max) {
            return response()->json([
                'error' => "you have reach the limit of daily $max NewsLetterss only ..."
            ], 500);
        }

        try {
            bookJob::dispatch(
                $request->get('subject'),
                $request->get('content'),
                NewsLetter->toArray()
            );
            return response()->json([
                'success' => "Campaign Scheduled Successfully"
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => "Internal Server Error" . $exception->getMessage()
            ], 500);
        }
    }

}
