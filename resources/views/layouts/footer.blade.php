<?php


  $role = 'guest';
  if(!isset($nav)) {
    $nav = 'page';
  }
  
  if (auth()->check()) {
    $role = auth()->user()->role;
  } 

  $scripts = [
    "js/modules/$role.js",
    "js/modules/$nav.js",
    "js/modules/$role-$nav.js"
  ];

?>
<span id="footer-slot">
  <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
  <script defer type="module" src="{{asset('scripts/init-alpine.js')}}"></script>
  <script type="module" src="{{asset('scripts/main.js')}}"></script>

@auth

    <script type="module" src="{{asset('scripts/'.auth()->user()->role.'.js')}}"></script>
    
@endauth

@foreach($scripts as $script) 
  @if(file_exists(public_path($script)))
    <script defer type="module" src="{{ asset($script) }}"></script>
  @endif
@endforeach
</script>