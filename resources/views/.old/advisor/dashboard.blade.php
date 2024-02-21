@php 
$advisor = \App\Models\Advisor::active();
$class = $advisor->academicSets->first();
$students = $class->students();
$number_of_students_in_class = $students->count();
$allStudents = $students->cursorPaginate(5);
$number_of_semester_courses = 5;
$results = \App\Models\Result::with('course')->orderBy('level', 'desc');
$totalResultsUploaded = $results->count();

$results = $results->cursorPaginate(15);

@endphp


<x-user-layout title="Advisor's Dashboard" nav='home'>
    <!-- Additional styles in student.css -->
    <div class="lg:col-span-2 select-none pb-10 ">
    <div class="">
        <div class="overflow-y-auto">
            <h1 class="text-lg text-body-300 font-semibold">Dashboard</h1>

                <div class="mt-2 md:flex md:gap-5" id="dashboard-cards">
                    <!-- DASHBOARD CARD -->
                    <div class="overflow-hidden bg-blue-100 rounded h-40 md:w-80 p-4 flex-1 flex flex-col justify-between">
                        <div class="flex items-center gap-2 text-black-300">
                            <span class="material-symbols-rounded">
                                groups
                            </span>
                            <p class="text-lg">Students</p>
                        </div>
                        <div class="flex justify-end text-primary-300">
                            <p class="text-[2.5rem] font-semiboold">{{$number_of_students_in_class}}</p>
                        </div>
                    </div>
                    <div class="overflow-hidden bg-green-100 rounded h-40 md:w-80 flex-1 p-4 flex flex-col justify-between">
                        <div class="flex items-center gap-2 text-black-300">
                            <span class="material-symbols-rounded">
                            auto_stories
                            </span>
                            <p class="text-lg">Semester Courses</p>
                        </div>
                        <div class="flex justify-end text-danger-300">
                            <p class="text-[2.5rem] font-semiboold">71</p>
                        </div>
                    </div>
                    
            
                    <div class="overflow-hidden bg-red-100 rounded h-40 md:w-80 flex-1 p-4 flex flex-col justify-between">
                        <div class="flex items-center gap-2 text-black-300">
                            <span class="material-symbols-rounded">
                                bar_chart
                            </span>
                            <p class="text-lg">Results Uploaded</p>
                        </div>
                        <div class="flex justify-end text-danger-300">
                            <p class="text-[2.5rem] font-semiboold">{{$totalResultsUploaded}}</p>
                        </div>
                    </div>
                </div>
            
                <!-- Top 5 Students -->
                <div class="md:flex">
                    <div class="flex-1">
                        <div class="card mt-8">
                            <div class="card-header flex items-center">
                                <div class="flex gap-3 items-center">
                                    Top Five
                                    <span class="material-symbols-rounded">star</span>
                                </div>
                                <form class="flex-1 flex items-center gap-2 w-full relative md:w-[32rem">
                                    <label for="student-search" class="text-body-200 absolute top-3 left-1">
                                        <span class="material-symbols-rounded">search</span>
                                    </label>
                                    <input type="search" name="studentSearch" id="studentsearch" placeholder="Search student with name or Reg No"
                                        class="border border-green-500 rounded-md outline-none py-2 pl-8 text-body-300 w-full">
                                    
                                    <button type="submit"
                                        class="btn-primary">
                                        Search
                                    </button>
                                </form>
                            </div>
                        
                            <div class="card-body">
                                <table class="table w-[100%] whitespace-nowrap">
                                    <thead>
                                        <th></th>
                                        <th align="left" valign="middle">Student Name</th>
                                        <th align="left" valign="middle">Reg. Number</th>
                                        <th class="w-20" align="left" valign="middle">Level</th>
                                        <th class="w-20" align="left" valign="middle">CGPA</th>
                                    </thead>
                                    <tbody>
                                        @foreach($allStudents as $student)
                                        <tr>
                                            <td>
                                                <x-profile-pic :user="$student" alt="student_pic"
                                                    class="w-10 h-10 rounded-full object-cover"/>
                                            </td>
                                            <td align="left" valign="middle">{{$student->user->name}}</td>
                                            <td align="left" valign="middle">{{$student->reg_no}}</td>
                                            <td align="left" valign="middle">{{$student->level}}</td>
                                            <td align="left" valign="middle">{{$student->cgpa}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{$allStudents->links()}}
                            </div>
                        </div>
                    </div>

                    <div class="md:w-[300px] relative">
                        <div class="border-t-[4px] border-green-500 md:absolute md:left-[50%] md:m-4 md:p-5  md:top-[50%] shadow-lg bg-green-50 rounded-lg  md:-translate-x-[50%] md:-translate-y-[50%]">
                            <h3 class="text-green-500 font-bold text-center">
                                Add Student
                            </h3
                            <form method="POST" action="route('add.student')" class="ignore">
                                @csrf
                                
                                <input type="hidden" name="class_id" value="{{$advisor->academicSet->id}}"/>

                                <fieldset class="input-fieldset">
                                    <legend>Student Name</legend>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Student Name"/><br>
                                </fieldset>


                                <fieldset class="input-fieldset">
                                    <legend>Student Reg No</legend>
                                    <input type="text" name="reg" value="{{ old('reg') }}" placeholder="Student Reg No"/><br>
                                </fieldset>

                                <fieldset class="input-fieldset">
                                    <legend>Phone Number</legend>
                                    <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"/><br>
                                </fieldset>
                                
                                
                        
                                <fieldset class="input-fieldset">
                                    <legend>Email Address</legend>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"/><br>
                                </fieldset>



                                <input type="submit" class="btn-primary mt-3" value="Add Student" />
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
            
                <div class="card border-green-600 mt-8">
                    <div class="card-header">Results Uploaded</div>
                
                    <div class="card-body overflow-x-hidden">
                        <table class="table w-[100%] overflow-x-auto whitespace-nowrap">
                            <thead>
                                <th class="w-20">Code</th>
                                <th>Course Title</th>
                                <th class="w-20">Units</th>
                                <th class="w-20"></th>
                            </thead>
                            <tbody>
                                @foreach($results as $result)

                                @php 
                                    dd($result);
                                @endphp
                                
                                <tr>
                                    <td class="uppercase">{{$result->course->code}}</td>
                                    <td>{{$result->course->name}}</td>
                                    <td>{{$result->course->unit}}</td>
                                    <td>
                                        <a class="btn-primary" href="/display_results?session=2018%2F2019&semester=harmattan&course=1">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$results->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
</x-user-layout>


            

            
        