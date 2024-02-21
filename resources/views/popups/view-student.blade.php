
<div x-show="!student" class="grid pliace-items-center w-full">
<img src="{{asset('images/students.png')}}" width="400px" class="justify-self-center opacity-15 blink"/>
            </div>
<div x-show="student">

  <div class="">
    <div class="flex flex-col lg:m-5 shadow-md bg-inherit-color border border-slate-300 rounded-md lg:p-8">
      <div class="bg-slate-50/10 flex flex-col lg:flex-row text-center justify-center gap-3 items-center lg:text-left lg:justify-start p-4">
        <img :src="student.image" class="w-28 h-28 object-cover rounded-full"/>
        <div>
          <p class="text-2xl lg:text-3xl font-bold mb-3" x-text="student.user.name"></p>
          <p class="font-bold" x-text="student.reg_no"></p>
        </div>
      </div>
      <div class="flex-1">
        <div>
          <div class="p-4 my-2">
            <div class="font-bold mb-4">Basic Information</div>
            <div class="lg:flex justify-between flex-wrap gap-3">
              <div class="flex lg:flex-col">
                <span>Phone</span> 
                <span class="font-semibold" x-text="student.user.phone"></span>
              </div>


              <div class="flex lg:flex-col gap-2">
                <span>Email</span> 
                <span class="font-semibold" x-text="student.user.email"></span>                
              </div>

              
              <div class="flex lg:flex-col gap-2">
                <span>Level</span> 
                <span class="font-semibold" x-text="student.level"></span>
              </div>


              <div class="flex lg:flex-col gap-2">
                <span>CGPA</span>
                <span class="font-semibold" x-text="student.cgpa"></span>
              </div>

              

              <div class="flex lg:flex-col gap-2">
                <span>Address</span> 
                <span class="font-semibold" x-text="student.address"></span>
              </div>
              
            

            </div>
          </div>


          <div class="p-4 my-2">
            <div class="font-bold mb-4">Progress</div>
            <div class="mt-2 lg:grid grid-cols-3 lg:gap-5">
              <!-- DASHBOARD CARD -->
              <div class="overflow-hidden grid-span-1 bg-blue-100 rounded-md p-4 flex flex-col justify-between">
                  <div class="flex items-center gap-2 text-black-300">
                      <span class="material-symbols-rounded">
                          groups
                      </span>
                      <p class="text-lg">Students</p>
                  </div>
                  <div class="flex justify-end text-primary-300">
                      <p class="text-[2.5rem] font-semiboold">20</p>
                  </div>
              </div>

              <div class="overflow-hidden grid-span-1 bg-green-100 rounded p-4 flex flex-col justify-between">
                  <div class="flex items-center gap-2 text-black-300">
                      <span class="material-symbols-rounded">
                      auto_stories
                      </span>
                      <p class="text-lg">Semester Courses</p>
                  </div>
                  <div class="flex justify-end text-danger-300">
                      <p class="text-[2.5rem] font-semiboold">71</p>
                  </div>
              </div>
              
      
              <div class="overflow-hidden grid-span-1 bg-red-100 rounded p-4 flex flex-col justify-between">
                  <div class="flex items-center gap-2 text-black-300">
                      <span class="material-symbols-rounded">
                          bar_chart
                      </span>
                      <p class="text-lg">Results Uploaded</p>
                  </div>
                  <div class="flex justify-end text-danger-300">
                      <p class="text-[2.5rem] font-semiboold">49</p>
                  </div>
              </div>
            </div>
          </div>

            
          
        </div>

        <div class="flex justify-end px-4 pb-3">
          <button class="btn-primary" x-on:click="editStudent=true;student=student">
            Edit Student Details
          </button>
        </div> 

        @include('popups.edit-student')
      </div>

    </div>
    
  </div>

</div>