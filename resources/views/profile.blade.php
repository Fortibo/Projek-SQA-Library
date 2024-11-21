@extends('base')
@section('konten')
<div class="flex justify-center">
<div class="w-full px-6 sm:max-w-xl sm:rounded-lg">
    <div class="grid max-w-2xl mx-auto">
        <div class="items-center mb-16 sm:mt-14 text-[#202142]">
            <div
                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                <div class="w-full">
                    <label for="first_name" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                        Username</label>
                    <input type="text" id="first_name"
                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                        placeholder="Your first name" value="{{auth()->user()->name}}" required>
                </div>
            </div>

            <div class="mb-2 sm:mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                    email</label>
                <input type="email" id="email"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                    placeholder="your.email@mail.com" required>
            </div>

            <div class="mb-2 sm:mb-6">
                <label for="profession"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">password</label>
                <input type="text" id="profession"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                    placeholder="your profession" required>
            </div>

            <div class="mb-2 sm:mb-6">
                <label for="profession"
                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">confirm password</label>
                <input type="text" id="profession"
                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                    placeholder="your profession" required>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
            </div>

        </div>
    </div>
</div>
</div>
@endsection