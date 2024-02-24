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
                @include('upload')
            </div>
        </div>
    </div>
    <div class="bg-gray-100 my-10 ml-10">
        <h1 class="text-3xl font-medium">
            You have <strong>{{ count(auth()->user()->posts) }} Image Post</strong> on your current Dashboard
        </h1>
        <p class="pl-1 pt-2">
            All image that Displaying down here are <strong>Image Post</strong> that you have been made, so you can change their <b>Title</b>, <b>Description</b>, or even <b>Delete</b> it. 
        </p>
    </div>  
    <div class="pb-5 mx-auto relative z-10">
        <div class="columns-4 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 relative z-10 bg-white p-10 mr-9 ml-9 rounded shadow-lg">
            @foreach($posts as $post)
                <div class="flex justify-center relative group">
                    <div class="bg-gray-200 overflow-hidden rounded-lg relative transition-transform duration-300 transform hover:scale-105">
                        <img src="{{ asset('images/' . $post->image)}}" class="object-cover w-full aspect-square" alt="Post Image">
                        <!-- Buttons for editing and deleting the post (positioned top right) -->
                        <div class="absolute top-0 right-0 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                            @if(auth()->id() === $post->user_id)
                                <!-- Edit post button -->
                                <div class="bg-white rounded-full p-2 hover:invert">
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path d="M 18 2 L 15.585938 4.4140625 L 19.585938 8.4140625 L 22 6 L 18 2 z M 14.076172 5.9238281 L 3 17 L 3 21 L 7 21 L 18.076172 9.9238281 L 14.076172 5.9238281 z"></path>
                                        </svg>
                                    </a> 
                                </div>
                                <form action="{{ route('posts.delete', ['post' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 rounded-full p-2 hover:bg-red-600 focus:outline-none mr-[85px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30">
                                            <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                            <!-- Show post button -->
                            <div class="bg-gray-500 px-4 py-2 rounded-lg hover:bg-gray-800 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500">
                                <a href="{{ route('detail', ['post' => $post->id]) }}">
                                    <h1 class="text-white">show</h1>
                                </a>
                            </div>
                        </div>
                        <!-- Title container -->
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-55 pt-2 pb-4 px-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <h1 class="text-white text-center font-book ">{{ $post->title }}</h1>
                        </div>
                    </div>
                </div>  
            @endforeach
        </div>
    </div>
</x-app-layout>