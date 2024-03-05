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
            <h1 class="text-4xl mb-2 font-medium">
                introducing <strong>Kelompok 2</strong>
            </h1>
        </div>
    <div class="grid grid-cols-2 gap-6 my-10 ml-64 mr-10">
      <!-- Team Member 1 -->
      <div class="max-w-xs bg-white rounded overflow-hidden shadow-lg p-10">
          <img class="w-32 mx-auto rounded-full" src="/images/DSC_6741.JPG" alt="Team Member 1">
          <div class="text-center mt-2">
              <h3 class="text-lg font-semibold">M. Dzikri Maulana</h3>
          </div>
      </div>
  
      <!-- Team Member 2 -->
      <div class="max-w-xs bg-white rounded overflow-hidden shadow-lg p-10">
          <img class="w-32 h-32 mx-auto rounded-full" src="/images/DSC_6722.JPG" alt="Team Member 2">
          <div class="text-center mt-2">
              <h3 class="text-lg font-semibold">Synta</h3>
          </div>
      </div>
  
      <!-- Team Member 3 -->
      <div class="max-w-xs bg-white rounded overflow-hidden shadow-lg p-10">
          <img class="w-32 h-32 mx-auto rounded-full" src="/images/DSC_6745.JPG" alt="Team Member 3">
          <div class="text-center mt-2">
              <h3 class="text-lg font-semibold">Faridz Al-farizi</h3>
          </div>
      </div>

      <!-- Team Member 4 -->
      <div class="max-w-xs bg-white rounded overflow-hidden shadow-lg p-10">
          <img class="w-32 h-32 mx-auto rounded-full" src="/images/DSC_6759.JPG" alt="Team Member 4">
          <div class="text-center mt-2">
              <h3 class="text-lg font-semibold">Muhammad Agung</h3>
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
</body>
