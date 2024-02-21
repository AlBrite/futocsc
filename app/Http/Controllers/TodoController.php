<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{
    public function store(Request $request) {
       
        $request->validate([
            'todo' => 'required'
        ]);
        
        if (!auth()->check()) {
          return redirect()->route('login')->with('error', 'You are not logged in');  
        }
        $authId = auth()->user()->id;
        

        Todo::create([
            'title' => $request->todo,
            'user_id' => $authId
        ]);

        




        return redirect()->back()->with('success', 'Todo successfully added');
    }
}
