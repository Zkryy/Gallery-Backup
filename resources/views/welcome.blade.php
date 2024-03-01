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
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg w-screen fixed z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
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
        <header class="text-center pt-52 pb-10 mb-5">
            <h1 class="text-6xl font-bold"><a class="font-medium">Welcome to</a> Gallery!</h1>
            <p class="text-xl mt-2">Lets find cool and beautiful picture for you.</p>
        </header>
    </section>
        <div class="bg-white rounded shadow-lg py-10 mx-16">
            <!-- Image Grid -->
            <div class="columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
                @foreach($samplePosts as $post)
                    <div class="flex justify-center relative group">
                        <a href="{{ route('detail_guest', ['post' => $post->id]) }}">
                            <div class="bg-gray-200 overflow-hidden rounded-lg relative transition-transform duration-300 transform hover:scale-105">
                                <img src="{{ asset('images/' . $post->image)}}" class="object-cover w-full aspect-square" alt="Post Image">
                                <!-- Title container -->
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-55 pt-2 pb-4 px-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h1 class="text-white text-center font-thin">{{ $post->title }}</h1>
                                </div>
                            </div> 
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    <section>
        <header class="text-center pt-24 pb-10 mb-24">
            <p class="text-xl mb-2">want to see another images?. you have to </p>
            <h1 class="text-5xl font-medium"><a href="{{ url('/login') }}" class="font-bold hover:underline">Log in!</a> or <a href="{{ url('/register') }}" class="font-bold hover:underline">Register!</a></h1>
        </header>
    </section>
    <hr class="border-gray-300"/>
    <div class="bg-white-300 p-16 flex items-center justify-end">
        <div class="text-right">
            <h1 class="text-3xl font-bold mb-4">Search!</h1>
            <p class="pl-1">
                Effortlessly discover desired images using the search feature. Enter keywords related to titles or descriptions, and instantly access relevant images tailored to your preferences. Simplify navigation and find your favorite content with ease.
            </p>
        </div>
        <img src="https://cdn-icons-png.flaticon.com/512/48/48639.png" alt="upload icon" width="200px" class="ml-4">
    </div>
    <hr class="border-gray-300"/>
    <div class="container">
        <div class="bg-white-300 p-16 flex items-center mb-4">
            <img src="https://cdn.iconscout.com/icon/free/png-256/free-upload-486921-2364990.png" alt="upload icon" width="200px" class="mr-4">
            <div>
                <h1 class="text-3xl font-bold text-left mb-4">Upload!</h1>
                <p class="text-left pl-1">
                    Experience seamless image sharing with our 'Upload Your Image' feature. Simply select your desired image file and effortlessly upload it to our platform for easy access, sharing, or editing. Start sharing your visuals now!
                </p>
            </div>
        </div>
        <hr class="border-gray-300"/>
        <div class="bg-white-300 p-16 flex items-center justify-end">
            <div class="text-right">
                <h1 class="text-3xl font-bold mb-4">Like!</h1>
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
                <h1 class="text-3xl font-bold text-left mb-4">Comments!</h1>
                <p class="text-left pl-1">
                    Elevate engagement and foster community by leaving comments on images. Share your thoughts, provide feedback, or simply connect with fellow users. Enhance the visual experience and ignite meaningful conversations today.
                </p>
            </div>
        </div>
        <hr class="border-gray-300"/>
        <div class="bg-white-300 p-16 flex items-center justify-end">
            <div class="text-right">
                <h1 class="text-3xl font-bold mb-4">Album!</h1>
                <p class="pl-1">
                    Effortlessly curate your image collection with the album feature. Organize and group your photos based on themes, events, or preferences to create personalized collections. Simplify navigation and showcase your content with ease.
                </p>
            </div>
            <img src="https://icon-library.com/images/album-icon/album-icon-3.jpg" alt="album icon" width="200px" class="ml-4">
        </div>
        <hr class="border-gray-300"/>
        <div class="bg-white-300 p-16 flex items-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/32/32355.png" alt="upload icon" width="200px" class="mr-4">
            <div>
                <h1 class="text-3xl font-bold text-left mb-4">Edit!</h1>
                <p class="text-left pl-1">     
                    Refine and perfect your image posts with the edit feature. Update captions and descriptions effortlessly to ensure your content accurately reflects your vision. Customize and enhance your posts seamlessly to captivate your audience.
                </p>
            </div>
        </div>
    </div>
    <footer class="bg-gray-100 mt-16">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="text-gray-500 self-center text-3xl font-semibold whitespace-nowrap">Gallery!</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="https://flowbite.com/" class="hover:underline">Gallery!™</a>. All Rights Reserved.</span>
        </div>
    </footer>    
</body>
</html>