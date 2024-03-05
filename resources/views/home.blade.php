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
    <div class="bg-gray-100 mb-6 ml-10 mt-10 text-center justify-center">
        <p>
            Browse an image based on its
        </p> 
        <h1 class="text-5xl mb-2 font-medium">
            <strong id="queryText" class="hover:underline cursor-pointer">Query!</strong> or <strong id="tagsText" class="hover:underline cursor-pointer">Tags!</strong>
        </h1>
    </div>
    <!-- Search Form for images -->
    <div id="searchFormImages" class="pb-2 mx-10 mt-5 bg-gray-100 relative">
        <div class="max-w-7xl sm:px-6 lg:px-8 px-4 pt-2 pb-5">
            <form id="search-form" action="{{ route('home') }}" method="GET">
                <div class="flex justify-center">
                    <input id="search-input" type="text" name="query" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" placeholder="Search images..." value="{{ $query }}">
                    <button type="submit" class="ml-2 bg-black hover:invert text-white font-bold py-2 px-4 rounded">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Search Form for tags -->
    <div id="searchFormTags" class="pb-2 mx-10 mt-5 bg-gray-100 relative hidden">
        <div class="max-w-7xl sm:px-6 lg:px-8 px-4 pt-2 pb-5">
            <form id="search-form-tags" action="{{ route('home') }}" method="GET">
                <div class="flex justify-center">
                    <input id="search-input-tags" type="text" name="tag" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" placeholder="Search by tag..." value="{{ $tag }}">
                    <button type="submit" class="ml-2 bg-black hover:invert text-white font-bold py-2 px-4 rounded">Search</button>
                </div>
            </form>
        </div>
        <!-- Tag Buttons -->
        <div id="tagButtons" class="bg-white mx-10 mr-10 focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-4 px-4 block w-33 appearance-none leading-normal hidden">
            <h1 class="text-1xl font-bold">
                Existing tags
            </h1>
            <div class="flex flex-wrap w-full">
                @foreach($tags as $tag)
                    <button class="tag-button mr-2 mt-2 bg-gray-100 p-2 rounded hover:invert relative transition-transform duration-300 transform hover:scale-105" onclick="submitTagForm('{{ $tag }}')">{{ $tag }}</button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pb-16 mx-10 mt-5 bg-gray-100 relative">
        @if($posts->isEmpty())
            <!-- Show "No Result Found" text and SVG icon -->
            <div class="flex flex-col items-center justify-center mt-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto fill-gray-500" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd" width="150" height="150" viewBox="0 0 32 32" id="no-results"><path d="m8.663 19.095-6.785 6.784a3.001 3.001 0 0 0 4.243 4.243l6.784-6.785A11.937 11.937 0 0 0 19 25c6.623 0 12-5.377 12-12S25.623 1 19 1 7 6.377 7 13c0 2.224.606 4.307 1.663 6.095Zm1.176 1.652-6.546 6.546a.999.999 0 1 0 1.414 1.414l6.546-6.546c-.51-.431-.983-.904-1.414-1.414ZM19 3c5.519 0 10 4.481 10 10s-4.481 10-10 10S9 18.519 9 13 13.481 3 19 3Zm0 2c-4.415 0-8 3.585-8 8s3.585 8 8 8 8-3.585 8-8-3.585-8-8-8Zm0 2c3.311 0 6 2.689 6 6s-2.689 6-6 6-6-2.689-6-6 2.689-6 6-6Zm-1.414 6-1.293 1.293a1 1 0 0 0 1.414 1.414L19 14.414l1.293 1.293a1 1 0 0 0 1.414-1.414L20.414 13l1.293-1.293a1 1 0 0 0-1.414-1.414L19 11.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L17.586 13Z"></path></svg>
                <h2 class="text-gray-500 text-2xl mt-5"><strong>No Results Found</strong> for <strong>"{{ $query }}"</strong>, i think you should <strong><a class="hover:underline hover:text-black" href="{{ route('dashboard')}}">upload!</a></strong> it first</h2>
            </div>
            @else
            <!-- Image Grid -->
            <div>
                <h1 class="text-3xl font-book">
                    Showing <strong>{{ count($posts) }}</strong> result
                    @if(request()->has('query'))
                        for "<strong>{{ request('query') }}</strong>" query
                    @elseif(request()->has('tag'))
                        for "<strong>{{ request('tag') }}</strong>" tags
                    @endif
                </h1>
            </div>
            <div class="p-5 mx-10 bg-white rounded shadow-lg mt-5 columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
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
            <div class="mt-24 ml-10">
                <h1 class="text-4xl font-medium text-center">
                    Not seeing your image up there?, lets try to <strong><a class="hover:underline" href="{{ route('dashboard')}}">Upload!</a></strong>
                </h1>
            </div>  
        @endif      
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

        document.addEventListener("DOMContentLoaded", function() {
            const tagsInput = document.getElementById("search-input-tags");
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


        document.getElementById("queryText").addEventListener("click", function() {
            document.getElementById("searchFormImages").classList.remove("hidden");
            document.getElementById("searchFormTags").classList.add("hidden");
        });

        document.getElementById("tagsText").addEventListener("click", function() {
            document.getElementById("searchFormImages").classList.add("hidden");
            document.getElementById("searchFormTags").classList.remove("hidden");
        });


        function submitTagForm(tag) {
            // Set the value of the tag input field
            document.getElementById("search-input-tags").value = tag;
            // Submit the tags search form
            document.getElementById("search-form-tags").submit();
        }

        // Show the tag buttons and hide the image search form when the Tags! text is clicked
        document.getElementById("tagsText").addEventListener("click", function() {
            document.getElementById("searchFormImages").classList.add("hidden");
            document.getElementById("searchFormTags").classList.remove("hidden");
            document.getElementById("tagButtons").classList.remove("hidden");
        });

        // Hide the tag buttons when the Query! text is clicked
        document.getElementById("queryText").addEventListener("click", function() {
            document.getElementById("tagButtons").classList.add("hidden");
        });
    </script>
</body>
</html>