@props(['nav', 'title', 'styles', 'scripts'])
@php 
$defaults = [
    'nav' => 'page',
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

<body  :class="{'dark': darkMode}" class="dark:!bg-black md:h-screen md:overflow-hidden " x-data="{darkMode: localStorage.getItem('darkMode') === 'true', navIsOpen: window.innerWidth > 1024, open: false, showInfo: window.innerWidth > 1024, courseOpen: false, courseId: null, formOpen: false, data: {{$data}}}" @resize.window="handleResize">
    @php 
        $message = null;
        $type = 'info';

        switch(true) {
            case session()->has('message'):
                $message = session()->get('message');
                $type = 'info';
                break;
            case session()->has('error'):
                $message = session()->get('error');
                $type = 'error';
            case session()->has('danger'):
                $message = session()->get('danger');
                $type = 'danger';
                break;
            case session()->has('success'):
                $message = session()->get('success');
                $type = 'success';
                break;
            case session()->has('warning'):
                $message = session()->get('warning');
                $type = 'warning';
                break;
        }

    @endphp

    @if ($message) 
        <x-alert type='{{$type}}' class="absolute left-0 translate-x-[50%]" style="z-index:1001">{{$message}}</x-alert>
    @endif

   
    <div id="overlay" :class="{'flex':courseOpen||open|overlay}"><img src="{{asset('svg/logo.svg')}}" alt="">
        <div class="spinner"> </div></div>

    @include('partials.header')

    <main class="xl:flex">
        @include('partials.menu', ['nav'=>$nav])

        <section class="grow">
            

            <div id="app" class="mt-12 p-2 md:overflow-y-auto relative
            lg:grid lg:grid-cols-3 lg:overflow-y-visible lg:gap-1
            xl:mt-0 xl:grid-cols-7">
    
            <x-left>
                {{$slot}}
            </x-left>
            
    
        @include('partials.profile-card')


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