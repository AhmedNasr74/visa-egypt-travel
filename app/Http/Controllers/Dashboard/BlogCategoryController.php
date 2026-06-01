<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogCategoryRequest;
use App\DataTables\BlogCategoryDataTable;

class BlogCategoryController extends Controller
{

    public function index(BlogCategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.blog-categories.index');
    }


    public function create()
    {
        return view('dashboard.blog-categories.create');
    }


    public function store(BlogCategoryRequest $request)
    {
        $blogCategory = BlogCategory::create($request->getSanitized());
        $blogCategory->seo()->create($request->get('seo'));
        session()->flash('message', 'BlogCategory Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.blog-categories.edit', $blogCategory);
    }


    public function show(BlogCategory $blogCategory)
    {
        //
    }


    public function edit(BlogCategory $blogCategory)
    {
        return view('dashboard.blog-categories.edit', compact('blogCategory'));
    }


    public function update(BlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $blogCategory->update($request->getSanitized());
        $blogCategory->seo()->update($request->get('seo'));
        session()->flash('message', 'BlogCategory Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return response()->json([
            'message' => 'BlogCategory Deleted Successfully!'
        ]);
    }
}
