<x-app-layout>
    <div class="pb-2 pt-32">
        <div class="max-w-7xl sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden rounded-lg shadow-md">
                @include('upload')
            </div>
        </div>
    </div>
    <div class="pt-2 pb-4 mx-auto bg-gray-100 relative z-10">
        <div class="columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
            @foreach($posts as $post)
            <div class="flex justify-center relative group">
                <!-- Wrap the image in an anchor tag with the route to the detail page -->
                <a href="{{ route('detail', ['post' => $post->id]) }}" class="relative z-10">
                    <div class="bg-gray-200 overflow-hidden rounded-lg relative transition-transform duration-300 transform hover:scale-105">
                        <img src="{{ asset('images/' . $post->image)}}" class="object-cover w-full aspect-square" alt="Post Image">
                        <!-- Button to add to album (positioned top right) -->
                        <button class="absolute top-2 right-2 bg-white text-black px-4 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform scale-0 group-hover:scale-100">
                            Add to Album
                        </button>
                        <!-- Semi-transparent overlay to enhance button visibility -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300"></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>