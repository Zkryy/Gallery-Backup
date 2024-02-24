<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery!</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Add the Font Awesome CSS file to your HTML or blade file -->
    <link href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="pb-16 mt-10 mx-auto bg-gray-100 relative">
        <!-- Search Form -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 pt-2 pb-5">
            <form action="{{ route('home') }}" method="GET">
                <div class="flex justify-center">
                    <input type="text" name="query" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" placeholder="Search images...">
                    <button type="submit" class="ml-2 bg-black hover:invert text-white font-bold py-2 px-4 rounded">Search</button>
                </div>
            </form>
        </div>
        <!-- Image Grid -->
        <div class="columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
            @foreach($posts as $post)
                <div class="flex justify-center relative group">
                    <a href="{{ route('detail', ['post' => $post->id]) }}">
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
    <div class="mt-3 mb-16 ml-10">
        <h1 class="text-4xl font-medium">
            Not seeing your image up there?, lets try to <strong><a class="hover:underline" href="{{ route('dashboard')}}">Upload!</a></strong>
        </h1>
    </div>  
</body>

</html>