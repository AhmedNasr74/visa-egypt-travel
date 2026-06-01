<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subscribe;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SubscribeRequest;
use App\DataTables\SubscribeDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeEmail;
use App\Jobs\SendSubscribeEmail;
use Carbon\Carbon;






class SubscribeController extends Controller
{

    public function index(SubscribeDataTable $dataTable)
    {
        return $dataTable->render('dashboard.subscribes.index');
    }


    public function create()
    {
        return view('dashboard.subscribes.create');
    }
    public function email()
    {
        return view('dashboard.subscribes.email');
    }
    public function Send_Email(Request $request)
    {
        $users = Subscribe::all()->toArray();
        $chunkedUsers = array_chunk($users, 50);
        $requestData = $request->all();
        $delay = Carbon::now()->addMinute();
        foreach ($chunkedUsers as $chunk) {
            SendSubscribeEmail::dispatch($chunk, $requestData)->onQueue('emails')->delay($delay);
        }
        return redirect()->back();
    }

    public function store(SubscribeRequest $request)
    {
        $subscribe = Subscribe::create($request->getSanitized());
        session()->flash('message', 'Subscribe Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.subscribes.edit', $subscribe);
    }


    public function show(Subscribe $subscribe)
    {
        //
    }


    public function edit(Subscribe $subscribe)
    {
        return view('dashboard.subscribes.edit', compact('subscribe'));
    }


    public function update(SubscribeRequest $request, Subscribe $subscribe)
    {
        $subscribe->update($request->getSanitized());
        session()->flash('message', 'Subscribe Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();
        return response()->json([
            'message' => 'Subscribe Deleted Successfully!'
        ]);
    }
}
