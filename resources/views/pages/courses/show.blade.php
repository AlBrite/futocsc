@php

@endphp
<x-app title="{{$course->code}} : {{$course->name}}">
  <div class="text-center flex flex-col justify-center items-center">
    <div class="max-w-80 ">
      <div class="font-bold mb-5">{{$course->code}} : {{$course->name}}</div>
      <img src="{{asset('svg/course_image_default.svg')}}" alt="course-image" class="rounded-lg">
      <div class="">
      Unit: <b>{{$course->unit}}</b>  exam: <b>{{$course->exam}}</b>  practical: <b>{{$course->practical}}</b> test: <b>{{$course->test}}</b></div>
      <div class="mt-3">
        <div>Outline</div>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur harum temporibus corrupti odio sint laborum architecto minus quas veritatis ea. Officia suscipit assumenda cum necessitatibus, quod fugit quis dicta aperiam.</p>

        @if($course->prerequisite) 
        
        
          <!-- <div class="mb-4">Prerequisites: <b>{$course->prerequisite->name}</b></div> -->
        @endif

        @if($result) 
          <span class="mt-5 flex justify-between rounded-md px-2 py-1 text-white font-bold opacity-50 {{$result->score >= 40?'bg-green-600':'bg-red-600'}}">
            <span>{{$result->score}}</span> <span>{{$result->score >= 40?'PASSED':'CARRYOVER'}}</span>
          </span>
        @else 
          <span class="mt-5 flex rounded-md px-2 py-1 text-white font-bold opacity-50 bg-slate-300">
              PENDING
            </span>
        @endif
      </div>
  </div>

  <!-- <form method="post" action="/setcourse" class="pb-28">
    <input type="hidden" name="id" value="{{$course->id}}"/>
    <textarea name="outline" class="input"></textarea><br>
    <div>
        <div>
          Exam<br>
          <input type="number" name="exam"  class="input"/>
        </div>

        <div>
          Test<br>
          <input type="number" name="test" class="input"/>
        </div>

        <div>
          Practical<br>
          <input type="number" name="practical" value="0" class="input"/>
        </div>
    </div>
  </form> -->

</div>




</x-app>