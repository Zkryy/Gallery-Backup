<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome!</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/node_modules/@fortawesome/fontawesome-free/css/regular.css" rel="stylesheet">
    <style>
        /* Add any custom styles here */
        body {
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
        .container {
            max-width: 100%; /* Ensure content fits within viewport */
            padding: 0px; /* Adjust padding as needed */
        }
        /* Add more specific styles if necessary */
    </style>
</head>
<body>
    <nav class="bg-white shadow-lg w-screen fixed">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo"/> --}}
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Gallery!</span>
            </a>
            <div class="flex space-x-5 md:space-x-0 rtl:space-x-reverse text-right">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-black hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-800 font-bold rounded-lg text-sm px-4 py-2 text-center">Home</a>
                    @else
                        <a href="{{ url('/login') }}" class="text-black hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-800 font-bold rounded-lg text-sm px-4 py-2 text-center mr-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ url('/register') }}" class="text-black hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-800 font-bold rounded-lg text-sm px-4 py-2 text-center">Register</a>
                        @endif
                    @endauth
                @endif  
            </div>
        </div>
    </nav>
    <section class="bg-blue">
        <header class="text-center py-64 mb-24">
            <h1 class="text-6xl font-bold"><a class="font-medium">Welcome to</a> Gallery!</h1>
            <p class="text-xl mt-2">Lets find cool and beautiful picture for you.</p>
        </header>
    </section>
    <hr class="border-gray-300"/>
    <div class="container">
        <div class="bg-white-300 p-16 flex items-center mb-4">
            <img src="https://cdn.iconscout.com/icon/free/png-256/free-upload-486921-2364990.png" alt="upload icon" width="200px" class="mr-4">
            <div>
                <h1 class="text-3xl font-medium text-left mb-4">Upload</h1>
                <p class="text-left pl-1">
                    Experience seamless image sharing with our 'Upload Your Image' feature. Simply select your desired image file and effortlessly upload it to our platform for easy access, sharing, or editing. Start sharing your visuals now!
                </p>
            </div>
        </div>
        <hr class="border-gray-300"/>
        <div class="bg-white-300 p-16 flex items-center justify-end">
            <div class="text-right">
                <h1 class="text-3xl font-medium mb-4">Like</h1>
                <p class="pl-1">
                    Discover and express your appreciation for captivating visuals by liking images on our platform. Simply click the heart icon to show your admiration and curate your own personalized collection effortlessly.
                </p>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/128/3721/3721806.png" alt="upload icon" width="200px" class="ml-4">
        </div>
        <hr class="border-gray-300"/>
        <div class="bg-white-300 p-16 flex items-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/128/134/134723.png" alt="upload icon" width="200px" class="mr-4">
            <div>
                <h1 class="text-3xl font-medium text-left mb-4">Comments</h1>
                <p class="text-left pl-1">
                    Elevate engagement and foster community by leaving comments on images. Share your thoughts, provide feedback, or simply connect with fellow users. Enhance the visual experience and ignite meaningful conversations today.
                </p>
            </div>
        </div>
    </div>
    <footer class="bg-black w-screen h-[40px] flex text-center pt-2 shadow-lg">
        <h1 class="mx-auto text-gray-100">@copyright2024 | M.Dzikri Maulana</h1>
    </footer>
</body>
</html>