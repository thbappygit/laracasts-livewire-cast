<div class="{{ $show ? 'block' : 'hidden'}} mt-4 bg-white shadow-md rounded-lg p-4">
    <!-- Results -->
    <div class="mt-6 divide-y">
        @forelse($searchResults as $result)
            <div class="py-3 hover:bg-gray-50 px-2 rounded transition">
                <a href="/articles/{{$result->id}}" class="text-gray-800 font-medium">
                    {{ $result->title }}
                </a>

                <button wire:click="hello"
                    class="text-gray-100 bg-blue-700 rounded-full ring-1 ring-fuchsia-500
                             font-medium block truncate hover:text-gray-200 px-2 py-1 transition">
                    Click me For event
                </button>
            </div>
        @empty
            <div class="py-6 text-center text-gray-400">
                No results found
            </div>
        @endforelse
    </div>
</div>
