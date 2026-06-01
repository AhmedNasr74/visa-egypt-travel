<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BlogRequest;
use App\DataTables\BlogDataTable;

class BlogController extends Controller
{

    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('dashboard.blogs.index');
    }


    public function create()
    {
        $relations = [
            'categories' => BlogCategory::all(),
        ];
        return view('dashboard.blogs.create',compact('relations'));
    }


    public function store(BlogRequest $request)
    {
        $blog = Blog::create($request->getSanitized());
        $blog->seo()->create($request->get('seo'));
        $blog->category()->attach($request->categories);
        session()->flash('message', 'Blog Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.blogs.edit', $blog);
    }


    public function show(Blog $blog)
    {
        //
    }


    public function edit(Blog $blog)
    {
        $relations = [
            'categories' => BlogCategory::all(),
        ];
        return view('dashboard.blogs.edit', compact('blog','relations'));
    }


    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->getSanitized());
        //$blog->seo()->update($request->get('seo'));

        session()->flash('message', 'Blog Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Blog Deleted Successfully!'
        ]);
    }
}
