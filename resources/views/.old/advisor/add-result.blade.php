<x-body title="Import Results">

    <h1>Import Results</h1>
    <form class="form-300" action="{{ route('result.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Course
                </div>
            </div>
            <select name="course" class="form-control">
                <option>--Select--</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    Select Result
                </div>
                <input type="file" name="file" class="form-control" />
            </div>

        </div>


        <br>
        <button type="submit">Import</button>
    </form>

</x-body>
