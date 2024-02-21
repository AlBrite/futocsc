@extends('layouts.two')
@section('title', "Academic set")
@section('hero')
    <div class="card">
        <div class="card-body">
            <h1>{{ strtoupper($set->name) }}</h1>
            Start: {{ $set->start_year }} End: {{ $set->end_year }}<br>
            Department: {{ $set->department }}
            {{ $set->description }}
            <b>Total Students:</b> {{ $set->students->count() }}
            <br>
            @if ($advisor)
                <a href="{{ route('profile.advisor', ['username' => $advisor->username]) }}"><b>Course Advisor:</b>
                    {{ $advisor->name }}</a>
            @endif
            <div>
                @if ($set->url)
                    Invitation Link: <div class="badge badge-secondary">
                        {{ $set->url }}
                    </div> <a href="{{ route('revoke.invitation', compact('set')) }}">Revoke Link</a>
                @else
                    <a href="{{ route('generate.invitation', compact('set')) }}">
                        Generate Link
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('left')
    <div class="card">
        <div class="card-header">
            List of Students
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('make.course_rep') }}">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="small">Course Rep</i>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $set->id }}" name="set_id" />

                    <select class="form-control" name="course_rep">
                        @foreach ($set->students as $student)
                            <option value="{{ $student->id }}"
                                {{ $set->course_rep === $student->id ? ' selected' : '' }}>
                                {{ $student->user->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm">Update</button>

                    </div>
                </div>

            </form>
            @foreach ($students as $n => $student)
                <div>
                    #{{ $n + 1 }} <a
                        href="{{ route('profile.student', ['username' => $student->user->username]) }}">
                        {{ $student->user->name }}
                        {{ $student->id === auth()->id() ? '(You)' : '' }}
                        <i class="{{ $set->course_rep === $student->id ? 'fa fa-check-circle' : '' }}"></i>
                    </a>
                </div>
            @endforeach


        </div>


        <div class="card-footer">
            {{ $students->links() }}
        </div>


    </div>
@endsection


@section('right')

    Add Academic to <b>{{ $set->name }}</b>



    <form method="POST" action="{{ route('add.student') }}">
        @csrf

        <input type="hidden" name="set_id" value="{{ $set->id }}" />

        Student Name:<br>
        <input type="text" name="name" value="{{ old('name') }}" /><br>


        Student Reg No:<br>
        <input type="number" name="reg" value="{{ old('reg') }}" /><br>


        Phone:<br>
        <input type="phone" name="phone" value="{{ old('phone') }}" /><br>


        Email:<br>
        <input type="email" name="email" value="{{ old('email') }}" /><br>

        <input type="submit" value="Add Student" />
    </form>
@endsection
