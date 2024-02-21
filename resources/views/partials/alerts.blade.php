@php 

    $holders = ['success', 'error', 'warning', 'info', 'message', 'danger'];
    $message = null;
    $type = 'info';

    foreach($holders as $holder) {
        if (session()->get($holder)) {
            $type = $holder;
            $message = session()->get($holder);
            break;
        }
    }
    
    $class = match($type) {
        'error' => 'bg-red-200 text-red-600',
        'warning' => 'bg-yellow-200 text-yellow-600',
        'info' => 'bg-blue-200 text-blue-600',
        'success' => 'bg-green-200 text-green-600',
        default => 'bg-red-200 text-red-600',
    };
@endphp

@php 
    use Illuminate\Support\Facades\Session;

    $holders = ['success', 'error', 'warning', 'info', 'message'];
    $message = null;
    $type = 'info';

    foreach($holders as $holder) {
        if (Session::get($holder)) {
            
            $type = $holder;
            $message = Session::get($holder);
            Session::forget($holder);
            break;
        }
    }
    
    $class = match($type) {
        'error' => 'bg-red-200 text-red-600',
        'warning' => 'bg-yellow-200 text-yellow-600',
        'info' => 'bg-blue-200 text-blue-600',
        'success' => 'bg-green-200 text-green-600',
        default => 'bg-blue-200 text-blue-600',
    };
@endphp

@if ($message)
    <div x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 5000)" 
         class="fixed top-[100px] left-0 right-0 flex justify-center z-[1001]">
        <div x-show="showAlert" 
             x-transition:enter="transition ease-out duration-1000" 
             x-transition:enter-start="opacity-0 transform translate-y-1/2" 
             x-transition:enter-end="opacity-100 transform translate-y-0" 
             x-transition:leave="transition ease-in duration-1000" 
             x-transition:leave-start="opacity-100 transform translate-y-0" 
             x-transition:leave-end="opacity-0 transform translate-y-1/2" 
             class="{{ $class }} p-4 rounded-md w-[200px]">
            {{ $message }}
        </div>
    </div>
@endif

