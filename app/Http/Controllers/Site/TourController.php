<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Tour;
use App\Support\SiteSeo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function destinationCategoriesSearch(Request $request, $destination, $category)
    {

        $destination = Destination::where(fn($query) => $query
            ->whereTranslation('slug', $destination)
            ->orWhere('id', $destination))
            ->firstOrFail();
        $category = Category::where(fn($query) => $query->whereTranslation('slug', $category))
            ->with('seo')
            ->firstOrFail();
        $category->publish();

        $query = Tour::whereHas('destinations', fn($q) => $q->whereId($destination->id))
            ->whereHas('categories', fn($q) => $q->whereId($category->id));

        if ($request->filled('tour')) {
            $query->whereTranslationLike('title', "%" . $request->get('tour') . "%");
        }

        if ($request->get('budget')) {
            $query->where('start_from_price', '>=', $request->get('budget'))->orderBy('start_from_price');
        }

        $tours = $query->paginate();

        $title = $category->title;

        $bannerImage = $category->banner;

        return view('site.destination-category.index', [
            'tours' => $tours,
            'title' => $title,
            'category' => $category,
            'destination' => $destination,
            'bannerImage' => $bannerImage,
        ]);
    }

    public function tour_details(Request $request, $slug)
    {

        $tour = Tour::query()
            ->where('enabled', true)
            ->where('slug', $slug)
            ->with(['categories', 'destinations', 'seasons', 'discount', 'raise', 'seo'])
            ->firstOrFail();
        $tour->publish();
        $comments = $tour->comments()->take(5)->get();
        $days = $tour->days()->get();
        $tour['last_price'] = $tour->adult_price;
        $totalDiscount = 0;
        $totalRaise = 0;
        $count_discount = 0;
        $count_raise = 0;
        foreach ($tour->categories as $cat) {
            foreach ($cat->discount as $discount) {
                if ($discount->type == 'fixed') {
                    $totalDiscount += $discount->value;
                } else {
                    $count_discount = $discount->count;
                    $totalDiscount_count += $discount->value;
                }
            }
        }
        foreach ($tour->destinations as $des) {
            foreach ($des->discount as $discount) {

                if ($discount->type == 'fixed') {
                    $totalDiscount += $discount->value;
                } else {
                    $count_discount = $discount->count;
                    $totalDiscount += $discount->value;
                }
            }
        }
        foreach ($tour->destinations as $des) {
            foreach ($des->raise as $raise) {

                if ($raise->type == 'fixed') {
                    $totalRaise += $raise->value;
                } else {
                    $count_raise = $raise->count;
                    $totalRaise += $raise->value;
                }
            }
        }
        foreach ($tour->categories as $cat) {
            foreach ($cat->raise as $raise) {

                if ($raise->type == 'fixed') {
                    $totalRaise += $raise->value;
                } else {
                    $count_raise = $raise->count;
                    $totalRaise += $raise->value;
                }
            }
        }

        foreach ($tour->discount as $discount) {
            if ($discount->type == 'fixed') {
                $totalDiscount += $discount->value;
            } else {
                $count_discount = $discount->count;
                $totalDiscount += $discount->value;
            }
        }
        foreach ($tour->raise as $raise) {
            if ($raise->type == 'fixed') {
                $totalRaise += $raise->value;
            } else {
                $count_raise = $raise->count;
                $totalRaise += $raise->value;
            }
        }
        if ($count_discount > 0 || $count_raise > 0) {
            $netEffect = $totalDiscount - $totalRaise;
        } else {
            $netEffect = $totalDiscount - $totalRaise;
            if ($netEffect !== 0) {
                $adjustmentValue = abs($netEffect) / 100;
                if ($netEffect > 0) {
                    $tour->adult_price *= (1 - $adjustmentValue);
                    $tour->child_price *= (1 - $adjustmentValue);
                } else {
                    $tour->adult_price *= (1 + $adjustmentValue);
                    $tour->child_price *= (1 + $adjustmentValue);
                }
            }
        }

        $last_blogs = Blog::orderBy('id', 'desc')->take(8)->get();

        return view('site.tour_details.index', compact('last_blogs', 'tour', 'days', 'count_discount', 'count_raise', 'netEffect', 'comments'));
    }

    public function search(Request $request)
    {
        $tours_query = Tour::query();

        if ($request->get('budget')) {
            $tours_query->where('start_from_price', '>=', $request->get('budget'))
                ->orderBy('start_from_price');
        }

        if ($request->get('destination')) {
            $tours_query->whereHas('destinations', fn($q) => $q->whereId($request->get('destination')));
        }

        if ($request->filled('tour')) {
            $tours_query->whereTranslationLike('title', "%" . $request->get('tour') . "%");
        }
        $tours = $tours_query->paginate();
        return view('site.destination-category.index', [
            'tours' => $tours,
            'title' => 'Tour Search Result',
            'bannerImage' => null,
        ]);
    }

    public function pricing(Request $request)
    {
        $tour = Tour::where('enabled', true)
            ->where(function ($q) use ($request) {
                $q->where('id', $request->tour);
            })
            ->with(['categories', 'destinations', 'seasons', 'discount', 'raise'])
            ->firstOrFail();

    }

    public function NileCruise()
    {
        $nile_cruise = Category::with(['children', 'seo'])->whereTranslation('slug', 'nile-cruise')->firstOrFail();
        $nile_cruise->publish();
        $catIds = $nile_cruise->children->pluck('id')->merge([$nile_cruise->id])->toArray();
        $tours = Tour::whereHas('categories', fn($q) => $q->wherein('id', $catIds))->limit(6)->get();
        $countries = Country::all();
        $blogs = Blog::where('enabled', true)->orderBy('id', 'desc')->limit(6)->get();
        return view('site.nile-cruise.index', compact('blogs', 'nile_cruise', 'countries', 'tours'));
    }

    public function NileCruiseDetails($slug)
    {

        $category = Category::with('seo')->where(fn($query) => $query->whereTranslation('slug', $slug))->first();
        $tours = null;
        if ($category) {
            $category->publish();
            $tours = Tour::whereHas('categories', fn($q) => $q->whereId($category->id))
                ->get();
        } else {
            SiteSeo::publishPage(__('site.nile_cruise'), SiteSeo::siteDescription());
        }
        return view('site.nile-cruise.details', compact('tours'));
    }
}
