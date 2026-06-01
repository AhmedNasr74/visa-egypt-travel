<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Category;
use App\Models\Slider;

class SliderController extends Controller
{

    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('dashboard.sliders.index');
    }


    public function create()
    {
        return view('dashboard.sliders.create', [
            'categories' => Category::all()
        ]);
    }


    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->getSanitized());
        $slider->slides()->createMany($request->get('slides'));
        session()->flash('message', 'Slider Created Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function show(Slider $slider)
    {
        //
    }


    public function edit(Slider $slider)
    {
        $categories = Category::all();
        return view('dashboard.sliders.edit', compact('slider', 'categories'));
    }


    public function update(SliderRequest $request, Slider $slider)
    {
        $slider->update($request->getSanitized());
        $slider->slides()->delete();
        $slider->slides()->createMany($request->get('slides'));
        session()->flash('message', 'Slider Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Slider $slider)
    {
        if ($slider->key == 'main-home-slider') {
            return response()->json(['message' => "Can't delete main slider"], 400);
        }
        $slider->slides()->delete();
        $slider->delete();
        return response()->json([
            'message' => 'Slider Deleted Successfully!'
        ]);
    }
}
