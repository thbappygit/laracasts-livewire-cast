<div class="{{ $show ? 'block' : 'hidden'}} mt-4 bg-white shadow-md rounded-lg p-4">
        <div class="mt-6 divide-y">
            @forelse($searchResults as $result)

                <div class="relative py-3 px-3 rounded hover:bg-gray-50 transition" wire:key="{{ $result->id }}">

                    <!-- Close Button -->
                    <button
                        class="absolute top-2 right-2 text-gray-900 hover:text-red-500
                           transition text-lg font-bold leading-none" wire:click="dispatch('cross:close-search')">
                        &times;
                    </button>

                    <!-- Title -->
                    <a wire:navigate href="/articles/{{ $result->id }}"
                       class="block text-gray-800 font-medium pr-8">
                        {{ $result->title }}
                    </a>

                    <!-- Action Button -->
                    <button
                        wire:click="hello"
                        class="mt-2 text-gray-100 bg-blue-700 rounded-full
                           ring-1 ring-fuchsia-500 font-medium
                           hover:bg-blue-800 px-3 py-1 transition"
                    >
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




