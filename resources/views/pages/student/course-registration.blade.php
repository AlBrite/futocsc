@php
    use \App\Models\Course;;
    $requestedLevel = request()->get('level');;
    $requestedSemester = request()->get('semester');;
    $requestedSession = request()->get('session');


    $chosenLevelAndSemester = $requestedLevel && $requestedSemester && $requestedSession;

    $user = \App\Models\User::active();
    $student = $user->student;

    $courses = Course::getCourses(
    $_GET['level'] ?? null,
    $_GET['semester'] ?? null
    );
    $advisor = $student->advisor;
@endphp
<x-user-layout nav='courses'>
    <x-page-header>
        Course Registration
    </x-page-header>
        @if (!$chosenLevelAndSemester) 
            <div class="grid h-full place-items-center">
                <form class="text-center">
                    <div>
                        <label for="semester">Semester</label><br>
                        <select id="semester" name="semester" class="input rounded-md p-1 w-full">
                            <option value="harmattan" selected="{{$requestedSemester === 'harmattan'}}">Harmattan</option>
                            <option value="rain" selected="{{$requestedSemester === 'rain'}}">Rain</option>
                        </select>
                    </div>
                    <div>
                        <label for="session">Session</label><br>
                        <select id="session" name="session" class="input rounded-md p-1 w-full">
                            @foreach(Course::generateSessions() as $session) 
                                <option value="{{$session}}">{{$session}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mt-2">
                        <label>Level</label><br>
                        <select name="level" class="input rounded-md p-1 w-full">
                            @foreach([100, 200, 300, 400, 500] as $level) 
                                <option value="{{$level}}" selected="{{$level == $requestedLevel}}">{{$level}} Level</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" id="retrieve-courses" class="btn btn-primary">Proceed</button>
                </form>
            </div>
        @else
            <div x-data="{minUnits:16, maxUnits:21, units:0, proceed: true}"   class="scroller">
                <div
                id="course-registration-container"
                class="flex flex-col gap-5 overflow-y-visible">
                    <div class="text-sm text-body-300 flex items-center justify-between">
                        <span :class="{'hidden':units==0}">Total units selected: 
                            
                            <span class="font-semibold" x-text="units" :class="{'text-red-500':units > maxUnits || units < minUnits, 'text-green-600':units < maxUnits && units > minUnits}"></span> 
                            out of 
                            <span class="font-semibold" x-text="maxUnits"></span> 
                            max units
                        </span>
                        <span :class="{hidden:units>=0}">
                            Unit Range (
                                min: <span class="font-semibold" x-text="minUnits"></span> 
                                max: <span class="font-semibold" x-text="maxUnits"></span> 
                            )

                        </span>

                        <a href="/course-registration-borrow-courses">
                            <button type="button" class="btn bg-[var(--primary)] rounded text-white hover:bg-[var(--primary-700)] transition text-sm">
                                Add/Borrow Courses
                            </button>
                        </a>
                    </div>
                    @if (request()->get('level') == 100)
                        <div class="text-xm py-5 text-red-500  italic">
                            It is required for 100 Level Students to register either IGB or FRN
                        </div>
                    @endif

                    <form method="POST" action="{{ route('insert.courses') }}">
                        @csrf

                        <input type="hidden" name="session" value="{{ $requestedSession }}"/>
                        <input type="hidden" name="level" value="{{ $requestedLevel }}" />
                        <input type="hidden" name="semester" value="{{ $requestedSemester }}"/>
                
                        <div>
                            <table class="responsive-table min-w-full whitespace-nowrap">
                                <thead class="print:bg-black print:text-white">
                                    <th class="w-10">Select</th>
                                    <th class="w-20">Course Code</th>
                                    <th>Course Title</th>
                                    <th class="w-20">Units</th>
                                    <th class="w-20">Type</th>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td><input type="checkbox" name="course[]" value="{{ $course->id }}" class="checkbox" x-on:change="units=units + ($el.checked ?{{$course->units}}:-{{$course->units}});$el.checked?$el.parentNode.parentNode.classList.add('bg-green-50'):$el.parentNode.parentNode.classList.remove('bg-green-50')"></td>
                                            <td class="uppercase">{{ $course->code }}</td>
                                            <td>{{$course->name}}</td>
                                            <td>{{ $course->units }}</td>
                                            <td class="uppercase">{{ $option = $course->mandatory == 1 ? 'Compulsory' : 'Elective'}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end">
                            <button x-bindx:disabled="!proceed && (units < minUnits || units > maxUnits)" type="submit" class="btn-primary">Register courses</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    
</x-user-layout>
            