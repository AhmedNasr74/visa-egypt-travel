<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function rooms(){
        return view('site.room_details.rooms_list');
    }
    public function room_details($slug){
        return view('site.room_details.room_details');
    }
}
