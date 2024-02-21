@extends('layouts.one')
@section('title', 'Update Profile')

@section('content')

    <form class="form-300" method="POST" action="{{ route('student.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-between"><x-profile-pic :user="$student"
                style="height:150px;width:150px;margin:auto" /></div>


        <div class="input-group mt-3">
            <input name="image" type="file" previewAfter />
        </div>


        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Name:
                </div>
            </div>
            <input type="text" value="{{ $user->name }}" class="form-control input" readonly />
        </div>

        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Reg No:
                </div>
            </div>
            <input type="text" value="{{ $student->reg_no }}" class="form-control input" disabled readonly />
        </div>

        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Level:
                </div>
            </div>
            <select name="level" class="input">
                @foreach([100, 200, 300, 400, 500] as $level) 
                    <option value="{{$level}}" selected="{{$level == old('level')}}">{{$level}}Level</option>
                @endforeach
            </select>
        </div>


        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Gender
                </div>
            </div>
            <select name="gender" class="form-control input">
                <option value="male" {{ $student->gender == 'male' ? ' selected' : '' }}>Male</option>
                <option value="female" {{ $student->gender == 'female' ? ' selected' : '' }}>Female</option>
            </select>
        </div>


        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Phone:
                </div>
            </div>
            <input type="text" value="{{ $user->phone }}" class="form-control input" name="phone" />
        </div>

        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Birthdate:
                </div>
            </div>
            <input type="date" value="{{ $student->birthdate }}" class="form-control input" name="birthdate" />
        </div>



        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Address:
                </div>
            </div>
            <input type="text" value="{{ $student->address }}" class="form-control input" name="address" />
        </div>



        <div class="input-group mt-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Department:
                </div>
            </div>
            <input type="text" value="Computer Science" class="form-control input" readonly disabled />
        </div>

        <div class="input-group mt-3">
            <input type="submit" value="Update" class="btn btn-primary btn-block">
        </div>
    </form>

@endsection
