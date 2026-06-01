<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.categories.index');
    }

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->getSanitized());
        $category->seo()->create($request->get('seo'));
        session()->flash('message', 'Category Created Successfully!');
        session()->flash('type', 'success');
        return back();
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->getSanitized());
        $category->seo ?
            $category->seo->update($request->get('seo')) :
            $category->seo()->create($request->get('seo'));
        session()->flash('message', 'Category Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category Deleted Successfully!'
        ]);
    }
}
