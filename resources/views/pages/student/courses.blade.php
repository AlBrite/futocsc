@php 
    $user = auth()->user();
    $student = $user->student;
    $enrollments = $student->courseRegistrationPerSemester;
  
    $courses = true;

    $hasEnrolled = count($enrollments) > 0;
    $title = "Enrolled Courses";
    if (!$hasEnrolled) {
        $title = "Not Enrolled to any course";
    }

@endphp

<x-user-layout 
    title="{{$title}}" 
    nav='courses'
>

    @if($hasEnrolled)
        
        <x-page-header>
           Course Registration History
            
                <a href="/course-registration" class="btn-primary btn-sm">
                    Register Courses
                </a>
        </x-page-header>
    
        <div class="scroller">
            <div id="student-table-container-courses" class="mt-4 overflow-x-auto min-w-full max-w-full">
                <table class="responsive-table min-w-full whitespace-nowrap">
                    <thead>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Level</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                    
                            <tr>
                                <td>{{$enrollment->session}}</td>
                                <td>{{$enrollment->semester}}</td>
                                <td>{{$enrollment->level}}</td>
                                <td align="center">
                                    <a href="{{route('view.enrollment', [
                                            'semester' => $enrollment->semester,
                                            'level' => $enrollment->level
                                        ])}}">
                                        
                                        <button
                                            class="text-xs font-semibold p-[.3rem] rounded text-white bg-[var(--primary)] hover:bg-[var(--primary-700)] transition"
                                            type="button">
                                            View details
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else 
        <div id="no-courses" class="flex h-full p-2 overflow-y-scroll relative flex-col gap-5 items-center">
            <img
            class="w-72"
            src="{{asset('svg/no_courses.svg')}}" alt="no_courses_icon">
            <div class="flex flex-col items-center gap-5 text-center">
                <p class="text-white-800">
                    Oops! It looks like you haven't registered for any courses yet. <br>
                    Register your courses before the deadline to ensure you can view them when they become available.
                </p>
                
                <a href="/course-registration">
                    <button type="button" class="btn bg-[var(--primary)] rounded text-white hover:bg-[var(--primary-700)] transition">
                        Register Courses
                    </button>
                </a>
            </div>
        </div>
    @endif
    
    
</x-user-layout>
