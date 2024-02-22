<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" name="csrf-token" content="{{ csrf_token() }}"> 
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
    <div class="container mx-auto px-16 my-5 bg-gray-100">
        <div class="flex flex-col md:flex-row bg-white shadow-lg z-10 p-5 rounded">
            <div class="md:w-2/3">
                <!-- Image and Title -->
                <div class="flex items-start justify-between">
                    <div class="w-3/4">
                        <!-- Display Image -->
                        <a href="{{ asset('images/' . $post->image) }}" target="_blank">
                            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-full rounded cursor-pointer">
                        </a>
                        <div class="md:w-1/3 mt-3 justify-end">
                            <!-- Download Image Button -->
                            <a href="{{ asset('images/' . $post->image) }}" download="{{ $post->title }}.jpg" title="Download the image">
                                <button type="button" class="bg-white hover:invert p-2 rounded-full mr-2 transition-transform duration-300 transform hover:scale-105">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.163 2.819C9 3.139 9 3.559 9 4.4V11H7.803c-.883 0-1.325 0-1.534.176a.75.75 0 0 0-.266.62c.017.274.322.593.931 1.232l4.198 4.401c.302.318.453.476.63.535a.749.749 0 0 0 .476 0c.177-.059.328-.217.63-.535l4.198-4.4c.61-.64.914-.96.93-1.233a.75.75 0 0 0-.265-.62C17.522 11 17.081 11 16.197 11H15V4.4c0-.84 0-1.26-.164-1.581a1.5 1.5 0 0 0-.655-.656C13.861 2 13.441 2 12.6 2h-1.2c-.84 0-1.26 0-1.581.163a1.5 1.5 0 0 0-.656.656zM5 21a1 1 0 0 0 1 1h12a1 1 0 1 0 0-2H6a1 1 0 0 0-1 1z" fill="#000000"/>
                                    </svg>
                                </button>
                            </a>
                            <!-- Likes Button -->
                            <form id="likeForm" action="{{ route('posts.like', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button id="likeButton" type="submit" class="bg-white p-2 rounded-full transition-transform duration-300 transform hover:scale-105" title="Like the image" aria-label="Like the image">
                                    <svg fill="#000000" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.5,4.609A5.811,5.811,0,0,0,16,2.5a5.75,5.75,0,0,0-4,1.455A5.75,5.75,0,0,0,8,2.5,5.811,5.811,0,0,0,3.5,4.609c-.953,1.156-1.95,3.249-1.289,6.66,1.055,5.447,8.966,9.917,9.3,10.1a1,1,0,0,0,.974,0c.336-.187,8.247-4.657,9.3-10.1C22.45,7.858,21.453,5.765,20.5,4.609Zm-.674,6.28C19.08,14.74,13.658,18.322,12,19.34c-2.336-1.41-7.142-4.95-7.821-8.451-.513-2.646.189-4.183.869-5.007A3.819,3.819,0,0,1,8,4.5a3.493,3.493,0,0,1,3.115,1.469,1.005,1.005,0,0,0,1.76.011A3.489,3.489,0,0,1,16,4.5a3.819,3.819,0,0,1,2.959,1.382C19.637,6.706,20.339,8.243,19.826,10.889Z"/>
                                    </svg>
                                </button>
                            </form>
                            <!-- Likes Count -->
                            <span id="likeCount">{{ $post->likes_count }}</span>                            
                        </div>
                    </div>
                    <div class="w-2/4 ml-8">
                        <!-- Display Title -->
                        <h1 class="text-3xl font-bold mt-3">{{ $post->title }}</h1>
                        <p class="text-sm text-gray-500 italic">Uploaded by: <strong>{{ $post->user->name }}</strong></p>
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
                    <!-- Delete icon for comment owners -->
                    @if(auth()->id() === $comment->user_id)
                        <form action="{{ route('comments.delete', ['comment' => $comment->id]) }}" method="POST" class="absolute top-0 right-0 mt-8 mr-5">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-white rounded-full p-2 hover:bg-red-600 focus:outline-none transition-transform duration-300 transform hover:scale-105" title="Delete the comment">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 30 30">
                                    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
                                </svg>
                            </button>
                        </form>
                    @endif
                    <p>{{ $comment->content }}</p>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
        <!-- Comment Form -->
        <form action="{{ route('posts.comment', ['post' => $post->id]) }}" method="post" id="commentForm" class="mt-4">
            @csrf
            <div class="flex">
                <textarea name="content" id="commentContent" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" rows="3" placeholder="Add a comment"></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded">Submit</button>
            </div>
        </form> 
    </div>
    
    <script>
    // Select the like button
    document.addEventListener('DOMContentLoaded', function() {
    var likeForm = document.getElementById('likeForm');
    var likeCountElement = document.getElementById('likeCount');

    likeForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        var formData = new FormData(likeForm); // Get form data
        
        // Send AJAX request to like/unlike the post
        var xhr = new XMLHttpRequest();
        xhr.open('POST', likeForm.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    likeCountElement.innerText = response.likesCount;
                } else {
                    console.error('Error liking/unliking post:', xhr.status);
                }
            }
        };
        xhr.send(formData);
    });
});




        // Comment Submission
        $('#commentForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var $submitButton = $(this).find('button[type="submit"]');
            $submitButton.prop('disabled', true); // Disable the submit button to prevent multiple submissions
            formData.push({name: '_token', value: '{{ csrf_token() }}'});
            $.ajax({
                type: 'POST',
                url: '{{ route('posts.comment', ['post' => $post->id]) }}',
                data: formData,
                success: function(response) {
                    $('#comments').append('<div class="bg-gray-100 p-4 mb-2"><strong>' + response.user.name + '</strong><p>' + response.content + '</p><small>' + response.created_at + '</small></div>');
                    $('#commentContent').val('');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Optionally display an error message to the user
                },
                complete: function() {
                    $submitButton.prop('disabled', false); // Re-enable the submit button after request is complete
                }
            });
        });
    </script>
</body>
</html>
