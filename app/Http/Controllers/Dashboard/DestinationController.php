<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Destination;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DestinationRequest;
use App\DataTables\DestinationDataTable;

class DestinationController extends Controller
{

    public function index(DestinationDataTable $dataTable)
    {
        return $dataTable->render('dashboard.destinations.index');
    }


    public function create()
    {
        
        return view('dashboard.destinations.create');
    }


    public function store(DestinationRequest $request)
    {

        $destination = Destination::create($request->getSanitized());
        $destination->seo()->create($request->get('seo'));
        session()->flash('message', 'Destination Created Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function show(Destination $destination)
    {
        //
    }


    public function edit(Destination $destination)
    {
        return view('dashboard.destinations.edit', compact('destination'));
    }


    public function update(DestinationRequest $request, Destination $destination)
    {
        $destination->update($request->getSanitized());
        $destination->seo ?
            $destination->seo->update($request->get('seo')) :
            $destination->seo()->create($request->get('seo'));
        session()->flash('message', 'Destination Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Destination $destination)
    {
        $destination->delete();
        return response()->json([
            'message' => 'Destination Deleted Successfully!'
        ]);
    }
}
