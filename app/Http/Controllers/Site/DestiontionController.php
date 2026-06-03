<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Tour;
use App\Support\SiteSeo;
use Illuminate\Http\Request;


class DestiontionController extends Controller
{
    // make it work with id or slug 
    public function des_details(Request $request, $slug)
    {
        $des = Destination::with(['tours.destinations', 'seo'])->whereHas('translations', function ($q) use ($slug) {
            $q->where("slug", $slug);
        })->orWhere('id', $slug)->first();

        if ($des) {
            $des->publish();
        } else {
            SiteSeo::publishPage(__('site.destination'), SiteSeo::siteDescription());
        }

        $destinations = Destination::all();

        return view('site.des_details.index', compact('des', 'destinations'));

    }

    public function dayTours()
    {
        $destinations = Destination::where('enabled', true)->orderByRaw('ISNULL(order_id), order_id')->get();

        $tours = Tour::where('featured', true)->limit(6)->get();
        $blogs = Blog::where('enabled', true)->orderBy('id', 'desc')->limit(6)->get();

        SiteSeo::publishPage(__('site.day_tours'), SiteSeo::siteDescription());

        return view('site.destinations.destination_list', compact('destinations', 'blogs', 'tours'));
    }

}
