@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-red-500 text-lg">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularActors as $actor)

                    {{--    Actor Card Start    --}}
                    <div class="actor mt-8 p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
                        <a href="{{ route('actors.show', $actor['id']) }}">
                            <img src="{{$actor['profile_path']}}"
                                 alt="profile image"
                                 class="hover:opacity-95 transition ease-in-out duration-500"
                            >
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{
                            $actor['name']
                            }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                    {{--                Actor Card Ends     --}}
                @endforeach

            </div>

            <div class="page-load-status my-8">
                <div class="flex justify-center">
                    <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
                </div>
                <div class="flex justify-center my-4">
                    <div class="infinite-scroll-last py-2 px-4 border border-green-500 rounded hover:bg-green-500
                    transition ease-in-out duration-500">End of
                        content</div>
                    <div class="infinite-scroll-error py-2 px-4 border border-red-600 rounded hover:bg-red-600 transition ease-in-out duration-500">Uh
                        Oh...
                        Something went wrong.</div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            history: false,
            status: '.page-load-status',
        });
    </script>
@endsection
