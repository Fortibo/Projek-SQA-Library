@extends('base')
@section('konten')
<section class="bg-gray-50 dark:bg-gray-900 py-10">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
      @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
     @endif
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Profile Information
              </h1>
              <form class="space-y-4 md:space-y-6" action="{{ route('editProfile') }}" method="POST">
                @csrf
                <input type="hidden" name="uid" value="{{ Auth::user()->id }}">
                  <div>
                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                      <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ Auth::user()->name}}" required value ="{{ Auth::user()->name}}">
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ Auth::user()->email}}" required value ="{{ Auth::user()->email}}">
                      @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                      <input type="password" name="password" id="password" placeholder="New Password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>   
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                      <!-- <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""> -->
                      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>   
                  <div class="flex flex-wrap space-x-4">
                      <button type="reset" class="w-44 text-blue-500 outline bg-white hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Cancel</button>
                      <button type="submit" class="w-44 text-white bg-red-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</section>
@endsection

@section('script')
<script>
    function selectGender(value) {
        document.getElementById('gender').value = value;
        // console.log(value)
        document.getElementById('dropdownSelectGender').innerText = `Selected: ${value}`;
        document.getElementById('DropdownGender').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('dropdownSelectGender').innerText = `Selected: {{ Auth::user()->gender }}`;
    });
</script>
@endsection