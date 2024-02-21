@props(['title', 'nav'])

@php 

  $defaults = ['title'=>'CSC Admin Portal', 'nav'=>''];
  foreach($defaults as $default=>$value) {
    if (!isset($$default)) {
      $$default = $value;
    }
  }
@endphp 
<!DOCTYPE html>
<html lang="en" x-bind:class="{'dark': darkMode}" x-data="{ showFullSideBar: false, darkMode: localStorage.getItem('darkMode')==='true', toggleTheme() { this.darkMode = !this.darkMode;localStorage.setItem('darkMode', this.darkMode);} }"  @resize.window="handleResize">
<head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @include('partials.head', ['title'=>$title])
</head>
<body>
<div id="overlay"  class="dark:bg-black" :class="{'flex':courseOpen||open|overlay}"><img src="{{asset('svg/logo.svg')}}" alt="">
        <div class="spinner"> </div></div>


  <div class="lg:flex items-stretch h-screen relative">

    @include('partials.new.menu', [
    'nav' => $nav
    ])

    <div class="lg:flex flex-1 flex-col">
      @include('partials.admin-header')
      <main class="lg:flex flex-1 flex-col">
          {{$slot}}
      </main>
    </div>
</body>
<script type="module" src="{{asset('scripts/main.js')}}"></script>

@auth
    <script type="module" src="{{asset('scripts/'.auth()->user()->role.'.js')}}"></script>
@endauth
<script type="module" src="{{asset('scripts/base.js')}}"></script>

</html>