@php 

$old_mandatory = old('mandatory');
$old_test = old('test');
$old_exam = old('exam');
$old_practical = old('practical');
$old_code = old('code');
$old_name = old('name');
$old_prerequisites = old('prerequisites');
$old_semester = old('semester');
$old_level = old('level');
$old_outline = old('outline');


@endphp
<div x-cloak x-show="editData" @click.outside="editData=false" x-init="overlay=true;" class="grid place-items-center fixed bg-black/50 w-screen h-screen z-[1001] top-0 left-0" x-data="{testing: {}, title:null, code: null;prerequisite:null;option:null;test:null;practical:null;exam:null;image:null;outline:null;level:null;semester:null; files: []}">
  <form action="{{ route('update.course') }}" method="post" class="w-[90%] lg:w-[500px] scroller lg:h-[calc(100vh-50px)] border border-slate-500 bg-white p-4 rounded-md">
    <input type="hidden" x-bind:value="editData.id" name="id"/>
    @csrf
    <div class="">
      <div class="text-2xl font-semibold text-center">Edit Course</div>
      <fieldset class="border flex flex-col gap-3 border-slate-300 p-4 rounded-lg  ">
        <legend class="font-semibold">Basic Details</legend>

        <div class="grid grid-cols-3 gap-4">
          <div class="col-span-2">
            <fieldset class="flex flex-col relative input">
              <legend>Course Title</legend>
              <input type="text" name="name" placeholder="Course Title" :keypup="testing.name=$el.value" x-bind:value="editData.name"/>
            </fieldset>
            @error('name')
              <x-error message="{{$message}}"/>
            @enderror
          
          </div>
          <div class="grid-span-1">
            <fieldset class="flex flex-col relative input">
              <legend>Course Code</legend>
              <input type="text" name="code" placeholder="Course Code" :keypup="testing.code=$el.value" x-bind:value="editData.code"/>
            </fieldset>
            @error('code')
              <x-error message="{{$message}}"/>
            @enderror
          </div>
        </div>

        <div class="lg:flex gap-2 items-center justify-between">
          
          <div class=" flex-1">
            <select  class="input-sm w-full" name="prerequisite" id="prerequisite">
              <option value="0" x-bind:selected="editData.prerequisite=='0'" {{$old_prerequisites == '0'?'selected':''}}>Prerequisite</option>
            </select>
            @error('prerequisite')
              <x-error message="{{$message}}"/>
            @enderror
          </div>
          <div class=" flex-1">
            <select  class="input-sm w-full" name="mandatory" id="mandatory" x-on:change="mandatory=$el.value">
              <option value=""  x-bind:selected="editData.mandatory==''" {{$old_mandatory == ''?'selected':''}}>Course Option</option>
              <option value="1"  x-bind:selected="editData.mandatory=='1'" {{$old_mandatory == '1'?'selected':''}}>COMPULSORY</option>
              <option value="0"  x-bind:selected="editData.mandatory=='2'" {{$old_mandatory == '0'?'selected':''}}>ELECTIVE</option>
            </select>
            @error('mandatory')
              <x-error message="{{$message}}"/>
            @enderror
          </div>
        </div>
      </fieldset>
    
      <fieldset class="border border-slate-300 p-4 rounded-lg my-4 ">
        <legend class="font-semibold">Unit Allocation</legend>




        <div class="lg:flex gap-1 justify-between times-center">
          
          <div>
            <x-select type="number" name="test" placeholder="Test Score" manual="true" id="test" onSelect="test=$el.value">
                <option value="0"  x-bind:selected="editData.test=='0'" {{$old_test == '0'?'selected':''}}>0</option>
                <option value="1"  x-bind:selected="editData.test=='1'" {{$old_test == '1'?'selected':''}}>1</option>
                <option value="2"  x-bind:selected="editData.test=='2'" {{$old_test == '2'?'selected':''}}>2</option>
                <option value="3"  x-bind:selected="editData.test=='3'" {{$old_test == '3'?'selected':''}}>3</option>
                <option value="4"  x-bind:selected="editData.test=='4'" {{$old_test == '4'?'selected':''}}>4</option>
                <option value="5"  x-bind:selected="editData.test=='5'" {{$old_test == '5'?'selected':''}}>5</option>
            </x-select>
            @error('test')
              <x-error message="{{$message}}"/>
            @enderror
            
          </div>
          <div>
            <x-select type="number" name="practical" placeholder="Practical Unit" manual="true" id="practical" onSelect="practical=$el.value">
                <option value="0"  x-bind:selected="editData.practical=='0'" {{$old_practical == '0'?'selected':''}}>0</option>
                <option value="1"  x-bind:selected="editData.practical=='1'" {{$old_practical == '1'?'selected':''}}>1</option>
                <option value="2"  x-bind:selected="editData.practical=='2'" {{$old_practical == '2'?'selected':''}}>2</option>
                <option value="3"  x-bind:selected="editData.practical=='3'" {{$old_practical == '3'?'selected':''}}>3</option>
                <option value="4"  x-bind:selected="editData.practical=='4'" {{$old_practical == '4'?'selected':''}}>4</option>
                <option value="5"  x-bind:selected="editData.practical=='5'" {{$old_practical == '5'?'selected':''}}>5</option>
            </x-select>
            @error('practical')
              <x-error message="{{$message}}"/>
            @enderror
          </div>
          <div>
            <x-select type="number" name="exam" placeholder="Exam Unit" manual="true" id="exam" onSelect="exam=$el.value">
                <option value="1"  x-bind:selected="editData.exam=='1'" {{$old_exam == '1'?'selected':''}}>1</option>
                <option value="2"  x-bind:selected="editData.exam=='2'" {{$old_exam == '2'?'selected':''}}>2</option>
                <option value="3"  x-bind:selected="editData.exam=='3'" {{$old_exam == '3'?'selected':''}}>3</option>
                <option value="4"  x-bind:selected="editData.exam=='4'" {{$old_exam == '4'?'selected':''}}>4</option>
                <option value="5"  x-bind:selected="editData.exam=='5'" {{$old_exam == '5'?'selected':''}}>5</option>
            </x-select>
            @error('exam')
              <x-error message="{{$message}}"/>
            @enderror
          </div>
          
        </div>
      </fieldset>

      <div class="grid place-items-center h-[200px] body-400 rounded-md shadow">
        <x-tooltip label="Choose or Drag Image here">
          <input type="file" id="fileInput" accepts="image/*" style="display: none;">
          <div id="dropZone" class="drop-zone flex flex-col items-center rounded-md  justify-center">
              <img src="{{asset('svg/course_image_default.svg')}}" x-bind:src="editData.image'" class="w-full h-full object-cover"/>
              <p class="text-sm opacity-55">Drag & Drop image here</p>
          </div>
        </x-tooltip>
      </div>
    

    <fieldset class="border border-slate-300 p-4 rounded-lg my-4">
      <legend>Course Outline</legend>
      <textarea placeholder="Type course outline here" name="outline" rows="4" class="border-none w-full focus:outline-none" id="outline" x-on:change="outline=$el.value" x-bind:value="editData.outline">{{$old_outline}}</textarea>
      @error('outline')
        <x-error message="{{$message}}"/>
      @enderror
    </fieldset>


    <fieldset class="border border-slate-300 p-4 rounded-lg my-4 ">
        <legend class="font-semibold">Assigned to</legend>




        <div class="lg:flex gap-1 justify-between times-center">
          
          <div>
            <x-select type="number" name="level" placeholder="Level" onSelect="level=$el.value" id="level">
                <option value="100"  x-bind:selected="editData.level=='100'" {{$old_level == '100'?'selected':''}}>100L</option>
                <option value="200"  x-bind:selected="editData.level=='200'" {{$old_level == '200'?'selected':''}}>200L</option>
                <option value="300"  x-bind:selected="editData.level=='300'" {{$old_level == '300'?'selected':''}}>300L</option>
                <option value="400"  x-bind:selected="editData.level=='400'" {{$old_level == '400'?'selected':''}}>400L</option>
                <option value="500"  x-bind:selected="editData.level=='500'" {{$old_level == '500'?'selected':''}}>500L</option>
            </x-select>
            @error('level')
              <x-error message="{{$message}}"/>
            @enderror
            
          </div>
          
          <div>
            <x-select name="semester" placeholder="Semester" onSelect="semester=$el.value" id="semester">
                <option value="harmattan"  x-bind:selected="editData.semester=='harmattan'" {{$old_semester == 'harmattan'?'selected':''}}>Harmattan</option>
                <option value="rain"  x-bind:selected="editData.semester=='rain'" {{$old_semester == 'rain'?'selected':''}}>Rain</option>
            </x-select>
            @error('semester')
              <x-error message="{{$message}}"/>
            @enderror
          </div>

          
          
        </div>
      </fieldset>

      <div class="flex items-center gap-2">
        <input type="checkbox" x-on:change="check=$el.checked?'on':''" required class="checkbox" class="peer" name="check" id="check"/> <label class="peer-checked:font-bold" for="check">Have you verified that the above details are correct?</label>
      </div>
      <div class="flex gap-3 justify-end items-center">
        <button class="btn-white" type="button" x-on:click="editData=false">
           Cancel
        </button>
        <button class="btn-primary">
          Update
        </button>

      </div>
  <script>
  function addCourse(event) {
    event.preventDefault();
    const holders = ['name', 'code', 'level', 'semester','prerequisite', 'check', 'exam', 'test', 'practical', 'outline', 'mandatory'];
    data = {};
    holders.forEach(holder => {
      const id = document.getElementById(holder);
      data[holder] = id.value;
    });

    api('/course/create', data)
      .then(response=>{
        this.course = response;
        console.log(this.course);
      })
      .catch(error=>console.log(error));

    
    console.log(data);
  }
  </script>
      
    </div>
  </form>
</div>