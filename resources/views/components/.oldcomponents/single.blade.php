<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">

<head>
    @include('partials.head', [
        'title' => 'Student - Home',
        'styles'   => 'styles/student/student.css'
    ])
    
</head>

<body  :class="{'dark': darkMode}" class="dark:bg-black md:h-screen md:overflow-hidden " x-data="{darkMode: localStorage.getItem('darkMode') === 'true', navIsOpen: window.innerWidth > 1024, open: false, showInfo: window.innerWidth > 1024, courseOpen: false}" @resize.window="handleResize">
    <script>function handleResize(){
        Alpine.store(window.innerWidth > 1024);
    }</script>
    <div id="overlay" :class="{'hidden':courseOpen||open, 'flex':!courseOpen&&!open}"></div>

    @include('partials.header')

    <main class="xl:flex">
        <nav x-show="navIsOpen" class="w-[16rem] h-screen overflow-hidden fixed flex-col gap-2 pl-2 pr-1 bg-white top-0 z-10 shadow-2xl
        xl:flex xl:overflow-y-hidden xl:relative xl:w-[16rem] shrink-0 xl:h-screen xl:shadow-none xl:border-r xl:border-r-slate-300 flex">


            

            <div id="nav" class="overflow-hidden">
                <a href="./index.html" class="active"><span class="material-symbols-rounded">home</span>Home</a>
                <a href="./courses.html"><span class="material-symbols-rounded">book_2</span>Courses</a>
                <a href="./results.html"><span class="material-symbols-rounded">school</span>Results</a>
                <a href="./profile.html"><span class="material-symbols-rounded">account_circle</span>Profile</a>
                <a href="./settings.html"><span class="material-symbols-rounded">settings</span>Settings</a>
                <a href="/index.html"><span class="material-symbols-rounded">logout</span>Logout</a>


                <a href="./index.html" class="active"><span class="material-symbols-rounded">home</span>Home</a>
                <a href="./courses.html"><span class="material-symbols-rounded">book_2</span>Courses</a>
                <a href="./results.html"><span class="material-symbols-rounded">school</span>Results</a>
                <a href="./profile.html"><span class="material-symbols-rounded">account_circle</span>Profile</a>
                <a href="./settings.html"><span class="material-symbols-rounded">settings</span>Settings</a>
                <a href="/index.html"><span class="material-symbols-rounded">logout</span>Logout</a>



                <a href="./index.html" class="active"><span class="material-symbols-rounded">home</span>Home</a>
                <a href="./courses.html"><span class="material-symbols-rounded">book_2</span>Courses</a>
                <a href="./results.html"><span class="material-symbols-rounded">school</span>Results</a>
                <a href="./profile.html"><span class="material-symbols-rounded">account_circle</span>Profile</a>
                <a href="./settings.html"><span class="material-symbols-rounded">settings</span>Settings</a>
                <a href="/index.html"><span class="material-symbols-rounded">logout</span>Logout</a>



                <a href="./index.html" class="active"><span class="material-symbols-rounded">home</span>Home</a>
                <a href="./courses.html"><span class="material-symbols-rounded">book_2</span>Courses</a>
                <a href="./results.html"><span class="material-symbols-rounded">school</span>Results</a>
                <a href="./profile.html"><span class="material-symbols-rounded">account_circle</span>Profile</a>
                <a href="./settings.html"><span class="material-symbols-rounded">settings</span>Settings</a>
                <a href="/index.html"><span class="material-symbols-rounded">logout</span>Logout</a>
            </div>
        </nav>

        <section class="grow">
            
          

            <div id="app" class="mt-12 p-2 md:overflow-y-auto relative
            lg:overflow-y-visible ">
                <!-- Additional styles in student.css -->
                <div class="lg:h-[100%] lg:overflow-y-auto select-none">
                    <h1 class="text-lg text-body-300 font-semibold">Dashboard</h1>

                    <div class="courses mt-2" id="dashboard-cards">
                        <!-- DASHBOARD CARD -->
                        <div class="overflow-hidden bg-primary-50 rounded-md h-40 p-4 flex flex-col justify-between shadow">
                            <div class="flex items-center gap-2 text-black-300">
                                <span class="material-symbols-rounded">
                                    auto_stories
                                </span>
                                <p>Courses Registered</p>
                            </div>
                            <div class="flex justify-end text-primary-300">
                                <p class="text-[2.5rem] font-semiboold">71</p>
                            </div>
                        </div>

                        <div class="overflow-hidden bg-secondary-50 rounded-md h-40 p-4 flex flex-col justify-between shadow">
                            <div class="flex items-center gap-2 text-black-300">
                                <span class="material-symbols-rounded">
                                    bar_chart
                                </span>
                                <p>Results Published</p>
                            </div>
                            <div class="flex justify-end text-secondary-300">
                                <p class="text-[2.5rem] font-semiboold">55</p>
                            </div>
                        </div>

                        <div class="overflow-hidden bg-danger-50 rounded-md h-40 p-4 flex flex-col justify-between shadow">
                            <div class="flex items-center gap-2 text-black-300">
                                <span class="material-symbols-rounded">
                                    grade
                                </span>
                                <p>CGPA</p>
                            </div>
                            <div class="flex justify-end text-danger-300">
                                <p class="text-[2.5rem] font-semiboold">4.55</p>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-lg text-body-300 font-semibold mt-8">Semester Courses</h1>

                    <div class="mt-2 overflow-x-auto min-w-full max-w-full">
                        <table class="table table-auto min-w-full">
                            <thead>
                                <th class="w-20">Course Code</th>
                                <th>Course Title</th>
                                <th class="w-20">Units</th>
                                <th class="w-20">Type</th>
                                <th class="w-20"></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="uppercase">Course_Code</td>
                                    <td>Course_Title</td>
                                    <td>Units</td>
                                    <td class="uppercase">Compulsory</td>
                                    <td>
                                        <button @click="courseOpen = true"
                                            class="text-xs font-semibold p-[.3rem] rounded text-white bg-[var(--primary)] hover:bg-[var(--primary-700)] transition"
                                            type="button">
                                            View details
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div  x-show="showInfo" x-transition id="details" class="fixed top-12 right-0 bg-white flex-col gap-2 overflow-y-auto w-80 p-2 shadow-lg
                lg:h-[100%] lg:relative lg:top-0 lg:shadow-none lg:p-1 lg:col-span-1 lg:w-auto
                xl:col-span-2 lg:flex">

                    <div class="rounded border border-slate-400 flex flex-col gap-4 items-center px-4 py-16">
                        <img src="../../assets/images/user.jpg" alt="user_img" class="w-32 h-32 object-cover rounded-full">

                        <div class="flex flex-col items-center gap-1 text-center">
                            <h1 class="text-body-800 text-2xl">
                                Student Full Name
                            </h1>
                            <p class="text-slate-800">
                                Student Reg Number
                            </p>
                            <p class="text-slate-600 text-sm">
                                Class:
                                <span class="font-semibold text-slate-800">
                                    20XX-20YY
                                </span>
                            </p>
                            <p class="text-slate-600 text-sm">Advisor:
                                <span class="font-semibold text-slate-800">
                                    Advisor Name
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-primary-50 rounded flex items-center justify-center p-1 gap-4">
                        <div class="flex flex-col items-center justify-end">
                            <p class="text-secondary-800 text-lg">20XX/20YY</p>
                            <p class="text-body-300">session</p>
                        </div>
                        <span class="bg-secondary-800 w-[1px] h-10"></span>
                        <div class="flex flex-col items-center justify-end">
                            <p class="text-secondary-800 text-lg">Harmattan</p>
                            <p class="text-body-300">semester</p>
                        </div>
                    </div>

                    <div
                        class="notice-card bg-primary-50 rounded w-full h-full pl-4 pr-14 pt-10 pb-4 flex flex-col justify-between items-start relative ">
                        <p class="text-lg text-secondary-800 z-10">
                            XX days left for course registration, register now to access your results
                        </p>
                        <a href="./course-registration.html">
                            <button type="button"
                                class="btn bg-[var(--primary)] rounded text-white hover:bg-[var(--primary-700)] transition">
                                Register Courses
                            </button>
                        </a>
                        <img src="../../assets/images/frame.svg" alt="frame" class="absolute bottom-0 right-0 ">
                    </div>
                </div>


                <div id="student-course-details-home" x-show="courseOpen" @click.outside="courseOpen = false" x-transition class="fixed h-[100dvh] w-[100dvw] top-0 right-0 p-4 bg-white flex flex-col gap-2 overflow-y-auto z-50
                md:shadow-lg
                lg:border lg:border-slate-400">

                    <div class="flex center">
                        <span @click="courseOpen = false"
                            class="material-symbols-rounded select-none cursor-pointer font-semibold text-3xl text-red-500">
                            close
                        </span>
                    </div>

                    <div class="h-32 grid grid-cols-3 gap-2 border border-slate-300 shrink-0">
                        <img class="col-span-1 h-full object-cover" src="../../assets/images/course_image_default.svg"
                            alt="default_course_img">

                        <div class="col-span-2 flex flex-col justify-center">
                            <p
                                class="text-lg font-semibold text-body-800 select-none whitespace-nowrap text-ellipsis overflow-hidden">
                                Course title goes here
                            </p>
                            <p class="flex items-center select-none">
                                <span class="text-sm text-body-400 pr-2 border-r border-r-slate-[var(--body-300)]">
                                    CSC XYZ
                                </span>
                                <span class="text-sm text-body-300 pl-2 border-l border-l-slate-[var(--body-300)]">
                                    3 units
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="h-32 p-2 flex flex-col gap-2 shrink-0">
                        <p class="text-sm font-semibold text-body-300">
                            Marks distribution
                        </p>
                        <!-- If the course has practical -->
                        <div class="flex flex-col gap-3">
                            <div class="grid grid-cols-5">
                                <span class="col-span-1 p-3 flex center font-bold bg-accent-200">
                                    20%
                                </span>
                                <span class="col-span-1 p-3 flex center font-bold bg-secondary-200">
                                    20%
                                </span>
                                <span class="col-span-3 p-3 flex center font-bold bg-primary-200 rounded-r-full">
                                    60%
                                </span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1 font-semibold text-body-500 text-sm">
                                    <div class="w-3 h-3 bg-accent-200 rounded-full"></div>
                                    test
                                </div>
                                <div class="flex items-center gap-1 font-semibold text-body-500 text-sm">
                                    <div class="w-3 h-3 bg-secondary-200 rounded-full"></div>
                                    practical
                                </div>
                                <div class="flex items-center gap-1 font-semibold text-body-500 text-sm">
                                    <div class="w-3 h-3 bg-primary-200 rounded-full"></div>
                                    exam
                                </div>
                            </div>
                        </div>
                        <!-- If the course has practical -->

                        <!-- If the course does not have practical -->
                        <div class="flex-col gap-3 hidden">
                            <div class="grid grid-cols-10">
                                <span class="col-span-3 p-3 flex center font-bold bg-accent-200">30%</span>
                                <span
                                    class="col-span-7 p-3 flex center font-bold bg-primary-200 rounded-r-full">70%</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1 font-semibold text-body-500 text-sm">
                                    <div class="w-3 h-3 bg-accent-200 rounded-full"></div>
                                    test
                                </div>
                                <div class="flex items-center gap-1 font-semibold text-body-500 text-sm">
                                    <div class="w-3 h-3 bg-primary-200 rounded-full"></div>
                                    exam
                                </div>
                            </div>
                        </div>
                        <!-- If the course does not have practical -->
                    </div>

                    <div style="height: calc(100dvh - 22.5rem);" class="p-2 flex flex-col gap-2 shrink-0">
                        <p class="text-sm font-semibold text-body-300">Course Description</p>
                        <div class="border border-slate-300 rounded overflow-y-auto p-1 text-sm text-body-500">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium sint vitae ut earum
                            aliquid dolor dicta,
                            in saepe nesciunt assumenda. Debitis doloribus enim magni, expedita error tempora repellat
                            eveniet officia!
                            Ducimus eveniet, commodi veniam possimus beatae natus repudiandae perferendis aliquid quae
                            unde veritatis
                            recusandae sit doloribus repellendus, illum cumque ex. Laudantium, atque sint nisi
                            cupiditate id porro
                            voluptatibus eveniet et?
                            Hic perferendis reiciendis deleniti architecto unde cum nam earum repudiandae ipsam harum
                            autem ab quaerat
                            optio dolores alias ea excepturi dolor, fuga a laborum? Natus iure enim tenetur culpa
                            maiores.
                            Amet perferendis reiciendis labore consequatur. Ullam, aspernatur tempora. Totam maxime
                            officia saepe
                            laboriosam optio velit recusandae, mollitia quibusdam odit labore repellendus nobis id
                            beatae provident
                            rerum quod deserunt cum animi.
                        </div>
                    </div>

                    <div class="px-3 grid center absolute bottom-4 left-[50%] -translate-x-[50%]">
                        <button @click="courseOpen = false" type="button" class="flex flex-col center text-secondary-800 font-semibold">
                            <span class="material-symbols-rounded overflow-hidden">expand_less</span>
                            <p class="text-sm -mt-2">close</p>
                        </button>
                    </div>
                </div>
                <!--  -->
            </div>
        </section>
    </main>
</body>
<script type="module" src="{{asset('scripts/main.js')}}"></script>
<script type="module" src="{{asset('scripts/student.js')}}"></script>
<script type="module" src="{{asset('scripts/base.js')}}"></script>

</html>