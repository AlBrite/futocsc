<div x-cloak x-show="editAdvisor" @click.outside="editAdvisor=false" x-init="overlay=true;" class="grid place-items-center fixed bg-black/50 w-screen h-screen z-[1001] top-0 left-0">
  
  
  <form action="/admin/advisor/update" class="bg-white p-5 rounded-md justify-center grid grid-cols-1 flex-col" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="text-2xl font-bold text-center mb-5">Edit Advisor</h1>
    <x-drag-and-drop/>
    <div class="mt-4">
        <div class="grid grid-cols-3 gap-4">
          
          <input type="text" class="input" x-model="firstname" name="firstname" placeholder="First Name"/>
          <input type="text" class="input"  x-model="lastname" name="lastname" placeholder="Last Name"/>
          <input type="text" class="input"  x-model="middlename" name="middlename" placeholder="Middle Name"/>
          
          <input type="text" class="input"  x-model="editAdvisor.phone" name="phone" placeholder="Phone Number"/>
          <input type="text" class="input"  x-model="editAdvisor.user.email" name="email" placeholder="Email Address"/>
          <select name="gender" class="input">
            <option value="">Gender</option>
            <option value="male" x-bind:selected="editAdvisor.gender == 'male'">Male</option>
            <option value="female" x-bind:selected="editAdvisor.gender == 'male'">Female</option>
          </select>
        </div>
        <div class="flex gap-4 mt-4 ">
          <div class="flex-1">
            <input type="text" class="input w-full grid-rows-2" name="address" placeholder="Contact Address"/>
          </div>
          <div class="flex gap-3">
            <x-tooltip label="Date of Birth">
              <input type="date" class="input grid-span-1" name="birthdate"/> 
            </x-tooltip>

            <select name="set_id" class="input data-load-classes">
              <option value="">Assign Class</option>
            </select>
          </div>
        </div>
        

    </div>

    <div class="flex gap-2 mt-5 justify-end">
        <button type="button" class="btn-white" x-on:click="editAdvisor=null">Cancel</button>
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>


  </form>

</div>