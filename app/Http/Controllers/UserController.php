<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function doLogout(Request $request) {
        dd('Hello');
        dd([$request]);
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }


    public function updateProfile(Request $request) {
       
        $formFields = $request->validate([
            'firstname' => 'sometimes|regex:/^([a-zA-Z]+)$/',
            'lastname' => 'sometimes|regex:/^([a-zA-Z]+)$/',
            'middlename' => 'sometimes|regex:/^([a-zA-Z]+)$/',
            'email' => 'sometimes|email', // Rule::unique('users')],
            'phone' => 'sometimes',
            'password' => 'sometimes|confirmed',
            'oldPassword' => [
                'sometimes',
                function($attribute, $value, $fail) {
                  
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Old password didn\'t match');
                    }
                }
            ], // Rule::unique('users')
            'address' => 'sometimes',
            'level' => 'sometimes'
        ]);
        

        $updatable = Arr::except($formFields, ['firstname', 'lastname', 'middlename', 'oldPassword']);
        $name = null;
        if($request->has('firstname')) {
            $name = $request->firstname;
        }
        if($request->has('middlename')) {
            $name .= ' '.$request->middlename;
        }
        if($request->has('lastname')) {
            $name .= ' '.$request->lastname;
        }
        if ($name) {
            $updatable['name'] = $name;
        }

        
       
        
        
        $authUser = auth()->user();
        
        $instance = $authUser->profile;
        
        $fillable = $instance->getFillable();

        if ($request->has('password')) {
            $updatable['password'] = bcrypt($formFields['password']);
        }
        
        if ($request->hasFile('profileImageSelect')) {
            $instance->image = $request->file('profileImageSelect')->store('pic', 'public');
        }
       foreach($updatable as $column => $value) {
        if (in_array($column, $fillable)) {
            $instance->$column = $value;
        }
       }

        
        $instance->update();

        $authUser->update($updatable);


        return back()->with('success','Profile UPdated');

    }

}
