<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;

class NileCruiseController extends Controller
{
    public function index()
    {
        $nile_cruise = Category::with('children')->whereTranslation('slug', 'nile-cruise')->firstOrFail();

        return view('site.nile-cruise.index', compact('nile_cruise'));
    }
}
