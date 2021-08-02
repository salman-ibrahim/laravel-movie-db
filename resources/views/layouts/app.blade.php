<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('//css/app.css')}}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>MovieFetch</title>
</head>
<body class="font-semibold bg-gray-900 text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">

{{--            Left Nav Items          --}}
            <ul class="flex flex-col md:flex-row items-center">
                <li class="md:mr-16 text-white border rounded border-gray-700 p-2">
                    <a href="{{ route('movies.index') }}">
                        <span class="flex items-center text-white">
                            <svg class="w-10 mr-2" fill="white" viewBox="0 0 1000 1000">
                                <path d="M994,514C983,495,958,487,938,499L800,579L766,599V789L798,808C799,808,799,809,800,809L935,888C941,892,950,895,958,895C981,895,999,877,999,854V693L1000,534C1000,527,999,520,994,514zM194,453C300,453,387,366,387,259C387,152,300,66,194,66C87,66,0,152,0,259C-1,366,87,453,194,453zM194,180C238,180,273,216,273,259C273,303,237,338,194,338C150,338,114,302,114,259C113,215,149,180,194,180zM684,463C653,479,618,489,581,489C535,489,492,475,456,451H319C282,475,239,489,194,489C156,489,121,480,90,463C63,479,43,510,43,544V837C43,891,88,934,141,934H635C689,934,732,890,732,837V544C731,510,712,479,684,463zM581,453C688,453,774,366,774,259C774,152,688,66,581,66C474,66,387,152,387,259C387,366,474,453,581,453zM581,180C625,180,660,216,660,259C660,303,624,338,581,338C537,338,501,302,501,259C501,215,536,180,581,180z"/>
                            </svg>
                            <span class="text-2xl">MovieFetch</span>
                        </span>

                    </a>
                </li>

                <li class="md:mr-6 mt-4 md:mt-0">
                    <a href="{{ route('movies.index') }}" class="border rounded border-gray-700 p-2
                    hover:text-gray-300 hover:bg-gray-700 transition ease-in-out duration-500">Movies</a>
                </li>

                <li class="md:mr-6 mt-4 md:mt-0">
                    <a href="{{ route('tv.index') }}" class="border rounded border-gray-700 p-2
                    hover:text-gray-300 hover:bg-gray-700 transition ease-in-out duration-500">TV Shows</a>
                </li>

                <li class="md:mr-6 mt-4 md:mt-0">
                    <a href="{{ route('actors.index') }}" class="border rounded border-gray-700 p-2
                    hover:text-gray-300 hover:bg-gray-700 transition ease-in-out duration-500">Actors</a>
                </li>
            </ul>

{{--            Right Nav Items     --}}
            <div class="flex flex-col mt-3 md:mt-0 md:flex-row items-center">

                <livewire:search-dropdown/>

                <div class="mt-3 md:mt-0 md:ml-4">
                    <a href="#">
                        <img src="{{asset('img/avatar.jpg')}}" alt="avatar" class="rounded-full w-8 h-8 border p-1
                        border-gray-700
                    hover:text-gray-300 hover:bg-gray-700 transition ease-in-out duration-500">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="mt-10">
        <div class="bg-gray-500 font-light h-10 p-2 items-center text-center">
            &copy; 2021. Designed by
            <a href="https://salman-ibrahim.github.io/">Salman</a>.
            API Provided by
            <a href="https://themoviedb.org" target="_blank">TMDb</a>.
        </div>
    </footer>

    @livewireScripts
    @yield('scripts')
</body>
</html>
