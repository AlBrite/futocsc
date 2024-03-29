<header>
    <div class="small-screen-nav flex align-center gap-2">
        <div>
            <span class="material-symbols-rounded text-primary-700 pointer" id="menu">menu</span>
        </div>
        <div class="flex align-center gap-small">
            <img src="{{asset('svg/logo.svg')}}" alt="logo" width="35">
            <p class="text-primary weight-600 font-size-5">CSC-FUTO</p>
        </div>
    </div>
    <div class="search-div">
        <label for="search"><button class="material-symbols-rounded" id="search-btn">search</button></label>
        <input type="search" name="search" id="search" placeholder="Search...">
    </div>
    <div class="top-right flex align-center gap-2">
        @auth
            @php
                $user = auth()->user();
            @endphp
            <div class="icons flex align-center gap-2">
                <a href="/student/profile"><span class="material-symbols-rounded">account_circle</span></a>
                <a href="/student/settings"><span class="material-symbols-rounded">settings</span></a>
            </div>
            <div class="details flex gap-1 align-center">
                <div class="image-container hidden">
                    <x-profile-pic :user="$user->{$user->role}" src="{{asset('images/user.jpg')}}" alt="user-image" class="fit rounded"/>

                </div>
                <div class="user-info">
                    <p class="font-size-1 text-body-800 weight-600">{{ $user->name }}</p>
                    <p class="font-size-small text-body-200 weight-400">{{ $user->email }}</p>
                </div>
            </div>
        @else

        @endauth
    </div>
</header>