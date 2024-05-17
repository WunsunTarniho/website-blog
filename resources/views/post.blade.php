@extends('main.main')

@section('container')
    <div
        class="relative isolate py-0 my-20 overflow-hidden bg-white lg:max-w-2xl px-6 sm:py-10 lg:overflow-visible lg:px-0 mx-auto">
        <div class="mx-auto max-w-3xl lg:mx-0 lg:max-w-2xl lg:items-start">
            <div class="lg:mx-auto lg:w-70 lg:max-w-7xl lg:px-8 pt-5 pb-10 px-50">
                @if (Auth::user()->id === $post->user->id || Auth::user()->role === 'admin')
                    <div class="mb-2">
                        <a href="/blog/{{ $post->id }}/edit"
                            class="inline-flex items-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-lg text-sm mr-1 px-2.5 py-2 dark:focus:ring-yellow-900">
                            <svg class="mr-1 w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </g>
                            </svg>
                            Edit
                        </a>
                        <form action="/blog/{{ $post->id }}" method="POST" class="inline-flex items-center">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="return confirm('Are sure to delete this post ?')"
                                class="inline-flex items-center focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-2 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                <svg class="mr-1 w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M10 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M14 11V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z"
                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
                <div class="lg:pr-4">
                    <div class="lg:max-w-lg">
                        <p class="text-base font-semibold leading-7 text-indigo-600">Author : {{ $post->user->username }}
                        </p>
                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-3xl text-justify">{{ $post->title }}
                        </h1>
                    </div>
                </div>
            </div>
            <div>
                @if($post->image)
                    <img class="max-w-md mx-auto mb-10 md:ml-10" src="{{ asset('storage/' . $post->image) }}" alt="post-image">
                @endif
            </div>
            <div class="lg:mx-auto lg:w-70 lg:max-w-3xl lg:px-8">
                <div class="lg:pr-4">
                    <span class="max-w-xl text-base leading-7 text-gray-700 lg:max-w-lg text-justify">
                        {!! $post->body !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
