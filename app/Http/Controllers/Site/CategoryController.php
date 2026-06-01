<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tour;
use App\Models\Offer;


class CategoryController extends Controller
{
    public function travelPackages()
    {
        $category = Category::whereTranslation('slug', 'packages')->first();

        $category->setAttribute('children', $category->children()->withCount('tours')->get());

        $blogs = Blog::where('enabled', true)->orderBy('id', 'desc')->limit(6)->get();
        $packages = Tour::where('enabled', true)->orderBy('id', 'desc')->limit(6)->get();

        return view('site.travel-packages.index', compact('category', 'blogs', 'packages'));
    }
}
