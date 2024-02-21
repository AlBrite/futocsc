@php
    $user = \App\Models\User::active();
    $student = $user->student;
    $records = $student->courses;
    
    $set = $student->academicSet;
    $advisor = $set->advisor;
    $enrolledCourses = $student->courses;
    $cgpa = $student->calculateCGPA();
@endphp

<x-layout nav="home" title="Student Dashboard" css="css/student/student-home.css">
    

    <div class="md:flex  h-full">
        <div class="md:flex-1 w-[calc(100%-20rem)]">
            
            <div>
                <div class="mt-2 md:flex md:gap-5 md:mr-6">
                    <!-- DASHBOARD CARD -->
                    <div class="overflow-hidden bg-blue-100 rounded-lg h-40 md:w-80 p-4 flex-1 flex flex-col justify-between">
                        <div class="flex items-center gap-2 text-black-300">
                            <span class="material-symbols-rounded">
                                groups
                            </span>
                            <p class="text-lg">CGPA</p>
                        </div>
                        <div class="flex justify-end text-primary-300">
                            <p class="text-[2.5rem] font-semiboold">{{$cgpa}}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-red-100 rounded-lg h-40 md:w-80 flex-1 p-4 flex flex-col justify-between">
                        <div class="flex items-center gap-2 text-black-300">
                            <span class="material-symbols-rounded">
                            auto_stories
                            </span>
                            <p class="text-lg">Enrolled Courses</p>
                        </div>
                        <div class="flex justify-end text-danger-300">
                            <p class="text-[2.5rem] font-semiboold">{{$enrolledCourses->count()}}</p>
                        </div>
                    </div>
                    
                </div>
                <div class="mt-5">
                    <b>Courses Enrolled</b>
                    <div class="md:clear-both">
                        @if($records && $records->count() > 0)
                            @foreach($records as $record)
                            
                                <a href="{{route('view.course', ['course'=>$record->course])}}" class="group block md:float-left m-1 bg-white rounded-md shadow-md semester-course-card border radius relative">
                                    @if($record->course->mandatory === 0) 
                                    <span class="z-10  bg-red-500 rounded-br-md px-2 py-1 text-white text-sm absolute top-0 left-0">Elective</span>
                                    @endif
                                    
                                        <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image" class="transform group-hover:scale-110">
                                        <p class="text-body-500 weight-600 text-ellipsis h-4 whitespace-nowrap w-full">{{$record->course->name}}</p>
                                        <p class="flex align-center gap-1">
                                            <span class="text-body-300 weight-400">{{$record->course->code}}</span>
                                            <span class="divider"></span>
                                            <span class="text-body-200 weight-400">{{$record->course->unit}} Unit{{ $record->course->unit >1 ? 's':''}}</span>
                                        </p>
                                    </a>
                            @endforeach
                        @else

                            <div class="no-courses flex-col items-center justify-center ">
                                <div>
                                    <img src="{{asset('svg/no_courses.svg')}}" alt="">
                                </div>
                                <p class="text-center text-white-800 weight-400 font-size-5">
                                    Oops! It looks like you haven't registered for any courses yet.
                                    Register your courses before the deadline to ensure you can view them when they become available.
                                </p>
                                <div class="text-center mt-5">
                                    <a class="btn-primary inline-block" href="/student/register-courses">Register Courses</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="scrollable md:w-80   md:bg-white">
                <div class="student-info pt-4">
                    <div class="flex-1">
                        <div class="p-2 text-center">
                            <x-profile-pic :user="$student" src="{{asset('images/user.jpg')}}" alt="Student-Image" class="object-cover aspect-square rounded-full w-32"/>
                
                            <p class="text-body-800 weight-500 font-size-5">{{$user->name}}</p>
                            <p class="text-black-300 weight-400">{{$student->reg_no}}</p>
                            <p class="text-black-200 weight-400 font-size-2">Class:
                                <span class="text-black-400 weight-600">{{$set->name}}</span>
                            </p>
                            <p class="divider-h"></p>
                            <p class="text-black-200 weight-400 font-size-2">Advisor: 
                                <span class="text-black-400 weight-600">{{$advisor->user->name}}</span>
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
                                <a href="{{route('register.course')}}" class="btn-small-primary">Register Courses</a>
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
        </div>
    </div>
</x-layout>