<x-template name='advisor' title='Add Advisor - Admin Panel'>
  <div class="grid place-items-center h-full">
    <div>
      <div class="font-extrabold text-left">Add Advisor</div>
      <form action="/updateprofile" method="POST" class="w-full flex flex-col gap-4 md:grid md:grid-cols-2 lg:grid-cols-3">
          @csrf
          <div class="w-full">
              <label for="first-name" class="text-body-300">
                  First Name
              </label>
              <input type="text" id="first-name" name="firstname" class="input rounded w-full" value="{{old('firstname')}}">
          </div>

          <div>
              <label for="middle-name" class="text-body-300">
                  Middle Name
              </label>
              <input type="text" id="middle-name" name="middlename" class="input rounded w-full" value="{{old('middlename')}}">
          </div>

          <div>
              <label for="last-name" class="text-body-300">
                  Last Name
              </label>
              <input type="text" id="last-name" name="lastname" class="input rounded w-full" value="{{old('lastname')}}">
          </div>

          <div>
              <label for="email" class="text-body-300">
                  Email Address
              </label>
              <input type="email" id="email" name="email" class="input rounded w-full" value="{{old('email')}}">
          </div>

          <div class="lg:col-span-2">
              <label for="home-address" class="text-body-300">
                  Home Address
              </label>
              <input type="text" id="home-address" name="address" class="input rounded w-full" value="{{old('address')}}">
          </div>

          <div>
              <label for="phone" class="text-body-300">
                  Phone Number
              </label>
              <input type="text" id="phone" name="phone" class="input rounded w-full" value="{{old('phone')}}">
          </div>

          <div>
              <label for="phone" class="text-body-300">
                  Reg No:
              </label>
              <input type="text" id="phone" name="regNo" class="input rounded w-full" value="{{old('regNo')}}">
          </div>

          <div class="lg:col-span-3">
              <button
              class="btn text-white rounded bg-[var(--primary)] transition hover:bg-[var(--primary-700)]"
              type="submit">
                  Save
              </button>
          </div>
      </form>

    </div>
    </div>
  </div>
</x-template>