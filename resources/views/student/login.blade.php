<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
     <!-- Add the link to your own CSS file below this comment -->
     <link rel="stylesheet" href="{{asset('css/login/login.css')}}">
    <title>CSC Portal - Login</title>
</head>
<body>
    <div id="overlay" class="overlay">
        <img src="{{asset('svg/logo.svg')}}" alt="">
        <div class="spinner"> </div>
    </div>
    <main class="flex center">
        <div class="login white-300 flex-column">
            <div class="login--top flex align-center gap-1 p-x-1">
                <img src="{{asset('svg/logo.svg')}}" alt="logo" width="48">
                <div>
                    <p class="font-size-2 text-body-600 weight-600">Department of Computer Science</p>
                    <p class="font-size-1 text-body-400 weight-400">Federal University of Technolog, Owerri</p>
                </div>
            </div>
            <form action="/dologin" method="POST">
                @csrf
                <div class="input-label">
                    <label for="username" class="font-size-4 weight-400 text-body-400 flex align-base gap-2">Username 
                        <span
                            class="font-size-2 text-danger" hidden id="username-label">Username cannot be empty
                        </span>
                    </label>
                    <input type="text" id="username" class="input" name="usermail" value="student@gmail.com">
                    @error('usermail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-label">
                    <label for="password" class="font-size-4 weight-400 text-body-400 flex align-base gap-2">Password 
                        <span
                            class="font-size-2 text-danger" hidden id="password-label">Password cannot be empty
                        </span>
                    </label>
                    <input type="password" id="password" name="password" class="input" value="passkey">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form--bottom flex space-between">
                    <div class="flex gap-1 align-center">
                        <input type="checkbox" id="remember" class="checkbox-small" name="remember">
                        <label for="remember" class="font-size-4 weight-400 text-body-400">Remember me</label>
                    </div>
                    <a href="#" class="font-size-4 weight-400 text-body-400">Forgot password</a>
                </div>
                <button type="submit" class="btn-primary" id="login-submit">Sign in</button>
            </form>
        </div>
    </main>
    <script src="{{asset('js/login.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>