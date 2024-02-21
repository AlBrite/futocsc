@php 
use \App\Models\Course;

$classes = \App\Models\Admin::academicSets();

@endphp
<div x-cloak x-show="addAdvisor" x-init="overlay=true;" class="grid place-items-center fixed bg-black/50 w-screen h-screen z-[1001] top-0 left-0" x-data="{}">
  
  
  <form  x-data="{addClass:false}" action="/admin/advisor/add" class="bg-white p-5 rounded-md justify-center grid grid-cols-1 flex-col" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="text-2xl font-bold text-center mb-5">New Advisor</h1>
    <x-drag-and-drop/>
    <div class="mt-4">
        <div class="grid grid-cols-3 gap-4">
          <input type="text" class="input" name="firstname" placeholder="First Name"/>
          <input type="text" class="input" name="lastname" placeholder="Last Name"/>
          <input type="text" class="input" name="middlename" placeholder="Middle Name"/>
          
          <input type="text" class="input" name="phone" placeholder="Phone Number"/>
          <input type="text" class="input" name="email" placeholder="Email Address"/>
          <select name="gender" class="input">
            <option value="">Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
        <div class="flex gap-4 mt-4 ">
          <div class="flex-1">
            <input type="text" class="input w-full grid-rows-2" name="address" placeholder="Contact Address"/>
          </div>
          <div class="flex gap-3 relative">
            <x-tooltip label="Date of Birth">
              <input type="date" class="input grid-span-1" name="birthdate"/> 
            </x-tooltip>

            <select name="set_id" class="input data-load-classes" x-on:change="addClass=$event.target.value=='custom'">
              
              <option value="">--Select Class--</option>
              <option id="addClass" value="custom">Create Class</option>
              
            </select>
            <span class="text-xs absolute">Add Class</span>
          </div>
        </div>
        

    </div>
    
      
    <div x-cloak x-show="addClass">
      <fieldset class="fieldset mt-3">
        <legend>New Class Details</legend>
        @php 

          $start_sessions  = Course::generateSessions();


        @endphp

        <div class="flex gap-4" x-data="{graduation_session:false}">
          <div class="flex-1">
            <h2>Enrollment Session</h2>
            <select name="session" x-on:change="changeSession" class="input">
              <option value="">--Select Session--</option>
              @foreach($start_sessions  as $session) 
                <option value="{{$session}}">{{$session}}</option>
              @endforeach
            </select>
          </div>
          <div x-cloak class="flex-1" x-show="graduation_session">
            <h2>Graduation Session</h2>
            <span x-text="graduation_session"></span>
          </div>

        </div>
      </fieldset>
    </div>
    
    <div class="flex gap-2 mt-5 justify-end">
      <button type="button" class="btn-white" x-on:click="addAdvisor=null">Cancel</button>
      <button type="submit" class="btn-primary">Add Advisor</button>
    </div>


      


  </form>

</div>