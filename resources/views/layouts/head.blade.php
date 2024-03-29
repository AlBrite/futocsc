@php 

$style = '';

if (auth()->check()) {
  $role = auth()->user()->role;
  $style = "css/modules/$role-$nav.css";
}
@endphp
<meta charset="UTF-8" />
<title>{{$title??'Futo CSC Portal'}}</title>
<link rel="icon" type="image/svg+xml" href="public/assets/images/logo.svg" />
@vite('resources/css/app.css')
<link rel="stylesheet" href="{{asset('styles/styles.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.jsxxx"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />
<link rel="stylesheet" href="{{asset('styles/student/student.css')}}"/>
<script src="https://cdn.tailwindcss.com"></script>

<script src="{{asset('scripts/api.js')}}"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
<meta name="csrf_token" content="{{csrf_token()}}"/>
  
@if(file_exists(public_path($style)))
  <link href="{{ asset($style) }}" rel="stylesheet"/>
@endif
