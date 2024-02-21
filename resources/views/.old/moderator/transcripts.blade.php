
        <x-app>
        <div class="flex">
            <div class="flex-1">
                
                <div class="card">
                    <h1 class="card-header">Transcipts</h1>
                    <div class="card-body">
                        <span class="font-semibold text-sm text-primary">Click
                            <a target="_blank" href="./generated-transcript.html" class="text-secondary">
                                here
                            </a>
                            to see the generated transcript sample
                        </span>
    
                        <div class="w-full mb-4">
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
    
                        <div class="w-full lg:flex lg:gap-2">
                            <div class="max-h-full w-full">
                                <table class="table w-full whitespace-nowrap cursor-context-menu">
                                    <thead>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Reg. No.</th>
                                        <th class="hidden md:table-cell">Level</th>
                                        <th class="hidden md:table-cell">CGPA</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                            @php
                                                $user = $student->user;
                                                $cgpa = \App\Models\AcademicRecord::calculateCGPA($student);
                                            
    
                                            @endphp
                                            <tr>
                                                <td>
                                                    <x-profile-pic :user="$user" alt="student_img" class="h-8 w-8 object-cover rounded-md" style="height:30px;width:30px;"/>
                                                </td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$student->reg_no}}</td>
                                                <td class="hidden md:table-cell">{{$student->level}}</td>
                                                <td class="hidden md:table-cell">{{$cgpa}}</td>
                                                <td>
                                                    <button data-fetchStudent="{{$student->id}}" @click="formOpen = true" type="button"
                                                        class="text-white bg-green-600 hover:bg-green-700 transition rounded-md px-2 py-1">
                                                        Generate
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$students->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="w-80 bg-white flex flex-col gap-2 p-2 shadow-lg ">
                <div class="rounded border border-slate-400 flex flex-col gap-4 items-center px-4 py-16">
                    <x-profile-pic :user="$advisor" alt="user_img" class="w-32 h-32 object-cover rounded-full"/>

                    <div class="flex flex-col items-center gap-1 text-center">
                        <h1 class="text-body-800 text-2xl">
                           {{$advisor->user->name}}
                        </h1>
                        <p class="text-slate-800">
                            Staff ID
                        </p>
                        <p class="text-slate-600 text-sm">
                            Class:
                            <span class="font-semibold text-slate-800">
                                {{$advisor->academicSet->name}}
                            </span>
                        </p>
                        <p class="text-slate-600 text-sm">Current Level:
                            <span class="font-semibold text-slate-800 uppercase">
                                500 level
                            </span>
                        </p>
                    </div>
                </div>

                <div class="bg-green-100 rounded flex items-center justify-center p-1 gap-4">
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
                    class="sticky notice-card bg-primary-50 rounded w-full h-fit pl-4 pr-14 pt-10 pb-4 flex flex-col justify-between items-start ">
                    <p class="text-lg text-secondary-800 z-10">
                        XX days left for course registration, please remind the students to register before the time
                        runs out!
                    </p>
                    <img src="{{asset('svg/frame.svg')}}" alt="frame" class="absolute bottom-0 right-0 ">
                </div>

            </div>
        </div>



            <div x-cloak x-show="formOpen" @click.outside="formOpen=false" class="fixed top-[50%] left-[50%] -translate-x-[50%] -translate-y-[50%] bg-white rounded shadow-lg border border-slate-300 p-5 w-80 z-[1002]">
                <form id="generateTranscriptForm" action="{{route('generate.transcript')}}" class="grid gap-5" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <h1 class="font-semibold text-body-300 text-xl">Generate Transcript</h1>

                        <div class="flex justify-between items-center">
                            <label for="name" class="text-secondary-800 font-semibold text-sm">Name:</label>
                            <input type="text" id="name" value="Amalagu Chikezie"
                                class="border px-1 h-6 border-[var(--primary-100)] rounded text-body-300 font-semibold outline-none w-[75%] text-sm"
                                readonly>
                        </div>
                        <div class="flex items-center justify-between">
                            <label for="regNum" class="text-secondary-800 font-semibold text-sm">Reg.
                                No.:</label>
                            <input type="text" id="regNum" name="reg_no" value="20181097185"
                                class="border px-1 h-6 border-[var(--primary-100)] rounded text-body-300 font-semibold outline-none w-[75%] text-sm"
                                readonly>
                        </div>

                    </div>

                    <div x-data="{single: false, range: false}" class="flex flex-col gap-2">
                        <h1 class="font-semibold text-body-300">Options</h1>

                        <div class="flex items-center gap-1">
                            <input @click="single=false, range=false" type="radio" name="transcriptType"
                                id="full" value="full" checked>
                            <label for="full" class="text-secondary-800 font-semibold text-sm">Full</label>
                            <span class="text-sm text-body-300">(From year 1 to current year)</span>
                        </div>

                        <div class="flex items-center gap-1">
                            <input @click="single=true, range=false" type="radio" name="transcriptType"
                                id="single" value="single">
                            <label for="single" class="text-secondary-800 font-semibold text-sm">Single
                                Year</label>
                            <div class="select flex-1">
                                <select name="year" id="year" class="w-full" x-bind:disabled="!single">
                                    <option value="100">Year 1</option>
                                    <option value="200">Year 2</option>
                                    <option value="300">Year 3</option>
                                    <option value="400">Year 4</option>
                                    <option value="500">Year 5</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center gap-1 flex-wrap">
                            <input @click="single=false, range=true" type="radio" name="transcriptType"
                                id="range" value="range">
                            <label for="range" class="text-secondary-800 font-semibold text-sm">Range</label>

                            <div class="w-full">
                                <div class="select">
                                    <label for="startYear">From</label>
                                    <select name="startyear" id="startYear" x-bind:disabled="!range">
                                        <option value="100">Year 1</option>
                                        <option value="200">Year 2</option>
                                        <option value="300">Year 3</option>
                                        <option value="400">Year 4</option>
                                        <option value="500">Year 5</option>
                                    </select>
                                </div>
                                <span class="font-semibold">-</span>

                                <div class="select">
                                    <label for="endYear">To</label>
                                    <select name="endyear" id="endYear" x-bind:disabled="!range">
                                        <option value="100">Year 1</option>
                                        <option value="200">Year 2</option>
                                        <option value="300">Year 3</option>
                                        <option value="400">Year 4</option>
                                        <option value="500">Year 5</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    

                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Generate</button>
                        <button @click="formOpen=false" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>

                </form>
            </div>





            



</x-app>