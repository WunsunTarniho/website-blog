<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>

<body>
    <div class="bg-white">

        {{-- Navbar --}}
        @include('main.header')

        <div class="relative isolate px-6 pt-14 lg:px-8">
            {{-- Block Warna --}}
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <section class="bg-transparent dark:bg-gray-900">
                @yield('container')
            </section>
        </div>
    </div>


    {{-- Footer --}}
    @include('main.footer')
    <script>
        const previewImage = () => {
            const previewImg = document.getElementById('previewImg');
            const image = document.getElementById('image');
            previewImg.style.display = 'block';
            previewImg.style.border = '1px solid black';
            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

            reader.onload = (readerEvent) => {
                previewImg.src = readerEvent.target.result;
            }
        }

        const visibility = () => {
            const password = document.getElementById('password');
            password.type = password.type === 'text' ? 'password' : 'text';
        }
    </script>
</body>

</html>
