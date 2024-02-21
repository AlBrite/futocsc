<x-body>
    <form action="{{ route('add.advisor') }}" style="width:300px;margin:auto;" method="POST" class="card"
        enctype="multipart/form-data">
        @csrf

        <div class="card-header">
            Add Course Advisor
        </div>
        <div class="card-body">


            Choose Image:<br>
            <div class="input-group"><input type="file" name="image" class="custom-file" /></div>
            <br>
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            Full Name:<br>
            <div class="input-group">
                <input name="name" type="text" class="form-control" value="{{ old('name') }}" /><br>
            </div> @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror



            Email:<br>
            <div class="input-group">
                <input name="email" type="email" class="form-control" value="{{ old('email') }}" /><br>
            </div>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror


            Phone:<br>
            <div class="input-group">
                <input name="phone" type="phone" class="form-control" value="{{ old('phone') }}" /><br>

            </div>
            @error('phone')
                <div class="text-danger small">{{ $message }}</div>
            @enderror


        </div>
        <div class="card-footer">
            <button class="btn btn-primary">
                Add Advisor
            </button>
        </div>
    </form>

</x-body>
