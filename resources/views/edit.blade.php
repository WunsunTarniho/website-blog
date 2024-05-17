@extends('main.main')

@section('container')
    <div
        class="flex my-20 overflow-y-auto overflow-x-hidden justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Post
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/blog/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Title" value="{{ old('title', $post->title) }}">
                            @error('title')
                                <div class="pl-0.5 pt-1 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="slug"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                            <input type="text" name="slug" id="slug"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="slug" value="{{ old('slug', $post->slug) }}">
                        </div>
                        <div>
                            @if ($post->image)
                                <img class="w-40 mb-1 block" id="previewImg" src="{{ asset('storage/' . $post->image) }}"
                                    alt="image-preview">
                            @else
                                <img class="w-40 mb-1 hidden" id="previewImg" src="" alt="image-preview">
                            @endif
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image (optional)</div>
                            <label for="image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">Choose
                                File</label>
                            <input type="file" name="image" id="image" class="hidden" onchange="previewImage()">
                            @error('image')
                                <div class="pl-0.5 pt-1 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($categories as $category)
                                    @if (old('category_id', $category->id) === $post->category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category')
                                <div class="pl-0.5 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                            <input type="hidden" id="body" name="body" value="{{ old('body', $post->body) }}">
                            @error('body')
                                <div class="mb-0.5 text-sm text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                            <trix-editor class="mt-1" input='body'></trix-editor>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-1 -ml-1 w-6 h-6" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
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
                        Edit a Post
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        title.addEventListener('change', () => {
            fetch('/post/createSlug?title=' + title.value)
                .then(response => response.json())
                .then(response => slug.value = response.slug);
        });
    </script>
@endsection
