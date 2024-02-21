<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Your CSS File -->
    <link rel="stylesheet" href="{{asset('css/student/student-home.css')}}"> <!-- Write your CSS in this file alrady created for you -->
    <title>Student - Home</title>
</head>

<body>
    <div id="overlay" class="overlay">
        <img src="/src/assets/logo.svg" alt="">
        <div class="spinner"> </div>
    </div>
    <main>
        <nav>
            <div class="nav--top flex align-center gap-small">
                <img src="/src/assets/logo.svg" alt="logo" width="40">
                <div>
                    <p class="font-size-1 text-body-600 weight-600">Department of Computer Science</p>
                    <p class="font-size-small text-body-400 weight-400">Federal University of Technology, Owerri</p>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="home.html" class="active"><span class="material-symbols-rounded">home</span> Home</a></li>
                <li><a href="courses.html"><span class="material-symbols-rounded">book_2</span> Courses</a></li>
                <li><a href="results.html"><span class="material-symbols-rounded">school</span> Results</a></li>
                <li><a href="profile.html"><span class="material-symbols-rounded">account_circle</span> Profile</a></li>
                <li><a href="settings.html"><span class="material-symbols-rounded">settings</span> Settings</a></li>
                <li><a href="/index.html"><span class="material-symbols-rounded">logout</span> Logout</a></li>
            </ul>
        </nav>
        <section>
            <header>
                <div class="small-screen-nav flex align-center gap-2">
                    <div>
                        <span class="material-symbols-rounded text-primary-700 pointer" id="menu">menu</span>
                    </div>
                    <div class="flex align-center gap-small">
                        <img src="/src/assets/logo.svg" alt="logo" width="35">
                        <p class="text-primary weight-600 font-size-5">CSC-FUTO</p>
                    </div>
                </div>
                <div class="search-div">
                    <label for="search"><button class="material-symbols-rounded" id="search-btn">search</button></label>
                    <input type="search" name="search" id="search" placeholder="Search...">
                </div>
                <div class="top-right flex align-center gap-2">
                    <div class="icons flex align-center gap-2">
                        <a href="profile.html"><span class="material-symbols-rounded">account_circle</span></a>
                        <a href="settings.html"><span class="material-symbols-rounded">settings</span></a>
                    </div>
                    <div class="details flex gap-1 align-center">
                        <div class="image-container hidden">
                            <img src="{{asset('images/assets/user.jpg')}}" alt="user-image" class="fit rounded">
                        </div>
                        <div class="user-info">
                            <p class="font-size-1 text-body-800 weight-600">Amalagu Cosmos</p>
                            <p class="font-size-small text-body-200 weight-400">amalagucosmos@example.com</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="small-screen-nav-content">
                <div class="small-search-div">
                    <label for="search"><button class="material-symbols-rounded" id="small-search-btn">search</button></label>
                    <input type="search" name="search" id="small-search" placeholder="Search...">
                </div>
                <ul class="nav-links">
                    <li><a href="home.html" class="active"><span class="material-symbols-rounded">home</span> Home</a></li>
                    <li><a href="courses.html"><span class="material-symbols-rounded">book_2</span> Courses</a></li>
                    <li><a href="results.html"><span class="material-symbols-rounded">school</span> Results</a></li>
                    <li><a href="profile.html"><span class="material-symbols-rounded">account_circle</span> Profile</a></li>
                    <li><a href="settings.html"><span class="material-symbols-rounded">settings</span> Settings</a></li>
                    <li><a href="/index.html"><span class="material-symbols-rounded">logout</span> Logout</a></li>
                </ul>
            </div>

            <div class="personal-details">
                <button class="btn-small-primary" id="toggle-btn">Show Personal Details</button>
            </div>

            <div class="container">
                <div class="container-left">
                    <div class="title">
                        <p class="text-body-300 weight-600 font-size-5">Semester Courses</p>
                    </div>
                    <div class="app y-scroll">
                        <!-- Write your code here: Do not use a <main></main> tag!!!-->

                        <!-- List of courses. Should be rendered from the database -->
                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>

                        <div class="semester-course-card border radius">
                            <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image">
                            <p class="text-body-500 weight-600">Course title goes here</p>
                            <p class="flex align-center gap-1">
                                <span class="text-body-300 weight-400">CSC XYZ</span>
                                <span class="divider"></span>
                                <span class="text-body-200 weight-400">3 Units</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container-right flex-column gap-2">
                    <div class="student-info border radius padding-2">
                        <img src="{{asset('images/user.jpg')}}" alt="student-image">
                        <p class="text-body-800 weight-500 font-size-5">Student Full Name</p>
                        <p class="text-black-300 weight-400">Student ID</p>
                        <p class="text-black-200 weight-400 font-size-2">Class:
                            <span class="text-black-400 weight-600">20XX-20YY</span>
                        </p>
                        <p class="divider-h"></p>
                        <p class="text-black-200 weight-400 font-size-2">Advisor:
                            <span class="text-black-400 weight-600">Adedero Chike</span>
                        </p>
                    </div>

                    <div class="session-info padding-1 primary-50 radius flex align-center justify-center gap-1">
                        <div class="flex-column align-center">
                            <p class="text-secondary-800 weight-400 font-size-4">20XX-20YY</p>
                            <p class="text-body-200 weight-400 font-size-2">Session</p>
                        </div>
                        <div class="divider"></div>
                        <div class="flex-column align-center">
                            <p class="text-secondary-800 weight-400 font-size-4">Harmattan</p>
                            <p class="text-body-200 weight-400 font-size-2">Semester</p>
                        </div>
                    </div>
                    <div class="notices">
                        <div class="notices-container">
                            <!-- List of notices. To be rendered from the Database -->
                            <div class="notice-card primary-50 radius">
                                <p class="text-secondary-800 weight-400 font-size-4">
                                    XX Days Left for
                                    course registration,
                                    register now to access
                                    your results
                                </p>
                                <button class="btn-small-primary">Register Courses</button>
                                <img src="{{asset('svg/frame.svg')}}" alt="design">
                            </div>
                            <div class="notice-card primary-50 radius">
                                <p class="text-secondary-800 weight-400 font-size-4">
                                    XX Days Left for
                                    course registration,
                                    register now to access
                                    your results
                                </p>
                                <button class="btn-small-primary">Register Courses</button>
                                <img src="{{asset('svg/frame.svg')}}" alt="design">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="/main.js"></script>
    <script src="/src/scripts/student/student-home.js"></script>
    <!-- Add the link to your own JavaScript file below this comment -->
</body>

</html>