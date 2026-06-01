<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CustomizedCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomizedCategoryRequest;
use App\DataTables\CustomizedCategoryDataTable;

class CustomizedCategoryController extends Controller
{

    public function index(CustomizedCategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.customized-categories.index');
    }


    public function create()
    {
        return view('dashboard.customized-categories.create');
    }


    public function store(CustomizedCategoryRequest $request)
    {
        $customizedCategory = CustomizedCategory::create($request->getSanitized());
        session()->flash('message', 'CustomizedCategory Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.customized-categories.edit', $customizedCategory);
    }


    public function show(CustomizedCategory $customizedCategory)
    {
        //
    }


    public function edit(CustomizedCategory $customizedCategory)
    {
        return view('dashboard.customized-categories.edit', compact('customizedCategory'));
    }


    public function update(CustomizedCategoryRequest $request, CustomizedCategory $customizedCategory)
    {
        $customizedCategory->update($request->getSanitized());
        session()->flash('message', 'CustomizedCategory Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(CustomizedCategory $customizedCategory)
    {
        $customizedCategory->delete();
        return response()->json([
            'message' => 'CustomizedCategory Deleted Successfully!'
        ]);
    }
}
