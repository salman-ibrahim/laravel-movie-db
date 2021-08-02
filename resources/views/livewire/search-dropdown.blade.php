<div class="relative"
     xmlns:wire="http://www.w3.org/1999/xhtml"
     x-data="{isOpen: true, autoComplete: false}" @click.away="isOpen = false">
    <label>
        <input

            wire:model.debounce.500ms="search"
            type="text"
            class="items-center bg-gray-800 focus:outline-none focus:shadow rounded-full w-64 px-4 py-1 pl-8"
            placeholder="Search (Press '/' to Focus)"
            x-ref="search"
            @keydown.window="
                if (event.keyCode === 111) {
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
            @focus="isOpen=true"
            @keydown.escape.window="isOpen=false; autoComplete = false; $event.target.blur()"
            @keydown.shift.tab="isOpen=false"
        >
    </label>
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>
    <div wire:loading.class="spinner top-0 right-0 mt-4 mr-4"></div>
    <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
         x-show.transition.scale.origin.top.opacity.duration.200ms="isOpen"
    >
        <ul>
            @if($searchResults->count()>0)
                @foreach($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a
                            href="{{ route('movies.show', $result['id']) }}"
                            class="block hover:bg-gray-700 ease-in-out transition duration-500 px-3 py-3 flex
                            items-center"
{{--                            To make it hide when tabbed to last item of search results      --}}
                            @if($loop->last){
                                @keydown.tab="isOpen=false"
                            }
                            @endif
                        >
                            <span class="w-8 mr-2">
                                @if($result['poster_path'])
                                    <img src="{{ 'https://images.tmdb.org/t/p/w92'.$result['poster_path'] }}" alt="X">
                                @else
                                    <img src="{{ 'https://via.placeholder.com/50x75' }}" alt="X">
                                @endif
                            </span>
                            {{ $result['title'] }}
                        </a>
                    </li>
                @endforeach
            @elseif(strlen($search) > 2)
                <li class="border-b border-gray-700">
                <a class="block hover:bg-gray-700 ease-in-out transition duration-500 px-3 py-3">
                    {{ "No results for: ".$search }}</a>
                </li>
            @endif
        </ul>
    </div>
</div>
