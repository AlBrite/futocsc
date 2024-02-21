<x-body title="{{ $title }}">
    <div>
        <form method="POST" action="{{ route('student_reg.form') }}" class="ignore">
            @csrf


            @if ($jointoken)
                {{ $title }}
                <input type="hidden" name="jtoken" value="{{ $jointoken }}" />
            @endif

            <br>Student Name:<br>
            <input type="text" name="name" value="{{ old('name') }}" /><br>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            Student Reg No:<br>
            <input type="number" name="reg" value="{{ old('reg') }}" /><br>
            @error('reg')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            Phone:<br>
            <input type="phone" name="phone" value="{{ old('phone') }}" /><br>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror



            Email:<br>
            <input type="email" name="email" value="{{ old('email') }}" /><br>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror




            Password:<br>
            <input type="password" name="password" value="{{ old('password') }}" /><br>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Add Student" />
        </form>
    </div>
</x-body>
