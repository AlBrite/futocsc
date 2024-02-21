@props(['active', 'title', 'styles', 'scripts', 'data'])
@php 
$defaults = [
    'active' => 'page',
    'title' => 'FUTO CSC Portal',
    'styles' => '',
    'scripts' => '',
    'data' => '{}'
];
foreach($defaults as $prop=>$value) {
    if (!isset($$prop)) {
        $$prop = $value;
    }
}



@endphp
<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">

<head>
    @include('partials.head', [
        'title' => $title,
        'styles'   => 'styles/student/student.css'
    ])
    
</head>

<body  :class="{'dark': darkMode}" class="dark:bg-black md:h-screen md:overflow-hidden " x-data="{darkMode: localStorage.getItem('darkMode') === 'true', navIsOpen: window.innerWidth > 1024, open: false, showInfo: window.innerWidth > 1024, courseOpen: false, courseId: null, formOpen: false, data: {{$data}}}" @resize.window="handleResize">
   
    <div id="overlay" :class="{'hidden':courseOpen||open, 'flex':!courseOpen&&!open}"><img src="{{asset('svg/logo.svg')}}" alt="">
        <div class="spinner"> </div></div>

    @include('partials.header')

    <main class="xl:flex">
        @include('partials.menu', ['active'=>$active])

        <section class="grow">
            

            <div id="app" class="mt-12 p-2 md:overflow-y-auto relative
            lg:grid lg:grid-cols-3 lg:overflow-y-visible lg:gap-1
            xl:mt-0 xl:grid-cols-7">
                {{$slot}}
            </div>
        </section>
    </main>
</body>
<script type="module" src="{{asset('scripts/main.js')}}"></script>

@auth
    <script type="module" src="{{asset('scripts/student.js')}}"></script>
@endauth
<script type="module" src="{{asset('scripts/base.js')}}"></script>

</html>