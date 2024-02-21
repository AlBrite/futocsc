<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function load_comments(Comment $comment) {
        $comments = $comment->replies;
        return view('components.replies', compact('comments'));
    }

    public function home() {
        $posts = Post::latest()->paginate(10);
        return view('posts.home', compact('posts'));
    }
   

    public function store(Request $request) {
        if (!$request->hasFile('attachment') && empty(request('status'))) {
            return back()->withErrors(['status'=>'This field is required'])->onlyInput();
        }

        $formFields = [];

        if (request('status') ?? false) {
            $formFields['text'] = $request->input('status');
        }
        $formFields['user_id'] = auth()->id();
        
        $post = Post::create($formFields);

        return back()->with('message', 'Post Updated');
    }

    public function delete(Post $post) {
        
        if (Session::token() !== request()->input('_token')) {
            abort(403, 'CSRF token mismatch');
        }

        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/')->with('message', 'error:Please log in to delete this post');
        }
        $user = Auth::user();

        // Check if the currently authenticated user is the owner of the post
        if ($user->id === $post->user_id) {
            // delete the post
            $post->delete();
            return redirect('/')->with('message', 'success:Post deleted');
        }

        
        return redirect('/')->with('message', "error:You do not have permission to delete this post");
    }

    public function storeReply(Request $request) {
        $formFields = $request->validate([
            'post_id' => 'required',
            'comment' => 'required',
            'reply_id' => 'sometimes'
        ]);

        
        $data = [];
        if ($formFields['reply_id'] ?? false) {
            $data['reply_id'] = $formFields['reply_id'];
        }
        
        $data['comment_text'] = $formFields['comment'];
        $data['user_id'] = auth()->user()->id;
        $post = Post::find($formFields['post_id']);
        $comment = $post->comments()->create($data);
        
        return back()->with('message', 'Comment added');
        
    }
    

    public function reactToPost(Request $request, Post $post, ?Comment $comment = null) {
        if (Session::token() !== request()->input('_token')) {
             abort(403, 'CSRF token mismatch');
        }
        
        $user_id = auth()->id();
        $reaction = $post->reaction;
        $reactions = [];
        if ($reaction) {
            $reactions = $reaction->where('user_id', $user_id);
        }
        
        if (count($reactions) > 0) {
            $reactions->first()->delete();
        }
        
        else {
            Reaction::create([
                'post_id' => $post->id,
                'user_id' => $user_id
            ]);
        }
        if ($request->ajax()) {
            $reaction = $reaction ? 0 : $reaction->count();
            $json = [
                'post_id' => $post->id,
                'reply_id' => null,
                'reactions' => $reaction,
            ];

            if ($comment && $reply_id = $comment->parent_id) {
                $json['reply_id'] = $reply_id;
            }

            return response()->json($json);

        }

        return back();
    }

}
