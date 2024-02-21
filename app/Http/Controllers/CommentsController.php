<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post) {
        $formFields = $request->validate([
            'comment_text' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;

        $comment = $post->comments()->create($formFields);

        return back()->with('message', 'success:Comment added');
    }

    public function storeReply(Request $request, Comment $comment) {
        $formFields = $request->validate([
            'comment_text' => 'required'
        ]);
        $formFields['user_id'] = auth()->user()->id;

        $comment->comments()->create($formFields);

        return back()->with('message', 'success:Comment added');
    }
}
