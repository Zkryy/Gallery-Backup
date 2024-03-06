<div class="max-w-lg ml-6 pb-8 pt-4 flex">
    <div class="w-full mr-10">
        <div class="my-3">
            <h1 class="text-2xl font-medium">
                <strong>Upload!</strong> your own image
            </h1> 
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
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                <input type="text" id="tags" name="tags" placeholder="tambah tags" class="mt-1 focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md" onkeydown="handleTagInput(event)">

                <!-- Add validation error message for tags if needed -->
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <div class="mt-1 flex items-center">
                    <label for="file-upload" class="cursor-pointer bg-gray-800 rounded-md font-medium text-white hover:text-white focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500 p-2">
                        <span>Choose Image</span>
                        <input id="file-upload" name="image" type="file" class="sr-only" onchange="previewImage(event)">
                    </label>
                </div>
                <!-- Warning message -->
                <div id="warning-message" class="hidden my-3 bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded" role="alert">
                    <h1 class="font-bold"> WARNING! </h1>
                    <p>Prohibition for uploading a sensitive images</p>
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
    <!-- Preview Image Container -->
    <div class="w-1/2 flex absolute top-0 right-0 mt-80">
        <svg xmlns="http://www.w3.org/2000/svg" class="pb-10" width="450" height="450" viewBox="0 0 512 512" id="upload"><path d="M398.1 233.2c0-1.2.2-2.4.2-3.6 0-65-51.8-117.6-115.7-117.6-46.1 0-85.7 27.4-104.3 67-8.1-4.1-17.2-6.5-26.8-6.5-29.5 0-54.1 21.9-58.8 50.5C57.3 235.2 32 269.1 32 309c0 50.2 40.1 91 89.5 91H224v-80h-48.2l80.2-83.7 80.2 83.6H288v80h110.3c45.2 0 81.7-37.5 81.7-83.4 0-45.9-36.7-83.2-81.9-83.3z"></path></svg>
        {{-- <div id="image-preview-container" class="relative hidden w-96 h-72">
            <!-- Adjust the width and height of the image to show the full image -->
            <img id="image-preview" class="object-cover w-full h-full rounded-md" alt="Image Preview">
            <p id="image-preview-filename" class="text-xs text-gray-600 mt-2"></p>
            <button type="button" id="cancel-preview-btn" class="absolute top-0 right-0 text-white transform translate-x-1/2 -translate-y-1/2 bg-black rounded-full p-1 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 filter invert">
                <span class="sr-only">Cancel</span>
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div> --}}
    </div>
</div>

<script>
        function previewImage(event) {
        // Your existing code for previewing the image

        // Show the warning message if necessary
        const file = event.target.files[0];
        const warningMessage = document.getElementById('warning-message');

        // Check if the file is an image or if it's sensitive/negative
        if (file && !isImage(file) || isSensitiveOrNegative(file)) {
            warningMessage.classList.remove('hidden');
        } else {
            warningMessage.classList.add('hidden');
        }
    }

    // Function to check if a file is an image
    function isImage(file) {
        return file.type.startsWith('image/');
    }

    // Function to check if a file is sensitive or negative (you need to implement this)
    function isSensitiveOrNegative(file) {
        // Implement your logic to check for sensitive or negative content
        // For demonstration purposes, let's assume we always show the warning
        return true;
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

    // function previewImage(event) {
    //     const input = event.target;
    //     const preview = document.getElementById('image-preview');
    //     const previewContainer = document.getElementById('image-preview-container');
    //     const cancelBtn = document.getElementById('cancel-preview-btn');

    //     if (input.files && input.files[0]) {
    //         const reader = new FileReader();

    //         reader.onload = function (e) {
    //             preview.src = e.target.result;
    //             previewContainer.classList.remove('hidden');
    //         }

    //         reader.readAsDataURL(input.files[0]);
    //     } else {
    //         preview.src = '';
    //         previewContainer.classList.add('hidden');
    //     }

    //     cancelBtn.addEventListener('click', function() {
    //         input.value = ''; // Clear the file input
    //         preview.src = ''; // Clear the image preview
    //         previewContainer.classList.add('hidden'); // Hide the preview container
    //     });
    // }
</script>