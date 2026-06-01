<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // dd($request->all());
        $tours_query = Tour::query();
        if ($request->get('destination')) {
            $tours_query->whereHas('destinations', fn($q) => $q->whereId($request->get('destination')));
        }
        if ($request->get('type')) {
            $tours_query->whereHas('categories', fn($q) => $q->whereId($request->get('type')));
        }
        if ($request->get('duration')) {
            $duration = $request->get('duration');
            if ($duration == 1) {
                $tours_query->where('duration', 1);
            } elseif ($duration == 2) {
                $tours_query->whereBetween('duration', [2, 4]);
            } elseif ($duration == 3) {
                $tours_query->whereBetween('duration', [4, 7]);
            } else {
                $tours_query->where('duration', '>', 7);
            }
        }
        $tours = $tours_query->paginate(9);
        //dd($tours);

        $destinations = Destination::all();
        $categories = Category::all();

        return view('site.tour_details.search', compact('tours', 'destinations', 'categories'));
    }

    public function filter(Request $request)
    {
        $tours_query = Tour::query();
        if ($request->get('all')) {
            $tours_query = Tour::query();
        }
        if ($request->get('type')) {
            $tours_query->whereHas('categories', fn($q) => $q->whereId($request->get('type')));
        }
        if ($request->get('destination')) {
            $tours_query->whereHas('destinations', fn($q) => $q->whereId($request->get('destination')));
        }
        if ($request->get('duration')) {
            $duration = $request->get('duration');
            if ($duration == 1) {
                $tours_query->where('duration', 1);
            } elseif ($duration == 2) {
                $tours_query->whereBetween('duration', [2, 4]);
            } elseif ($duration == 3) {
                $tours_query->whereBetween('duration', [4, 7]);
            } else {
                $tours_query->where('duration', '>', 7);
            }
        }
        $tours = $tours_query->paginate(9);
        $destinations = Destination::all();
        $categories = Category::all();
        return view('site.tour_details.search', compact('tours', 'destinations', 'categories'));

    }
    // make it work with id or slug
    public function package($title)
    {
        $category = Category::whereTranslation('slug', $title)->orWhere('id', $title)->firstOrFail();

        $tours_query = $category->tours();
        $tours = $tours_query->paginate(9);
        $destinations = Destination::all();
        $categories = Category::all();
        return view('site.tour_details.search', compact('tours', 'category', 'destinations', 'categories'));


    }
}
