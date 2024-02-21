
<div x-cloak x-show="advisor">

  <div class="flex flex-col lg:m-5 shadow-md bg-white dark:bg-inherit rounded-md p-8">
    <div class="bg-slate-50/10 flex flex-col lg:flex-row text-center justify-center gap-3 items-center lg:text-left lg:justify-start p-4">
      <img :src="advisor?.image" class="w-28 h-28 object-cover rounded-full"/>
      <div>
        <p class="text-2xl lg:text-3xl font-bold mb-3" x-text="advisor?.user.name"></p>
        <p class="font-bold" x-text="advisor?.staff_id"></p>
      </div>
    </div>
    <div class="flex-1">
      <div>
        <div class="p-4 my-2">
          <div class="font-bold mb-1">Basic Information</div>
          <div class="lg:flex flex-wrap gap-3">
            <div>
              Phone
              <div class="font-semibold" x-text="student.phone">
              </div>
            </div>


            <div>
              Email
              <div class="font-semibold" x-text="student.user.email">
              </div>                
            </div>

            

            

            <div>
              Address
              <div class="font-semibold" x-text="student.address">
                
              </div>
            </div>

          </div>
        </div>



        <div class="p-4 my-2">
          <div class="font-bold mb-1">Class Information</div>
          <div class="lg:flex gap-5">
              <div class="lg:flex lg:flex-col">
                <span>Class</span>
                <span class="font-semibold" x-text="advisor.academic_set.name"></span>
              </div>

              <div class="lg:flex lg:flex-col">
                <span>Level</span>
                <span class="font-semibold" x-text="500"></span>
              </div>

              <div class="lg:flex lg:flex-col">
                <span>No of Students</span>
                <span class="font-semibold" x-text="advisor?.studentsCount"></span>
              </div>
                
                
          </div>
        </div>


        <div class="p-4 my-2">
          <div class="font-bold mb-1">Top 3 Students</div>
          <div class="lg:flex flex-wrap overflow-x-auto gap-3">
          <template x-for="student in advisor?.students" :key="student.id">
            <div class="flex gap-2 items-center shadow-md border border-slate-200 card rounded overflow-clip">
              <div>
                <img :src="student.picture" class="w-16 h-16 object-cover" alt="img"/>
              </div>
              <div class="flex-1 px-3">
                <h1 class="font-bold" x-text="student.user.name"></h1>
                <div x-text="student.reg_no"></div>
              </div>
            </div>
          </template>
          </div>
        </div>

          
        
      </div>

      <div class="flex justify-end px-4 pb-3">
        <button class="btn-primary" x-on:click="handleAdvisorUpdate">
          Edit Advisor Details
        </button>
      </div> 

      @include('popups.edit-advisor')
    </div>

  </div>
    

</div>

<div x-cloak x-show="!advisor">
  <img src="{{asset('images/no-advisor.png')}}"/>
</div>