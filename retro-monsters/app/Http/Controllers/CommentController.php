<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);
    
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->monster_id = $request->input('monster_id');
        $comment->content = $request->input('content');
        $comment->save();
    
        return view('partials.comment', ['comment' => $comment])->render();
    }    

}
