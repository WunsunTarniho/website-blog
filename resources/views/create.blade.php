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
                        Create Post
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/blog" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Title" value="{{ old('title') }}">
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
                                placeholder="slug" value="{{ old('slug') }}">
                        </div>
                        <div>
                            <img class="w-40 mb-1 hidden" id="previewImg" src="#" alt="image-preview">
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <input type="hidden" id="body" name="body" value="{{ old('body') }}">
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
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Create a Post
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
