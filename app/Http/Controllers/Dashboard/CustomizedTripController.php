<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CustomizedTrip;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomizedTripRequest;
use App\DataTables\CustomizedTripDataTable;
use App\Models\Destination;
use App\Models\CustomizedCategory;



class CustomizedTripController extends Controller
{

    public function index(CustomizedTripDataTable $dataTable)
    {
        return $dataTable->render('dashboard.customized-trips.index');
    }


    public function create()
    {
        $relations = [
            'Destinations' => CustomizedCategory::all(),
        ];
        return view('dashboard.customized-trips.create' ,compact('relations'));
    }


    public function store(CustomizedTripRequest $request)
    {

        $customizedTrip = CustomizedTrip::create($request->getSanitized());
        $customizedTrip->categories()->sync($request->get('Destinations'));
        session()->flash('message', 'CustomizedTrip Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.customized-trips.edit', $customizedTrip);
    }


    public function show(CustomizedTrip $customizedTrip)
    {

        return view('dashboard.customized-trips.show', compact('customizedTrip'));

    }


    public function edit(CustomizedTrip $customizedTrip)
    {
        $relations = [
            'Destinations' => CustomizedCategory::all(),
        ];
        return view('dashboard.customized-trips.edit', compact('customizedTrip','relations'));
    }


    public function update(CustomizedTripRequest $request, CustomizedTrip $customizedTrip)
    {
        $customizedTrip->update($request->getSanitized());
        $customizedTrip->categories()->sync($request->get('Destinations'));
        session()->flash('message', 'CustomizedTrip Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(CustomizedTrip $customizedTrip)
    {
        $customizedTrip->delete();
        return response()->json([
            'message' => 'CustomizedTrip Deleted Successfully!'
        ]);
    }
}
