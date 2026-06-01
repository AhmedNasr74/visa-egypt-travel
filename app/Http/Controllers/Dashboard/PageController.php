<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Page;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageRequest;
use App\DataTables\PageDataTable;

class PageController extends Controller
{

    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('dashboard.pages.index');
    }


    public function create()
    {
        return view('dashboard.pages.create');
    }


    public function store(PageRequest $request)
    {
        $page = Page::create($request->getSanitized());
        session()->flash('message', 'Page Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.pages.edit', $page);
    }


    public function show(Page $page)
    {
        //
    }


    public function edit(Page $page)
    {
        return view('dashboard.pages.edit', compact('page'));
    }


    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->getSanitized());
        session()->flash('message', 'Page Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json([
            'message' => 'Page Deleted Successfully!'
        ]);
    }
}
