<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Tour;
use App\Enums\SettingKey;
use App\Models\Setting;
use App\Models\Comment;
use App\Support\SiteSeo;


class AboutController extends Controller
{
    public function index()
    {
        $employees=Employee::all();
        $comments=Comment::all();

        SiteSeo::publishPage(__('site.about_us'), SiteSeo::siteDescription());

        return view('site.about.index',compact('employees','comments'));
    }
    public function terms()
    {
        SiteSeo::publishPage(__('site.terms_and_conditions'), SiteSeo::siteDescription());

        return view('site.terms.index');
    }
    public function privacy()
    {
        SiteSeo::publishPage(__('site.privacy_policy'), SiteSeo::siteDescription());

        return view('site.privacy.index');
    }
    public function teams(){
        $employees=Employee::all();
        return view('site.team.index',compact('employees'));
    }
    public function gallery()
    {   $settings = Setting::all();
        $gallery=$settings->firstWhere('option_key', \App\Enums\SettingKey::GALLERY->value)?->option_value ?? [];
        $our_group=$settings->firstWhere('option_key', \App\Enums\SettingKey::OUR_GROUP->value)?->option_value ?? [];
        return view('site.gallery.index' ,compact('gallery','our_group'));
    }
    public function cal(){
        $tour=Tour::where('id',8)->first();
        // dd(json_decode($tour->available,true));
        return view('site.calender',compact('tour'));
    }
}
