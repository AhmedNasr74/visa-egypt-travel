<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FaqRequest;
use App\DataTables\FaqDataTable;

class FaqController extends Controller
{

    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('dashboard.faqs.index');
    }


    public function create()
    {
        $relations = [
            'categories' => FaqCategory::all(),
        ];
        return view('dashboard.faqs.create',compact('relations'));
    }


    public function store(FaqRequest $request)
    {
        $faq = Faq::create($request->getSanitized());
        $faq->category()->associate($request->category_id);
        $faq->save();
        session()->flash('message', 'Faq Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.faqs.edit', $faq);
    }


    public function show(Faq $faq)
    {
        //
    }


    public function edit(Faq $faq)
    {
        $relations = [
            'categories' => FaqCategory::all(),
        ];
        return view('dashboard.faqs.edit', compact('faq','relations'));
    }


    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->getSanitized());
        session()->flash('message', 'Faq Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->json([
            'message' => 'Faq Deleted Successfully!'
        ]);
    }
}
