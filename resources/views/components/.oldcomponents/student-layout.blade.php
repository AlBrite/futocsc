@props(['title', 'sidebar'])
@php
    if (empty($title)) {
        $title = "CSC Portal";
    }
    if (empty($sidebar)) {
        $sidebar = false;
    }
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Your CSS File -->
    <link rel="stylesheet" href="{{asset('css/student/student-courses.css')}}"> <!-- Write your CSS in this file alrady created for you -->
    <title>Student - {{$title}}</title>
</head>
<body>
    <div id="overlay" class="overlay">
        <img src="{{asset('svg/logo.svg')}}" alt="">
        <div class="spinner"> </div>
    </div>
    <main>
        <nav>
            <div class="nav--top flex align-center gap-small">
                <img src="{{asset('svg/logo.svg')}}" alt="logo" width="40">
                <div>
                    <p class="font-size-1 text-body-600 weight-600">Department of Computer Science</p>
                    <p class="font-size-small text-body-400 weight-400">Federal University of Technology, Owerri</p>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="home.html"><span class="material-symbols-rounded">home</span> Home</a></li>
                <li><a href="courses.html" class="active"><span class="material-symbols-rounded">book_2</span> Courses</a></li>
                <li><a href="results.html"><span class="material-symbols-rounded">school</span> Results</a></li>
                <li><a href="profile.html"><span class="material-symbols-rounded">account_circle</span> Profile</a></li>
                <li><a href="settings.html"><span class="material-symbols-rounded">settings</span> Settings</a></li>
                <li><a href="/index.html"><span class="material-symbols-rounded">logout</span> Logout</a></li>
            </ul>
        </nav>
        <section>
            <x-Header/>
            <div class="small-screen-nav-content">
                <div class="small-search-div">
                    <label for="search"><button class="material-symbols-rounded" id="small-search-btn">search</button></label>
                    <input type="search" name="search" id="small-search" placeholder="Search...">
                </div>
                <ul class="nav-links">
                    <li><a href="home.html"><span class="material-symbols-rounded">home</span> Home</a></li>
                    <li><a href="courses.html" class="active"><span class="material-symbols-rounded">book_2</span> Courses</a></li>
                    <li><a href="results.html"><span class="material-symbols-rounded">school</span> Results</a></li>
                    <li><a href="profile.html"><span class="material-symbols-rounded">account_circle</span> Profile</a></li>
                    <li><a href="settings.html"><span class="material-symbols-rounded">settings</span> Settings</a></li>
                    <li><a href="/index.html"><span class="material-symbols-rounded">logout</span> Logout</a></li>
                </ul>
            </div>

            <div class="{{$sidebar ? 'container':'one-container'}} gap-2">
                
                <div class="container-left">
                    <div class="title">
                        <p class="text-body-300 weight-600 font-size-5">{{$title}}</p>
                    </div>
                    <div class="app y-scroll">
                        {{$slot}}
                    </div>
                </div>
                @if ($sidebar)
                    <div class="container-right">
                    </div>
                @endif
            </div>
        </section>
    </main>

    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/student/student-courses.js')}}"></script>
    <!-- Add the link to your own JavaScript file below this comment -->
</body>
</html>