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
            <div class="w-3/4">
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
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            {{-- <input type="text" id="tags" name="tags" value="{{ $existingTags }}" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md" onkeydown="handleTagInput(event)"> --}}
                            <input type="text" id="tags" name="tags" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md" onkeydown="handleTagInput(event)">
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