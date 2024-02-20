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
<body>
    @include('layouts.navigation')
    <div class="container mx-auto p-16 pt-24 bg-gray-100">
        <div class="flex flex-col md:flex-row bg-white shadow-lg z-10 p-5 rounded">
            <div class="post">
                <!-- Display Image -->
                <a href="{{ asset('images/' . $post->image) }}" target="_blank">
                    <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="w-4/5 rounded cursor-pointer">
                </a>
                <!-- Display Title -->
                <h1 class="text-3xl font-bold mt-3">{{ $post->title }}</h1>
                <p class="text-sm text-gray-500 italic">Uploaded by: <strong>{{ $post->user->name }}</strong></p>
                <p class="font-book">{{ $post->description }}</p>
            </div>
            <div class="md:w-1/3 md:pl-8 ">
                <!-- Likes Button -->
                <button id="likeButton" type="submit" class="bg-gray-100 hover:invert p-2 rounded-full"><svg fill="#000000" width="35px" height="35px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.5,4.609A5.811,5.811,0,0,0,16,2.5a5.75,5.75,0,0,0-4,1.455A5.75,5.75,0,0,0,8,2.5,5.811,5.811,0,0,0,3.5,4.609c-.953,1.156-1.95,3.249-1.289,6.66,1.055,5.447,8.966,9.917,9.3,10.1a1,1,0,0,0,.974,0c.336-.187,8.247-4.657,9.3-10.1C22.45,7.858,21.453,5.765,20.5,4.609Zm-.674,6.28C19.08,14.74,13.658,18.322,12,19.34c-2.336-1.41-7.142-4.95-7.821-8.451-.513-2.646.189-4.183.869-5.007A3.819,3.819,0,0,1,8,4.5a3.493,3.493,0,0,1,3.115,1.469,1.005,1.005,0,0,0,1.76.011A3.489,3.489,0,0,1,16,4.5a3.819,3.819,0,0,1,2.959,1.382C19.637,6.706,20.339,8.243,19.826,10.889Z"/></svg></button>
                <span id="likeCount" class="ml-2">{{ $post->likes_count }}</span>
            </div>
        </div>
        <!-- Comments Section -->
        <div id="comments" class="mt-4">
            @foreach($post->comments as $comment)
                <div class="bg-gray-100 p-4 mb-2">
                    <strong>{{ $comment->user->name }}</strong>
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
        // Like Functionality
        $('#likeButton').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route('posts.like', ['post' => $post->id]) }}',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update the like count displayed on the page
                    $('#likeCount').text(response.likes);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // Comment Submission
        $('#commentForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var $submitButton = $(this).find('button[type="submit"]');
            $submitButton.prop('disabled', true); // Disable the submit button to prevent multiple submissions
            $.ajax({
                type: 'POST',
                url: '{{ route('posts.comment', ['post' => $post->id]) }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
