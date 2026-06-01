<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\FaqCategory;


class FaqController extends Controller
{
    public function index(Request $request,$id=null){
        $faqs=[];
        $categories=FaqCategory::all();
        if($id){
            $faqs = Faq::with('category')
            ->where('category_id', $id)
            ->get();
        }else{
                $faqs = Faq::all();

        }
    return view('site.faq.index',compact('faqs',"categories"));
}
}
