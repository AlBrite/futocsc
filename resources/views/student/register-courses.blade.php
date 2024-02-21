@php
    $requestedLevel = $_GET['level'] ?? null;
    $requestedSemester = $_GET['semester'] ?? null;

    $user = \App\Models\User::active();
    $student = $user->student;

    $courses = \App\Models\Course::getCourses(
    $_GET['level'] ?? null,
    $_GET['semester'] ?? null
    );
    $advisor = $student->advisor;
@endphp
<x-app title="Register Courses">
    <div class="flex">
        <div class="flex-1">
            <form class="card" method="POST" action="{{ route('insert.courses') }}">
                @csrf
                <div id="register-courses">
                    
                    @if ($courses && count($courses) > 0)
                        @if ($_GET['level']??null && $_GET['level'] > 100) 
                            <div class="flex justify-end">
            
                                <button class="btn btn-primary">Borrow Courses</button>
                            </div>
            
                        @endif
                        
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course Title</th>
                                        <th>Course Code</th>
                                        <th>Semester</th>
                                        <th>Level</th>
                                        <th>Unit</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    @php
                                        
                                        $options = [];
                                    @endphp
            
                                    @foreach ($courses as $course)
                                        @php
                                            $option = $course->mandatory == 1 ? 'Mandatory' : 'Elective';
                                        @endphp
                                        @if (!in_array($option, $options))
                                            <tr>
                                                <td colspan="6" style="font-weight:bold; text-align:center;">
                                                    {{ $option }}
                                                </td>
                                            </tr>
                                            @php $options[] = $option; @endphp
                                        @endif
            
                                        <tr>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->code }}</td>
                                            <td>{{ $course->semester }}</td>
                                            <td>{{ $course->level }} Level</td>
                                            <td>{{ $course->unit }}</td>
                                            <td><input type="checkbox" name="course[]" value="{{ $course->id }}"
                                                    {{ $course->mandatory == 1 ? 'checked' : '' }}></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <input type="submit" value="Register Courses" class="float-right btn btn-primary" />
                        </div>
                    @else
                        <x-error message="Semester and Level has not been selected. Contact Admin if you are experiencing difficulty registering courses"/>
                    @endif
                </div>
            </form>
        </div>
        <div class="w-40">
            <form class="card-header">
                <div>
                    <label for="semester">Semester:</label><br>
                    <select id="semester" name="semester" class="input">
                        <option value="harmattan" selected="{{$requestedSemester === 'harmattan'}}">Harmattan</option>
                        <option value="rain" selected="{{$requestedSemester === 'rain'}}">Rain</option>
                    </select>
                </div>
                <div>
                    <label>Level:</label><br>
                    <select name="level" class="input">
                        @foreach([100, 200, 300, 400, 500] as $level) 
                            <option value="{{$level}}" selected="{{$level == $requestedLevel}}">{{$level}}Level</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="retrieve-courses" class="btn btn-primary">Proceed</button>
            </form>
        </div>

    </div>
</x-app>