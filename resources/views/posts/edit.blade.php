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
        <div class="flex items-start justify-center w-ful rounded relative">
            <button onclick="goBack()" type="button" title="back to previous page" class="absolute top-0 right-0 mb-15 bg-white hover:invert p-1 rounded-full transition-transform duration-300 transform hover:scale-105">
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
            <!-- Image -->
            <div class="w-full h-2/4 mt-2">
                <img src="{{ asset('images/' . $post->image)}}" class="object-cover w-full h-48 md:h-auto rounded" alt="Post Image">
            </div>            
            <!-- Form -->
            <div class="w-1/2 ml-8 mr-14">
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
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <input type="text" id="tags" name="tags" value="{{ $existingTags }}" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md" onkeydown="handleTagInput(event)">
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
    <footer class="bg-gray-100 mt-16">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="text-gray-500 self-center text-3xl font-semibold whitespace-nowrap">Gallery!</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="{{ route('about')}}" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="https://github.com/Zkryy/Gallery-Backup" class="hover:underline">Github</a>
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

        document.addEventListener("DOMContentLoaded", function() {
            const tagsInput = document.getElementById("tags");
            tagsInput.addEventListener("input", function() {
                const words = tagsInput.value.split(/\s+/);
                const formattedWords = words.map(word => {
                    if (!word.startsWith("#")) {
                        return "#" + word;
                    } else {
                        return word;
                    }
                });
                tagsInput.value = formattedWords.join(" ");
            });
    
            tagsInput.addEventListener("keydown", function(event) {
                if (event.key === "Backspace" && tagsInput.selectionStart === tagsInput.selectionEnd) {
                    const cursorPos = tagsInput.selectionStart;
                    if (tagsInput.value.charAt(cursorPos - 1) === "#") {
                        const newValue = tagsInput.value.substring(0, cursorPos - 1) + tagsInput.value.substring(cursorPos);
                        tagsInput.value = newValue;
                        tagsInput.setSelectionRange(cursorPos - 1, cursorPos - 1);
                        event.preventDefault();
                    }
                }
            });
        });
    </script>
</body>
</html>