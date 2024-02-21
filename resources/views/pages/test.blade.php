@php 

$courses = \App\models\Course::whereNull('outline')->get();

dd($courses);

@endphp