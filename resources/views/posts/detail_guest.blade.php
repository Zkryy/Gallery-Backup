<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title>{{ $post->title }}</title>
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            <!-- Add the Font Awesome CSS file to your HTML or blade file -->
            <link href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style type="text/tailwindcss">

                /* CSS to invert the filter for the like button when liked */
        .like-button.liked {
            filter: invert(100%);
        }

    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg w-screen fixed z-50">
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
    <div class="container mx-auto px-16 mb-5 bg-gray-100 pt-32">
        <div class="flex flex-col md:flex-row bg-white shadow-lg z-10 p-5 rounded relative">
            <button onclick="goBack()" type="button" class="absolute top-0 right-0 m-4 p-1 bg-white hover:invert rounded-full mr-4 transition-transform duration-300 transform hover:scale-105">
                <svg fill="#000000" height="40" width="40" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    viewBox="0 0 219.151 219.151" xml:space="preserve">
                <g>
                    <path d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575
                        C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575
                        c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z"/>
                    <path d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008
                        c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825
                        c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628
                        c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z"/>
                </g>
                </svg>
            </button> 
            <div class="md:w-2/3">
                <!-- Image and Title -->
                <div class="flex items-start justify-between">
                    <div class="w-3/4">
                        <!-- Display Image -->
                        <a href="{{ asset('images/' . $post->image) }}" target="_blank">
                            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full rounded cursor-pointer">
                        </a>
                        <div class="flex mt-3 justify-start">
                            <!-- Download Image Button -->
                            <a href="{{ asset('images/' . $post->image) }}" download="{{ $post->title }}.jpg" title="Download the image">
                                <button type="button" class="bg-white hover:invert p-2 rounded-full mr-2 transition-transform duration-300 transform hover:scale-105">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/>
                                    </svg>
                                </button>
                            </a>
                            <!-- Likes Button -->
                            <div class="bg-white p-2 rounded-full transition-transform duration-300 transform hover:scale-105 hover:invert" title="Like the image" aria-label="Like the image">
                                <a href="{{ url('/login') }}">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.5,4.609A5.811,5.811,0,0,0,16,2.5a5.75,5.75,0,0,0-4,1.455A5.75,5.75,0,0,0,8,2.5,5.811,5.811,0,0,0,3.5,4.609c-.953,1.156-1.95,3.249-1.289,6.66,1.055,5.447,8.966,9.917,9.3,10.1a1,1,0,0,0,.974,0c.336-.187,8.247-4.657,9.3-10.1C22.45,7.858,21.453,5.765,20.5,4.609Zm-.674,6.28C19.08,14.74,13.658,18.322,12,19.34c-2.336-1.41-7.142-4.95-7.821-8.451-.513-2.646.189-4.183.869-5.007A3.819,3.819,0,0,1,8,4.5a3.493,3.493,0,0,1,3.115,1.469,1.005,1.005,0,0,0,1.76.011A3.489,3.489,0,0,1,16,4.5a3.819,3.819,0,0,1,2.959,1.382C19.637,6.706,20.339,8.243,19.826,10.889Z"/>
                                    </svg>
                                </a>
                            </div>
                            <!-- Likes Count -->
                            <span id="likeCount" class="pt-3 ml-1">{{ $post->likes_count }}</span>                                                                                  
                        </div>
                    </div>
                    <div class="w-2/4 ml-8">
                        <!-- Display Title -->
                        <h1 class="text-3xl font-bold mt-3">{{ $post->title }}</h1>
                        <p class="text-sm text-gray-500 italic">Uploaded by: <strong>{{ $post->user->name }}</strong></p>
                        <!-- Display Tags -->
                        @if($post->tags->isEmpty())
                            @else
                                <!-- Display Tags -->
                                <div class="my-4 flex">
                                    @foreach($post->tags as $tag)
                                        <div class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded-lg mr-2">{{ $tag->name }}</div>
                                    @endforeach
                                </div>
                        @endif
                        <p class="font-book">{{ $post->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments Section -->
        <div id="comments" class="mt-4">
            @foreach($post->comments as $comment)
                <div class="bg-white rounded shadow-lg p-4 mb-2 relative">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->content }}</p>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    </div>
    <footer class="bg-gray-100 mt-16">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="text-gray-400 self-center text-3xl font-semibold whitespace-nowrap">Gallery!</span>
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
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
