<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
        <title>CSC Portal</title>
    </head>
    <body class="bg-green-100">   
        <div class="grid h-screen place-items-center">
            
            <form id="logArea" action="/dologin" method="post" class="bg-white shadow-lg border border-gray-300 p-5 rounded-md">
                @csrf
                @error('login_info')
                    <div id="login_info" class="m3 alert alert-danger text-center not-empty">{{ $message }}</div>
                @enderror

                @if (request()->has('callbackUrl')) 
                    <input type="hidden" name="callbackUrl" value="{{request()->callbackUrl}}"/>
                @endif
               

                <div class="login--top flex align-center gap-1 p-x-1 mb-4">
                    <img src="{{asset('svg/logo.svg')}}" alt="logo" width="48">
                    <div>
                        <p class="font-size-2 text-body-600 weight-600">Department of Computer Science</p>
                        <p class="font-size-1 text-body-400 weight-400">Federal University of Technolog, Owerri</p>
                    </div>
                </div>


                <div class="sb-card-body">

                    <div class="input-group mb-3" id="login_usermail">
                        <input type="text" data-input-label="UserMail" class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2"
                            autocomplete="off" aria-label="Username" id="usermail" name="usermail"
                            aria-describedby="basic-addon1" placeholder="Email or Phone or Username"
                            value="{{ old('usermail') }}"
                        >
                        @error('usermail')
                            <div class="text-red-600 text-sm bg-red-100 px-2 py-1 mt-2 rounded-md">{{ $message }}</div>
                        @enderror
                    </div>
                    


                    <div class="input-groupX mb-3">
                        
                        <input type="password"
                            data-input-label="Password" 
                            class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2"
                            placeholder="Password"
                            autocomplete="off" 
                            aria-label="password" 
                            id="password"
                            name="password" aria-describedby="basic-addon2" data-password="input"
                        >
                        @error('password')
                            <div class="text-red-600 text-sm bg-red-100 px-2 py-1 mt-2 rounded-md">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label for="remember" class="form-check-label">
                            {{ __('Stay Logged in') }}
                        </label>

                    </div>


                </div>

                <div class="mb-4">
                    <div class="float-rightx">
                        <input type="hidden" name="submit" value="Login">

                        <input type="submit" class="bg-green-500 text-white outline-0 font-bold w-full py-2 px-3 rounded-md" value="Login">
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix text-center text-muted small">
                    <span class="signupin-area">
                        <a href="/register">Create account</a> &nbsp;&nbsp;or&nbsp;&nbsp;
                    </span><a href="#">Need help?</a>
                </div>
            </form>
            
        </div>

        <img src="http://127.0.0.1:8000/svg/frame.svg" alt="frame" class="absolute bottom-0 right-0">
        
    </body>
</html>