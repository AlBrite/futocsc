@php 

$classes = \App\Models\Admin::academicSets();

@endphp
<div x-cloak x-show="editStudent" x-init="overlay=true;" class="grid place-items-center fixed bg-black/50 w-screen h-screen z-[1001] top-0 left-0" x-data="{}">
  
  
  <form @click.outside="editStudent=false" action="/admin/student/update" class="bg-white p-5 rounded-md justify-center grid grid-cols-1 flex-col" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="text-2xl font-bold text-center mb-5">Edit Student</h1>
    <x-drag-and-drop alpine=":src='student.image'"/>
    <div class="mt-4">
        <div class="grid grid-cols-3 gap-4">
          <input type="text" class="input" name="firstname" x-model="firstname" placeholder="First Name"/>
          <input type="text" class="input" name="lastname" x-model="lastname" placeholder="Last Name"/>
          <input type="text" class="input" name="middlename" x-model="middlename" placeholder="Middle Name"/>
          
          <input type="text" class="input" name="reg_no" x-model="student.reg_no" placeholder="Reg Number" readonly disabled/>
          <input type="text" class="input" name="email" x-model="student.user.email" placeholder="Email Address"/>
          <input type="text" class="input" name="phone" x-model="student.user.phone" placeholder="Phone Number"/>
        </div>
        <div class="flex gap-4 mt-4 ">
          <div class="flex-1">
            <input type="text" class="input w-full grid-rows-2" name="address" placeholder="Contact Address" x-model="student.address"/>
          </div>
          <div class="flex gap-3">
            <x-tooltip label="Date of Birth">
              <input type="date" class="input grid-span-1" x-model="student.birthdate" name="birthdate"/> 
            </x-tooltip>

            <select name="class" class="input">
              <option value="">Assign Class</option>
              @foreach($classes as $class) 
                <option value="{{$class->id}}" x-bind:selected="student.set_id=={{$class->id}}">{{$class->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-4">
          <select name="gender" class="input">
            <option value="">Gender</option>
            <option value="male"  x-bind:selected="student.set_id=='male'">Male</option>
            <option value="female"  x-bind:selected="student.set_id=='female'">Female</option>
          </select>
          <select name="level" class="input">
            <option value="">Level</option>
            <option value="100"  x-bind:selected="student.level=='100'">100 L</option>
            <option value="200" x-bind:selected="student.level=='200'">200 L</option>
            <option value="300" x-bind:selected="student.level=='300'">300 L</option>
            <option value="400" x-bind:selected="student.level=='400'">400 L</option>
            <option value="500" x-bind:selected="student.level=='500'">500 L</option>
          </select>
          <select name="entryMode" class="input">
            <option value="">Entry Mode</option>
            <option value="UTME" x-bind:selected="student.entryMode=='UTME'">UTME</option>
            <option value="Direct" x-bind:selected="student.entryMode=='Direct'">Direct</option>
          </select>


          
        </div>

    </div>

    <div class="flex gap-2 mt-5 justify-end">
      
      <button type="reset" class="btn-white">Reset</button>
        <button type="button" class="btn-white" x-on:click="editStudent=false">Cancel</button>
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>


  </form>

</div>