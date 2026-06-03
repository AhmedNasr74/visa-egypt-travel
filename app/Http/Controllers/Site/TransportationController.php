<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Support\SiteSeo;

class TransportationController extends Controller
{
    public function index()
    {
        SiteSeo::publishPage(__('site.transportation'), SiteSeo::siteDescription());

        return view('site.transportation.index');
    }
}
