<div class="{{ $show ? 'block' : 'hidden'}} mt-4 bg-white shadow-md rounded-lg p-4">
    <!-- Results -->
    <div class="mt-6 divide-y">
        @forelse($searchResults as $result)
            <div class="py-3 hover:bg-gray-50 px-2 rounded transition">
                <a href="/articles/{{$result->id}}" class="text-gray-800 font-medium">
                    {{ $result->title }}
                </a>
            </div>
        @empty
            <div class="py-6 text-center text-gray-400">
                No results found
            </div>
        @endforelse
    </div>
</div>
