@if (session()->has('message'))
    @php
        $message = trim(session('message'));
        $type = 'info';
        if (preg_match('/^(success|error):(.+?)$/', $message, $match)) {
            list(, $type, $message) = $match;
        }
    @endphp

    <div class="flash-message flash-{{$type}}">
        {{$message}}
    </div>
    
@endif