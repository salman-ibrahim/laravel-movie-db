@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-red-500 text-lg">Popular Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularTv as $tv)
                    <x-tv-card :tv="$tv" :genres="$genres" />
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-red-500 text-lg">Top Rated Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($topRatedTv as $tv)
                    <x-tv-card :tv="$tv"/>
                @endforeach
            </div>
        </div>
    </div>

@endsection
