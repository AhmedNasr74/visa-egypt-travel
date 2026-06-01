<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Raise;
use App\Models\Tour;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RaiseRequest;
use App\DataTables\RaiseDataTable;
use App\Models\Category;
use App\Models\Destination;

class RaiseController extends Controller
{

    public function index(RaiseDataTable $dataTable)
    {
        return $dataTable->render('dashboard.raises.index');
    }


    public function create()
    {
        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'tours' => Tour::all(),
        ];
        return view('dashboard.raises.create', compact('relations'));
    }


    public function store(RaiseRequest $request)
    {
        $raise = Raise::create($request->getSanitized());
        $raise->tours()->sync($request->get('tours'));
        $raise->categories()->sync($request->get('categories'));
        $raise->destinations()->sync($request->get('destinations'));
        session()->flash('message', 'Raise Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.raises.edit', $raise);
    }


    public function show(Raise $raise)
    {
        //
    }


    public function edit(Raise $raise)
    {
        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'tours' => Tour::all(),
        ];
        return view('dashboard.raises.edit', compact('raise','relations'));
    }


    public function update(RaiseRequest $request, Raise $raise)
    {
        $raise->update($request->getSanitized());
        $raise->tours()->sync($request->get('tours'));
        $raise->categories()->sync($request->get('categories'));
        $raise->destinations()->sync($request->get('destinations'));
        session()->flash('message', 'Raise Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Raise $raise)
    {
        $raise->delete();
        return response()->json([
            'message' => 'Raise Deleted Successfully!'
        ]);
    }
}
