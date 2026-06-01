<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Discount;
use App\Models\Tour;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DiscountRequest;
use App\DataTables\DiscountDataTable;
use App\Models\Category;
use App\Models\Destination;


class DiscountController extends Controller
{

    public function index(DiscountDataTable $dataTable)
    {
        return $dataTable->render('dashboard.discounts.index');
    }


    public function create()
    {
        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'tours' => Tour::all(),
        ];
        return view('dashboard.discounts.create', compact('relations'));
    }


    public function store(DiscountRequest $request)
    {
        $discount = Discount::create($request->getSanitized());
        $discount->tours()->sync($request->get('tours'));
        $discount->categories()->sync($request->get('categories'));
        $discount->destinations()->sync($request->get('destinations'));
        session()->flash('message', 'Discount Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.discounts.edit', $discount);
    }


    public function show(Discount $discount)
    {
        //
    }


    public function edit(Discount $discount)
    {
        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'tours' => Tour::all(),
        ];
        return view('dashboard.discounts.edit', compact('discount','relations'));
    }


    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update($request->getSanitized());
        $discount->tours()->sync($request->get('tours'));
        $discount->categories()->sync($request->get('categories'));
        $discount->destinations()->sync($request->get('destinations'));
        session()->flash('message', 'Discount Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Discount $discount)
    {
        $discount->delete();
        return response()->json([
            'message' => 'Discount Deleted Successfully!'
        ]);
    }
}
