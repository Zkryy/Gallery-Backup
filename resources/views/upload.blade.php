<div class="max-w-lg ml-6 pb-6">
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter your image title" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md">
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="3" placeholder="Enter description" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
        </div>
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <div class="mt-1 flex items-center">
                <label for="file-upload" class="cursor-pointer bg-gray-800 rounded-md font-medium text-white hover:text-white focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500 p-2">
                    <span>Choose Image</span>
                    <input id="file-upload" name="image" type="file" class="sr-only" onchange="previewImage(event)">
                </label>
                <!-- Image preview container -->
                <div id="image-preview-container" class="ml-4 relative hidden w-20 h-20">
                    <img id="image-preview" class="object-cover w-full h-full rounded-md" alt="Image Preview">
                    <button type="button" id="cancel-preview-btn" class="absolute top-0 right-0 text-white transform translate-x-1/2 -translate-y-1/2 bg-black rounded-full p-1 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 filter invert">
                        <span class="sr-only">Cancel</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>  
        </div>  
        <div>
            @include('layouts.message')
        </div>
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-4 border border-transparent rounded-md text-base font-medium text-white bg-gray-800 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Submit
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('image-preview-container');
        const cancelBtn = document.getElementById('cancel-preview-btn');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            previewContainer.classList.add('hidden');
        }

        cancelBtn.addEventListener('click', function() {
            input.value = ''; // Clear the file input
            preview.src = ''; // Clear the image preview
            previewContainer.classList.add('hidden'); // Hide the preview container
        });
    }
</script>