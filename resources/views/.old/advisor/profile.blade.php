@php 
$advisor = \App\Models\Advisor::active();
$class = $advisor->academicSets->first();
$students = $class->students();
$number_of_students_in_class = $students->count();
$allStudents = $students->cursorPaginate(5);
$number_of_semester_courses = 5;
$results = \App\Models\Result::with('course')->orderBy('level', 'desc');
$totalResultsUploaded = $results->count();
$name = $advisor->user->name;
$splitName = preg_split('/\s+/', $name.' ');
list($firstName, $lastName) = $splitName;
$otherNames = '';
if (count($splitName) >= 3) {
    $otherNames = implode(' ',array_slice($splitName, 2));
}

$results = $results->cursorPaginate(15);


@endphp



<x-app>
    <div class="flex">
        <div class="flex-1">
            <!-- Additional styles in student.css -->
            <h1 class="text-lg text-body-300 font-semibold">Profile</h1>
            <div class="card">
                <div class="flex flex-col gap-4 items-center p-4 xl:grid xl:grid-cols-4">
                    <div class="flex flex-col items-center
                    xl:col-span-1 xl:row-span-2 xl:justify-start xl:h-full">
                        <x-profile-pic :user="$profile"  alt="user_img" id="profile-image"/>

                        <form action="" id="change-image-form" class="flex items-center gap-1 xl:flex-col">

                            <div class="file-input">
                                <input type="file" name="profileImageSelect" id="selct-profile-image"
                                    accept=".png, .jpg, .jpeg" class="rounded w-52">
                            </div>
                            <input type="submit" value="Change Profile Image"
                                class="btn  text-white rounded bg-[var(--accent)] hover:bg-[var(--accent-600)] transition xl:text-sm" />
                        </form>
                    </div>

                    <div class="flex flex-col gap-3 items-center w-full
                    xl:col-span-3 xl:items-start">
                        <h1 class="text-sm text-secondary-800 font-semibold">Basic Information</h1>
                        <form class="w-full flex flex-col gap-4
                        md:grid md:grid-cols-2
                        lg:grid-cols-3" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="w-full">
                                <label for="first-name" class="text-body-300">
                                    First Name
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$firstName}}"/>
                            </div>

                            <div>
                                <label for="last-name" class="text-body-300">
                                    Last Name
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$lastName}}"/>
                            </div>

                            <div>
                                <label for="middle-name" class="text-body-300">
                                    Other Names
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$otherNames}}"/>
                            </div>

                            
                            <div>
                                <label for="email" class="text-body-300">
                                    Email
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$profile->email}}"/>
                            </div>

                            <div class="lg:col-span-2">
                                <label for="home-address" class="text-body-300">
                                    Address
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$profile->address}}"/>
                            </div>
                            <div>
                                <label for="phone" class="text-body-300">
                                    Phone
                                </label>
                                <input  class="form-control px-3 py-2 border border-slate-500 bg-white rounded-md w-full mt-2" value="{{$profile->phone}}"/>
                            </div>

                            <div class="lg:col-span-3">
                                <button
                                    class="btn text-white rounded bg-[var(--primary)] transition hover:bg-[var(--primary-700)]"
                                    type="submit">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col gap-3 items-center w-full
                    xl:col-span-3 xl:items-start">
                        <h1 class="text-sm text-secondary-800 font-semibold">Change Password</h1>
                        <form class="w-full flex flex-col gap-5
                        md:grid md:grid-cols-2
                        lg:grid-cols-3">
                            <div>
                                 <fieldset class="input-fieldset w-full">
                                    <legend>Old Password</legend>
                                    <input type="password" name="oldPassword" value="{{ old('oldPassword') }}" placeholder="Old Password"/>
                                </fieldset>
                            </div>

                            <div>
                                <fieldset class="input-fieldset w-full">
                                    <legend>New Password</legend>
                                    <input type="password" name="newPassword" value="{{ old('newPassword') }}" placeholder="New Password"/><br>
                                </fieldset>
                                
                            </div>

                            <div>
                                 <fieldset class="input-fieldset">
                                    <legend>Confirm Password</legend>
                                    <input type="password" id="confirm-password" name="confirmPassword" value="{{ old('confirmPassword') }}" placeholder="Confirm Password"/>
                                </fieldset>
                                
                            </div>

                            <div class="md:col-span-2">
                                <button
                                    class="btn text-white rounded bg-[var(--primary)] transition hover:bg-[var(--primary-700)]"
                                    type="submit">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>

        <div class=" bg-white flex flex-col gap-2 overflow-y-auto w-80 p-2 shadow-lg ">

            <div class="rounded border border-slate-400 flex flex-col gap-4 items-center px-4 py-16">
                <x-profile-pic :user="$advisor" alt="user_img" class="w-32 h-32 object-cover rounded-full"/>

                <div class="flex flex-col items-center gap-1 text-center">
                    <h1 class="text-body-800 text-2xl">
                    {{$advisor->name}}
                    </h1>
                    <p class="text-slate-800">
                        Staff ID
                    </p>
                    <p class="text-slate-600 text-sm">
                        Class:
                        <span class="font-semibold text-slate-800">
                        {{$advisor->academicSet->name}}
                        </span>
                    </p>
                    <p class="text-slate-600 text-sm">Current Level:
                        <span class="font-semibold text-slate-800 uppercase">
                            500 level
                        </span>
                    </p>
                </div>
            </div>

            <div class="bg-primary-50 rounded flex items-center justify-center p-1 gap-4">
                <div class="flex flex-col items-center justify-end">
                    <p class="text-secondary-800 text-lg">{{$advisor->academicSet->name}}</p>
                    <p class="text-body-300">session</p>
                </div>
                <span class="bg-secondary-800 w-[1px] h-10"></span>
                <div class="flex flex-col items-center justify-end">
                    <p class="text-secondary-800 text-lg">{{$advisor->academicSet->semester}}</p>
                    <p class="text-body-300">semester</p>
                </div>
            </div>

            <div
                class="notice-card bg-green-50 rounded w-full h-full pl-4 pr-14 pt-10 pb-4 flex flex-col justify-between items-start relative ">
                <p class="text-lg text-secondary-800 z-10">
                    XX days left for course registration, please remind the students to register before the time
                    runs out!
                </p>
                <img src="{{asset('svg/frame.svg')}}" alt="frame" class="absolute bottom-0 right-0 ">
            </div>
        </div>
    </div>
</x-app>
        