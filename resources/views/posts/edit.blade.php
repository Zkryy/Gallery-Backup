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
</head>
<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="pb-5 pt-10 justify-start ml-10">
        <h1 class="text-3xl text-left font-medium pb-2">
            <strong>Edit!</strong> your image post detail
        </h1>
        <p>
            on this page you can <b>change</b> or <b>update</b> previous detail of your <b>Image Post</b> so, dont worry if there's a typo when typed your <b>title</b> or <b>description</b>, we got you!
        </p>
    </div>

    <div class="max-w-screen-xl mx-auto flex justify-center mt-5 mr-10 ml-10 mb-10 bg-white rounded shadow-lg p-5">
        <div class="flex items-start justify-center w-full">
            <!-- Image -->
            <div>
                <img src="{{ asset('images/' . $post->image)}}" class="object-cover w-full h-48 md:h-auto rounded" alt="Post Image">
            </div>            
            <!-- Form -->
            <div class="w-1/2 ml-8 mt-10">
                <div class="">
                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" name="title" value="{{ $post->title }}" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full h-4/5 sm:text-sm border-gray-300 rounded-md">{{ $post->description }}</textarea>
                        </div>
                        <div>
                            @include('layouts.message')
                        </div>  
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-4 border border-transparent rounded-md text-base font-medium text-white bg-gray-800 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Update Detail
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>