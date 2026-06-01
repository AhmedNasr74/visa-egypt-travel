<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index($page){
        $page=Page::where('key',$page)->first();
        return view('site.services.index',compact('page'));
    }
}
