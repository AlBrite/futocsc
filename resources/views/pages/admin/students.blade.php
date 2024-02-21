@php 
  $students = \App\Models\Student::all();
  $results = \App\Models\Result::paginate(6);
  $student = $students[0];
  $student_id = request()->student_id
  ;
  if (!is_numeric($student_id)) {
    $student_id = 'null';
  }

@endphp

<x-template nav="students"  data="addStudentForm: null, student_id:{{$student_id}}, student: null, open:false, level: null, editStudent: null, firstname: '', lastname: '', middlename:''">
  <div x-init="init" class="lg:flex gap-5 px-0 justify-between items-stretch max-h-full min-h-full overflow-hidden">
    <div x-bind:class="{'hidden lg:block': student}" class="lg:w-[380px]">
      <div class="scroller border border-slate-300 p-3 bg-gray-50">
        <form class="flex items-center justify-between gap-2 w-full flex-wrap p-5">
          
          <div class="flex-1">
            <input type="search" class="input w-full" placeholder="Enter Student Name or Reg No"/>
          </div>
              
        </form>
        
        <div class="">
          @foreach($students as $student)
            <div student_id="{{$student->id}}" x-on:click="displayStudent" class="flex hover:bg-gray-300 cursor-pointer gap-2 lg:gap-4 border-b border-slate-300 last:border-transparent p-3">
              <x-profile-pic :user="$student" alt="student_pic" class="w-16 h-16 rounded-md object-cover"/>
              <div class="flex-1">
                <div class="font-2xl font-bold">{{$student->user->name}}</div>
                <div class="text-sm">{{$student->reg_no}}</div>
                <div class="text-sm">

                  <span>{{$student->level}}</span>
                  <span>{{$student->calculateCGPA()}}</span>

                </div>
              </div>
            </div>
            
          @endforeach
        </div>
      </div>
    </div>
    <div class="lg:flex-1 lg:bg-green-50/10">
      <div class="scroller">
        <div class="flex justify-between items-center">
          <div class="lg:invisible flex items-center cursor-pointer"  x-on:click="back">
            <span class="material-symbols-rounded">
              arrow_back
            </span>
            <span>Back</span>
          </div>

          <div>
            <button class="btn-white" x-on:click="addStudentForm=true">Add Student</button>
          </div>

          
        </div>
        <!--add course-->
        @include('popups.add-student')
        <!--/add course-->
      @include('popups.view-student')
    </div>
    
  </div>
  <script>
      function init() {
       
        if (this.student_id) {

          api('/student', {student_id:this.student_id})
          .then(response => {
  
            this.student = response;
            
            const nameParts = response.user.name.split(" ");
            this.firstname = nameParts[0];
            this.lastname = nameParts.length > 1 ? nameParts[1] : '';
            this.middlename = nameParts.length > 2 ? nameParts[2] : '';
          })
          .catch(error => console.log(error));

        }

        
      }
  </script>
    
</x-template>