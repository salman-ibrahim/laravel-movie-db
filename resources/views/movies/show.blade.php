@extends('layouts.app')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row">
            <div class="flex-none p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
                <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-72">
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl">{{ $movie['title'] }}</h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                            <span class="fill-current w-4 text-red-500">
                               <svg viewBox="0 0 1000 1000">
                                   <path d="M983,429L723,619L822,925C828,941,822,960,808,
                                       970C801,975,792,977,784,977C776,977,768,975,760,970L500,781L240,970C225,980,206,980,192,970C178,960,172,941,178,925L277,619L17,429C3,419-3,401,2,384C7,368,23,357,40,357H362L462,50C467,34,483,23,500,23C517,23,533,34,538,50L638,357H960C977,357,993,368,998,384C1003,401,997,419,983,429z"/>
                               </svg>
                            </span>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        {{ $movie['genres'] }}
                    </span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movie['overview'] }}
                </p>

                <h4 class="text-white mt-5">Featured Crew</h4>
                <div class="flex mt-4">
                    @foreach($movie['crew'] as $crew)
                            <div class="mr-6 p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400"> {{ $crew['job'] }}</div>
                            </div>
                    @endforeach
                </div>

                <div x-data="{ isOpen: false }">
                    @if ($movie['trailer'])
                        <div class="mt-12">
                            <button
                                @click="isOpen = true"
                                class="flex inline-flex items-center bg-red-500 text-gray-900 rounded font-semibold
                                px-5 py-4 hover:bg-red-600 transition ease-in-out duration-500"
                            >
                                <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                <span class="ml-2">Play Trailer</span>
                            </button>
                        </div>

                        <template x-if="isOpen">
                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 h-full w-full flex items-center shadow-lg overflow-hidden"
                                x-show.transition.duration.300ms="isOpen"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click="isOpen = false"
                                                @keydown.escape.window="isOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body p-8">
                                            <div class="responsive-container overflow-hidden overflow-x-hidden relative"
                                                 style="padding-top: 56.25%">
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="{{ $movie['trailer'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @endif


                </div>
            </div>
        </div>
    </div>

{{--    End Movie Info  --}}

    <div class=""></div>
    <div class="movie-cast border-b border-grey-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Cast</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach($movie['cast'] as $cast)
                    <div class="mt-8 p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
                    <a href="{{ route('actors.show',$cast['id']) }}">
                        <img src="{{'https://image.tmdb.org/t/p/w200'.$cast['profile_path']}}" alt="{{ $cast['name'] }}"
                             class="hover:opacity-95
                        transition
                        ease-in-out
                         duration-500">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show',$cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{
                        $cast['character']
                        }}</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span>{{ $cast['name'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>

    </div>
{{--    Movie Cast Info Ends--}}

{{--    Start Movie Screens Info   --}}

    <div class="movie-images" x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($movie['screens'] as $image)
                    <div class="mt-8 p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
                        <a
                            @click.prevent="
                                isOpen = true
                                image='{{ $image }}'
                            "
                            href="#"
                        >
                            <img src="{{ $image }}" alt="poster" class="hover:opacity-95 transition ease-in-out
                            duration-150">
                        </a>
                    </div>
                @endforeach
            </div>

            <div
                style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-hidden"
                x-show.transition.duration.300ms="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button
                                @click="isOpen = false"
                                @keydown.escape.window="isOpen = false; image=''"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--   end movie-images   --}}
@endsection
