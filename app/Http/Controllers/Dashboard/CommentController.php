<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Comment;
use App\Models\Blog;
use App\Models\Tour;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CommentRequest;
use App\DataTables\CommentDataTable;

class CommentController extends Controller
{

    public function index(CommentDataTable $dataTable)
    {
        return $dataTable->render('dashboard.comments.index');
    }


    public function create()
    {
        $relations=[
            'blogs'=>Blog::all(),
            'tours'=>Tour::all()
        ];
        return view('dashboard.comments.create',compact('relations'));
    }


    public function store(CommentRequest $request)
    {
        $comment = Comment::create($request->getSanitized());
        session()->flash('message', 'Comment Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.comments.edit', $comment);
    }


    public function show(Comment $comment)
    {
        //
    }


    public function edit(Comment $comment)
    {
        return view('dashboard.comments.edit', compact('comment'));
    }


    public function update(CommentRequest $request, Comment $comment)
    {
        $comment->update($request->getSanitized());
        session()->flash('message', 'Comment Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'message' => 'Comment Deleted Successfully!'
        ]);
    }
}
