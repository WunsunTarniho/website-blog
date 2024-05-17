@extends('main.main')

@section('container')
    <div class="flex flex-col justify-center items-center py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 md:h-screen">
        @if (session()->has('success'))
            <div id="alert-border-3"
                class="w-full max-w-md flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 ml-4 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-border-3" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <div
            class="relative mb-4 items-center w-full max-w-xl bg-white border border-gray-200 rounded-lg shadow pt-10 dark:bg-gray-800 dark:border-gray-700">
            <form class="grid sm:grid-cols-1 sm:grid-rows-6 md:grid-cols-5 md:grid-rows-8" action="/profile/edit" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="sm:row-span-1 sm:col-span-1 md:row-span-8 md:col-span-2 flex flex-col justify-center items-center pb-5">
                    <input class="hidden" type="file" id="image" name="image" onchange="previewImage()">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" id="previewImg"
                        src="{{ $user->image ? asset('storage/' . $user->image) : 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg' }}"
                        alt="Bonnie image" style="cursor: pointer" />
                    <label for="image"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</label>
                    @error('image')
                        <div class="pl-0.5 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="absolute top-0 right-0 justify-self-end py-1.5 px-3">
                    <!-- Dropdown menu -->
                    <button id="dropdownButton" data-dropdown-toggle="dropdownProfile"
                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                    </button>
                    <div id="dropdownProfile"
                        class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:col-span-3 md:row-span-2 sm:row-span-1 mx-4 my-1 mr-5">
                    <label for="username"
                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" name="username" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" value="{{ old('username', $user->username) }}">
                    @error('username')
                        <div class="pl-0.5 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="md:col-span-3 md:row-span-2 sm:row-span-1 mx-4 my-1 mr-5">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="pl-0.5 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="md:col-span-3 md:row-span-2 sm:row-span-1 mx-4 my-1.5 mr-5">
                    <label for="password"
                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" value="{{ $user->password }}">
                    @error('password')
                        <div class="pl-0.5 text-sm text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="md:col-span-3 md:row-span-2 m-5 sm:row-span-1 justify-self-center">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection