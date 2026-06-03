<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Support\SiteSeo;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('enabled', true)
            ->with(['category'])
            ->paginate(6);
            $now = Carbon::now();
            $last_blogs = Blog::orderBy('id', 'desc')->take(5)->get();
            $categories=BlogCategory::all();
            $popularTags=$this->pop_tags();
            SiteSeo::publishPage(__('site.blog'), SiteSeo::siteDescription());

            return view('site.blog.index',compact('blogs','now','last_blogs','categories','popularTags'));
    }
    public function details($id){
        $blog = Blog::where('id', $id)
            ->with(['category', 'seo'])
            ->firstOrFail();
        $blog->publish();
        $last_blogs = Blog::orderBy('id', 'desc')->take(3)->get();
        $now = Carbon::now();
        $categories=BlogCategory::all();
        $popularTags=$this->pop_tags();

        return view('site.blog.show', compact('blog','last_blogs','now','categories','popularTags'));
    }
    public function blog_category($id){
        $blogs = Blog::whereHas('category', function ($query) use ($id) {
            $query->where('blog_categories.id', $id);
        })->where('enabled',true)->paginate(6);
        $now = Carbon::now();
        $last_blogs = Blog::orderBy('id', 'desc')->take(5)->get();
        $categories=BlogCategory::all();
        $category=BlogCategory::where('id',$id)->first();
        $popularTags=$this->pop_tags();
        return view('site.blog.category',compact('blogs','now','last_blogs','categories','category','popularTags'));

    }

    public function tag($tag)
{
    $blogs = Blog::where('tags', 'LIKE', "%$tag%")->paginate(6);
    $now = Carbon::now();
        $last_blogs = Blog::orderBy('id', 'desc')->take(5)->get();
        $categories=BlogCategory::all();
        $category=[];
        $popularTags=$this->pop_tags();
        return view('site.blog.category',compact('blogs','now','last_blogs','categories','tag','category','popularTags'));

}
public function pop_tags(){
    $blogs = DB::table('blogs')->get();
            $allTags = [];
            foreach ($blogs as $blog) {
                $tags = explode(',', $blog->tags);
                $allTags = array_merge($allTags, $tags);
            }
            $tagCounts = array_count_values($allTags);
            arsort($tagCounts);
            $popularTags = array_slice($tagCounts, 0, 6, true);
            return $popularTags;
}
}
