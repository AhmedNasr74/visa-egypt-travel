<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\SeasonTour;
use App\Interface\UserCheck;
use App\Services\UserCountry;
use Illuminate\Http\Request;
use App\Models\Category;



class OffersController extends Controller
{

    public function offer(Request $request)
    {
        $category = Category::whereTranslation('slug', 'offers')->first();
        $offers = Tour::whereHas('categories', function ($query) {
            $query->whereTranslation('slug', 'offers');
        })->get();
        // dd($offers,$category);

          return view('site.offers.index', compact('offers','category'));

      }
      public function list(){
        $destinations=Destination::all();
        return view('site.destinations.destination_list',compact('destinations'));
      }
      
 }
