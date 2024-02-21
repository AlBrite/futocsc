@php 

$advisor = auth()->user()->advisor;
$class = $advisor->academicSet;
$students = $class->students;

@endphp
<x-user-layout title="Class List" nav='class'>
    <div class="scroller">
        <div class="w-full lg:col-span-1">
            <x-page-header>
                <span>Students</span>
                
                <button type="button"
                    class="btn-primary transition text-sm">
                    Print Class List
                </button>

            </x-page-header>
            

            <div id="class-list-container" class="rounded px-3 py-3 overflow-y-auto mt-4">
                

                <form action="" id="student-search-form" class="row-span-1 flex items-center gap-1  lg:flex-col lg:items-start lg:row-span-1">
                    

                    <div class="flex items-center justify-between rounded border border-[var(--primary)] w-full md:w-auto lg:w-full">
                        <input type="search" name="searchStudent" id="student-search"
                            class="input m-0 full">
                        <button type="submit"
                            class="btn-primary !py-1 !m-0">
                            <span class="material-symbols-rounded">search</span>
                        </button>
                    </div>
                </form> 
            

                <ul class="row-span-6 mt-4 border-b border-b-[var(--black-100)] overflow-y-auto lg:row-span-5">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Name</td>
                                <td>Reg Number</td>
                                <td>Level</td>
                                <td>CGPA</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                
                                <tr>
                                    <td>
                                        <img src="{{asset('images/user.jpg')}}" alt="student_img" class="w-10 h-10 object-cover rounded-full"/>
                                    </td>
                                    <td>{{$student->user->name}}</td>
                                    <td>{{$student->reg_no}}</td>
                                    <td>{{$student->level}}</td>
                                    <td>{{$student->calculateCGPA()}}
                                </tr>
                            @endforeach
                        </tbody>
                        
                        
                    </table>
                </ul>
                
            </div>
        </div>

        <div
        x-show="detailsOpen"
        id="full-student-details"
        class="fixed top-12 left-[50%] -translate-x-[50%] w-[100dvw] h-[100dvh] pb-16 overflow-y-auto border border-slate-300 bg-white
        lg:relative lg:col-span-3 lg:w-auto lg:rounded lg:pb-4 lg:top-0 mt-[.5rem] lg:h-[unset]">
            <div class="flex gap-4 items-center p-4 bg-primary-50 rounded-t h-36 cursor-context-menu relative">
                <span
                @click="detailsOpen = false"
                class="material-symbols-rounded grid center overflow-hidden w-5 h-5 rounded text-red-500 absolute top-0 right-2 z-50 cursor-pointer lg:-z-10">close</span>
                <img src="../../assets/images/user.jpg" alt="student_img" class="w-28 h-28 object-cover rounded-full">
                <div class="z-20">
                    <h1 class="font-bold text-xl text-body-500">Student Full Name</h1>
                    <p class="text-body-300">Student ID</p>
                </div>
                <img src="../../assets/images/frame.svg" alt="frame" class="absolute right-0 bottom-0 w-28">
            </div>

            <div class="p-4">
                <div class="border border-slate-300 rounded p-2">
                    <p class="text-sm font-semibold text-secondary-800">Basic Information</p>

                    <ul class="text-sm flex gap-x-10 gap-y-5 flex-wrap whitespace-nowrap mt-2">
                        <li>
                            <p class="text-body-300">Phone</p>
                            <p class="text-body-400 font-semibold">08012345678</p>
                        </li>
                        <li>
                            <p class="text-body-300">Email</p>
                            <p class="text-body-400 font-semibold">amalagucosmos@example.com</p>
                        </li>
                        <li>
                            <p class="text-body-300">Level</p>
                            <p class="text-body-400 font-semibold">500</p>
                        </li>
                        <li>
                            <p class="text-body-300">CGPA</p>
                            <p class="text-body-400 font-semibold">4.55</p>
                        </li>
                        <li>
                            <p class="text-body-300">S/N</p>
                            <p class="text-body-400 font-semibold">123</p>
                        </li>
                        <li class="md:w-full">
                            <p class="text-body-300">Address</p>
                            <p class="text-body-400 font-semibold">148, Something Street, Owerri, Nigeria</p>
                        </li>
                    </ul>
                </div>

                <div id="chart-container" class="border border-slate-300 rounded p-2 mt-2 h-72 overflow-y-auto">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-secondary-800">Progress</p>
                        <div class="flex items-center gap-4 text-xs font-semibold text-body-400">
                            <div class="flex gap-1">
                                <label for="bar">bar chart</label>
                                <input type="radio" name="chartType" id="bar" checked>
                            </div>

                            <div class="flex gap-1">
                                <label for="line">line chart</label>
                                <input type="radio" name="chartType" id="line">
                            </div>
                        </div>
                    </div>
                    

                    <!-- Create an API to get the student's GPA and I will use it to populate these charts using Javascript -->
                    <canvas id="bar-chart" class="text-xs text-body-400 mt-2 w-full overflow-auto"></canvas>

                    <canvas id="line-chart" class="text-xs text-body-400 mt-2 w-full overflow-auto hidden"></canvas>
                </div>
            </div>

            <div class="grid center -mt-4 select-none lg:hidden">
                <button
                @click="detailsOpen = false"
                type="button" class="flex flex-col items-center text-secondary-800 hover:text-[var(--danger-600)]">
                    <span class="material-symbols-rounded overflow-hidden">expand_less</span>
                    <span class="text-sm font-semibold transition -mt-2">close</span>
                </button>
            </div>

        </div>
    </div>
</x-user-layout>