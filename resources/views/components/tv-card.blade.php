<div class="mt-8 p-2 border border-gray-700 rounded hover:bg-gray-700 transition
                    ease-in-out duration-500">
    <a href="{{ route('tv.show',$tv['id']) }}">
        <img src="{{ $tv['poster_path'] }}" alt="{{ $tv['name'] }}"
             class="hover:opacity-95 transition ease-in-out duration-500">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv.show',$tv['id']) }}" class="text-lg mt-2 hover:text-gray-300">
            {{ $tv['name'] }}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <span class="fill-current w-3.5 text-red-500">
                               <svg viewBox="0 0 1000 1000">
                                   <path d="M983,429L723,619L822,925C828,941,822,960,808,
                                       970C801,975,792,977,784,977C776,977,768,975,760,970L500,781L240,970C225,980,206,980,192,970C178,960,172,941,178,925L277,619L17,429C3,419-3,401,2,384C7,368,23,357,40,357H362L462,50C467,34,483,23,500,23C517,23,533,34,538,50L638,357H960C977,357,993,368,998,384C1003,401,997,419,983,429z"/>
                               </svg>
                            </span>
            <span class="ml-1">{{ $tv['vote_average'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $tv['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm"> {{ $tv['genres'] }}</div>
    </div>
</div>
