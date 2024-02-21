@php 

$classes = \App\Models\Admin::academicSets();

@endphp
<div x-cloak x-show="addStudentForm" x-on:click.outside="addStudentForm=false" x-init="overlay=true;" class="lg:grid lg:place-items-center fixed bg-black/25 h-full overflow-y-scroll lg:overflow-y-visible w-screen lg:h-screen  z-[1001] top-0 left-0" x-data="{}">
  
  
  <form action="/admin/student/add" class="bg-white p-0 lg:p-5 rounded-md justify-center lg:grid justify-items-center lg:grid-cols-1 flex-col lg:w-[500px]" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="font-bold text-center mb-5">Add Student</h1>
    <x-drag-and-drop/>
    <div class="mt-4">
        <div class="lg:grid grid-cols-1 lg:grid-cols-3 gap-4">
          <input type="text" class="input" name="firstname" placeholder="First Name"/>
          <input type="text" class="input" name="lastname" placeholder="Last Name"/>
          <input type="text" class="input" name="middlename" placeholder="Middle Name"/>
          
          <input type="text" class="input" name="reg_no" placeholder="Reg Number"/>
          <input type="text" class="input" name="email" placeholder="Email Address"/>
          <input type="text" class="input" name="phone" placeholder="Phone Number"/>
        </div>
        <div class="lg:flex gap-4 mt-4 ">
          <div class="flex-1">
            <input type="text" class="input w-full lg:grid-rows-2" name="address" placeholder="Contact Address"/>
          </div>
          <div class="lg:flex gap-3">
            <x-tooltip label="Date of Birth">
              <input type="date" class="input grid-span-1" name="birthdate"/> 
            </x-tooltip>

            <select name="set_id" class="input data-load-classes">
              <option value="">Assign Class</option>
              @foreach($classes as $class) 
                <option value="{{$class->id}}">{{$class->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="lg:grid grid-cols-3 gap-4 mt-4">
          <select name="gender" class="input">
            <option value="">Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
          <select name="level" class="input">
            <option value="">Level</option>
            <option value="100">100 L</option>
            <option value="200">200 L</option>
            <option value="300">300 L</option>
            <option value="400">400 L</option>
            <option value="500">500 L</option>
          </select>
          <select name="entryMode" class="input">
            <option value="">Entry Mode</option>
            <option value="UTME">UTME</option>
            <option value="Direct">Direct</option>
          </select>


          
        </div>

    </div>

    <div class="flex gap-2 mt-5 justify-end">
        <button type="button" class="btn-white" x-on:click="addStudentForm=null">Cancel</button>
        <button type="submit" class="btn-primary">Add Student</button>
      </div>


  </form>

</div>