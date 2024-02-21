@php 
    $advisor = $user->advisor;
    $sets = $advisor->academicSet()->latest();
@endphp

@foreach ($sets as $set)
    <a class="text-dark" href="{{ route('view.academic_set', compact('set')) }}">
        <div class="card">
            <div class="card-body">
                <h1>{{ $set->name }}</h1>
                <div class="d-flex justify-content-between">

                    <div>
                        Course Advisor: <a
                            href="{{ route('profile.advisor', ['username' => auth()->user()->username]) }}">
                            {{ auth()->user()->name }} (You)
                        </a>
                    </div>

                    <div>
                        Department: {{ $set->department }}
                    </div>


                    <div>
                        Start: {{ $set->start_year }}
                    </div>

                    <div>
                        End: {{ $set->end_year }}
                    </div>



                </div>
            </div>
        </div>
    </a>
@endforeach


<div class="row pt-4">
    <div class="col-4">
        <div class="btn btn-block btn-primary">Add Student</div>
        <div class="btn btn-block btn-secondary">Upload Results</div>
        <div class="btn btn-block btn-success">Announcement</div>
        <div class="btn btn-block btn-warning">Reports <span class="badge badge-danger badge-pill">5</span>
        </div>
        <div class="btn btn-block btn-info">Messages <span class="badge badge-warning badge-pill">51</span>
        </div>

    </div>

</div>












        {{-- Add Class
        <form method="POST" action="{{ route('add.academic_set') }}">
            @csrf

            Department:<br>
            <select name="department">
                <option value="CSC">Computer Science</option>
            </select>

            @error('department')
                <div style='color:red'>{{ $message }}</div>
            @enderror
            <br>


            <div class="row input-group">
                <div class="col">
                    Start Year:<br>
                    <select name="start_year">
                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                    </select>
                    @error('start_year')
                        <div style='color:red'>{{ $message }}</div>
                    @enderror
                </div>


                <div class="col">
                    End Year:<br>

                    <select name="end_year">
                        @for ($year = 3; $year < 7; $year++)
                            <option value="{{ $year + date('Y') }}" {{ $year === 5 ? 'selected' : '' }}>
                                {{ $year + date('Y') }}
                            </option>
                        @endfor
                    </select>
                    @error('end_year')
                        <div style='color:red'>{{ $message }}</div>
                    @enderror

                </div>
            </div>

            <button type="submit">Save Class</button>


        </form> --}}

Add Student
<form method="POST" action="route('add.student')" class="ignore">
    @csrf

    Student Name:<br>
    <input type="text" name="name" value="{{ old('name') }}" /><br>


    Student Reg No:<br>
    <input type="number" name="reg" value="{{ old('reg') }}" /><br>


    Phone:<br>
    <input type="phone" name="phone" value="{{ old('phone') }}" /><br>

    <select name="class_id">
        <option>Select Class</option>
        @foreach ($sets as $set)
            <option value="{{ $set->id }}">
                {{ $set->name }}
            </option>
        @endforeach
    </select>
    <br>


    Email:<br>
    <input type="email" name="email" value="{{ old('email') }}" /><br>

    <input type="submit" value="Add Student" />
</form>