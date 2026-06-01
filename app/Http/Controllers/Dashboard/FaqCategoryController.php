<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\FaqCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FaqCategoryRequest;
use App\DataTables\FaqCategoryDataTable;

class FaqCategoryController extends Controller
{

    public function index(FaqCategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.faq-categories.index');
    }


    public function create()
    {
        return view('dashboard.faq-categories.create');
    }


    public function store(FaqCategoryRequest $request)
    {
        $faqCategory = FaqCategory::create($request->getSanitized());
        session()->flash('message', 'FaqCategory Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.faq-categories.edit', $faqCategory);
    }


    public function show(FaqCategory $faqCategory)
    {
        //
    }


    public function edit(FaqCategory $faqCategory)
    {
        return view('dashboard.faq-categories.edit', compact('faqCategory'));
    }


    public function update(FaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        $faqCategory->update($request->getSanitized());
        session()->flash('message', 'FaqCategory Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();
        return response()->json([
            'message' => 'FaqCategory Deleted Successfully!'
        ]);
    }
}
