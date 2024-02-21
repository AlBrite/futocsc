@php

@endphp
<x-template title="{{$course->code}} : {{$course->name}}" nav="courses">
  <div class="page-header">Course - {{$course->name}}</div>
  <div class="lg:flex">
    <div class="grid place-content-center flex-1 text-center min-h-full">
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
  
          
  
         
        </div>
    </div>

    
  </div>
  <div class="lg:w-80">
    <form method="post" action="/setcourse" class="pb-28">
      <input type="hidden" name="id" value="{{$course->id}}"/>
      <div class="flex flex-col justify-stretch">
        <textarea name="outline" class="input w-full"></textarea>

        <div class="flex gap-2 justify-between w-full">
          <div>
            <input type="number" class="input" name="exam" min="1" max="100" placeholder="Exam"/>
          </div>
          <div>
            <select name="test" class="input">
              <option value="">Test</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>

          </div>
          <div>

            <select name="lab" class="input">
              <option value="">Lab</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
          </div>



        </div>

      </div>
    </form>
  </div>

  

</div>




</x-template>