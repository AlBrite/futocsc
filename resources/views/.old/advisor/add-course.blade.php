<form method="POST" action="{{ route('add.course') }}">

    Course Title:
    <input name="name" value="{{ old('name') }}" /><br>
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    Course Code:
    <input name="code" value="{{ old('code') }}" /><br>
    @error('code')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    Semester:<br>
    <select name="semester">
        <option value="rain">Rain</option>
        <option value="hammattan">Hamattan</option>
    </select><br>
    @error('semester')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    Level:<br>
    <select>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="300">300</option>
        <option value="400">400</option>
        <option value="500">500</option>
        <option value="600">600</option>
        <option value="700">700</option>
    </select><br>
    @error('level')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    Unit:<br>
    <select name="unit">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select><br>
    @error('unit')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</form>
