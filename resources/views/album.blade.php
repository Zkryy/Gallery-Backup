<x-app-layout>
        <div class="bg-gray-100 mb-6 ml-10 mt-10 text-center justify-center">
        <h1 class="text-4xl mb-2 font-medium">
            welcome to <strong>Dashboard!</strong>
        </h1>
        <p>
            The dashboard feature offers users a centralized hub to manage their account, view personalized content, track activity, and access relevant tools or information, enhancing user experience and facilitating seamless navigation within the platform.
        </p>
    </div>
    <div class="pt-5 mb-16">
        <div class="max-w-7xl sm:px-6 lg:px-8 mb-1">
            <div class="bg-white overflow-hidden rounded-lg shadow-md">
                @include('create_album')
            </div>
        </div>
    </div>
    <!-- Other content omitted for brevity -->
    @if(isset($albums) && $albums->isEmpty())
        <div class="flex flex-col items-center justify-center mt-16 bg-white mx-10 py-16 rounded shadow-lg mb-16">
            <!-- SVG Icon -->
            <svg fill="#000000" width="100" height="100" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>no-image</title><path d="M30,3.4141,28.5859,2,2,28.5859,3.4141,30l2-2H26a2.0027,2.0027,0,0,0,2-2V5.4141ZM26,26H7.4141l7.7929-7.793,2.3788,2.3787a2,2,0,0,0,2.8284,0L22,19l4,3.9973Zm0-5.8318-2.5858-2.5859a2,2,0,0,0-2.8284,0L19,19.1682l-2.377-2.3771L26,7.4141Z"/><path d="M6,22V19l5-4.9966,1.3733,1.3733,1.4159-1.416-1.375-1.375a2,2,0,0,0-2.8284,0L6,16.1716V6H22V4H6A2.002,2.002,0,0,0,4,6V22Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
            <!-- Text -->
            <p class="text-black text-xl ml-3">It seems you haven't created any albums yet. Let's try to create your own album!</p>
        </div>
    @elseif(isset($albums))
        <!-- Album Grid -->
        <div class="columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10">
            @foreach($albums as $album)
                <div class="flex justify-center relative group">
                    <a href="{{ route('albums.show', ['album' => $album->id]) }}">
                        <div class="bg-gray-200 overflow-hidden rounded-lg relative transition-transform duration-300 transform hover:scale-105">
                            <!-- Display album cover image -->
                            <img src="{{ asset('path_to_album_cover/' . $album->cover_image)}}" class="object-cover w-full aspect-square" alt="Album Cover">
                            <!-- Title container -->
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-55 pt-2 pb-4 px-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h1 class="text-white text-center font-thin">{{ $album->title }}</h1>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
