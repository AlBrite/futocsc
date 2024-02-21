@php
    $user = auth()->user();
    auth()->user()->loadNames();

    $profile = $user->profile;
    
    
@endphp

<x-template>
    <div class="scroller p-0">

        <div class="profile-wrapper">
          <div class="profile-card js-profile-card">
            <div class="profile-card__img">
            <x-profile-pic id="previewImage" data-image="user" :user="$profile" alt="user_img" class="w-24 h-24 object-cover rounded-full xl:w-36 xl:h-36"/>
            </div>
        
            <div class="profile-card__cnt js-profile-cnt">
              <div class="profile-card__name">{{$user->name}}</div>
              <div class="profile-card-loc">
        
                <span class="profile-card-loc__txt">
                    @if($user->role === 'student')
                        {{$user->student->reg_no}}
                    @endif
                </span>
              </div>
        
              <div class="profile-card-inf">
                <div class="profile-card-inf__item">
                  <div class="profile-card-inf__title">5.0</div>
                  <div class="profile-card-inf__txt">CGPA</div>
                </div>
        
                <div class="profile-card-inf__item">
                  <div class="profile-card-inf__title">65</div>
                  <div class="profile-card-inf__txt">Enrollments</div>
                </div>
        
                <div class="profile-card-inf__item">
                  <div class="profile-card-inf__title">500</div>
                  <div class="profile-card-inf__txt">Level</div>
                </div>
        
              </div>
        
        
            </div>


            <form action="/updateprofile" method="POST" class="w-full flex flex-col p-5">
                @csrf
                <fieldset class="profile-fieldset">
                    <legend>Update Profile</legend>
                    <div class="md:flex w-full items-center justify-stretch gap-3 mt-8">
                        <div class="flex-1">
                            <x-input type="text" placeholder="First Name" value="{{old('firstname',$user->firstname())}}" id="first-name" name="firstname" disabled/>
                           
                        </div>

                        <div class="flex-1">
                            <x-input type="text" placeholder="Middle Name" value="{{old('middlename',$user->middlename())}}" id="middle-name" name="middlename" disabled/>
                        </div>

                        <div class="flex-1">

                            <x-input type="text" placeholder="Last Name" value="{{old('lastname',$user->lastname())}}" id="last-name" name="lastname" disabled/>

                        </div>
                    </div>
                    <!--start-->
                    <div class="lg:md:flex gap-5">
                        <div class="lg:w-[w00px]">
                            <x-input type="text" placeholder="Email Address" value="{{old('email',$user->email)}}" id="middle-name" name="email" />
                            
                        </div>

                        <div class="lg:flex-1">
                            <x-input type="text" placeholder="Home Address" value="{{old('address', $profile->address)}}" id="middle-name" name="address" id="home-address" />
                        </div>
                        <div>
                            <x-input type="text" placeholder="Phone Number" value="{{old('middlename',$user->middlename())}}" id="last-name" name="phone" disabled/>
                            
                        </div>
                    </div>



                    <div class="flex justify-end mt-8">
                        <button class="btn text-white rounded-md bg-[var(--primary)] transition hover:bg-[var(--primary-700)]"
                            type="submit">
                            Update Profile
                        </button>
                    </div>


                </fieldset>
                <fieldset class="profile-fieldset">
                    <legend>Change Password</legend>
                    <div class="md:flex gap-5 items-end mt-8">

                        <div class="md:flex-1">
                            <x-input type="password" placeholder="Old Password" id="middle-name" name="oldPassword" id="old-password" />

                            @error('oldPassword') 
                                <x-alert type="error">{{$message}}</x-alert>
                            @enderror
                        </div>
                
                        <div class="md::flex-1">
                            <x-input type="password" placeholder="New Password" id="middle-name" name="password" id="new-password" />
                        
                            @error('password') 
                                <x-alert type="error">{{$message}}</x-alert>
                            @enderror
                        </div>
                
                        <div class="md:flex-1">
                            <x-input type="password" placeholder="Confirm Password" id="middle-name" name="password_confirmation" id="confirm-password"/>
                           
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button class="btn text-white rounded-md bg-[var(--primary)] transition hover:bg-[var(--primary-700)]"
                            type="submit">
                            Change Password
                        </button>
                    </div>

                </fieldset>
        
            </form>
        
          </div>
        
        </div>
    </div>
        
        
        <link rel="stylesheet" href="{{asset('styles/profile.css')}}" />
    

</x-template>