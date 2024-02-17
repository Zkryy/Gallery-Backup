@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-4 rounded" role="alert">
        <h1 class="font-bold">
            ERROR!
        </h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-4 rounded" role="alert">
        <h1 class="font-bold">
            SUCCESS!
        </h1>
        {{ session('message') }}
    </div>
@endif