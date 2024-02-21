@props(['title', 'nav'])

@php
    $defaults = ['title'=>'CSC Admin Portal', 'nav'=>''];
    foreach($defaults as $default=>$value) {
      if (!isset($$default)) {
        $$default = $value;
      }
    }
    $user = \App\Models\User::active();
    $profile = $user->profile;
    
    $set = $profile->class;
    
    $advisor = $set?->advisor;

    
  $role = $user?->role;

  $announcements = \App\Models\Announcement::where('user_id', '=', $user->id)->orWhere('target', '=', $user->role)->with('announcer')->paginate(10);
 
@endphp
<x-template nav="{{$nav}}" title="{{$title}}">

  <div class="lg:flex">
    <div class="flex-1 lg:gap-5 mx-6">
      <div class="flex-1">
          {{$slot}}
      </div>
      
    </div>
    <div class="sticky top-0 w-96 hidden lg:block">
      <div class="scroller grid place-items-center">
        <div class="shadow-lg w-full">
          <div class="profile-card">
              <x-profile-pic :user="$profile" src="{{asset('images/user.jpg')}}" alt="Image" class="object-cover aspect-square rounded-full w-32"/>
    
    
              <div class="flex flex-col items-center gap-1 text-center">
                  <h1 class="text-body-800 text-2xl">
                      {{$user->name}}
                  </h1>
                  <p class="text-slate-800">
                      {{$profile->reg_no??$profile->staff_id}}
                  </p>
                  <p class="text-slate-600 text-sm">
                      Class:
                      <a href="/class" class="link font-semibold">
                          {{$set->name}}
                      </a>
                  </p>
                  @if($role === 'student')
                    <p class="text-slate-600 text-sm">Role:
                        <span class="font-semibold text-slate-800">
                            {{$role}}
                        </span>
                    </p>
                  @else 
    
                  @endif
              </div>
          </div>
    
          <div class="bg-primary-50 rounded-b flex items-center justify-center p-1 gap-4">
              <div class="flex flex-col items-center justify-end">
                  <p class="text-secondary-800 text-lg">{{$set->name}}</p>
                  <p class="text-body-300">session</p>
              </div>
              <span class="bg-secondary-800 w-[1px] h-10"></span>
              <div class="flex flex-col items-center justify-end">
                  <p class="text-secondary-800 text-lg">Harmattan</p>
                  <p class="text-body-300">semester</p>
              </div>
          </div>
    
          <div class="notice-card bg-primary-50 dark:bg-green-950/40 rounded w-full h-full pl-4 pr-14 pt-10 pb-4 flex flex-col justify-between items-start relative ">
              <div class="relative z-10">

              @foreach($announcements as $announcement) 
                <p class="text-lg text-secondary-800 dark:text-orange-300 z-10">
                    {{$announcement->message}}
                </p>
              @endforeach
          </div>
      </div>
    </div>

  </div>
    
   
    
</x-template>