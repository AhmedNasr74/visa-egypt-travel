<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class TransportationController extends Controller
{
    public function index()
    {
        return view('site.transportation.index');
    }
}
