<x-body title="Departments">
    @foreach ($departments as $department)
        <div class="p-2">
            {{ $department->name }} ({{ $department->code }})
            <span class="mx-2"><i class="fas fa-edit"></i></span>
            <form method="post" class="d-inline inline-form"
                action="{{ route('proceed', ['action' => urlencode('department/' . $department->id . '/delete')]) }}">
                @csrf
                <button class="btn" type="submit"><i class="fas fa-trash"></i></a>
                </button>
            </form>
        </div>
    @endforeach

    <a class="btn btn-primary" href="/department/add">
        Add Department
    </a>
</x-body>
