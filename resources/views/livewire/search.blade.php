<div class="relative w-full">
    {{-- <h1 x-data x-on:click="$dispatch('cross:close-search')" class="cursor-pointer">hello</h1>--}}

    <!-- SEARCH FORM -->
    <form wire:submit.prevent class="w-full">
        <div class="relative flex items-center">

            <!-- SEARCH ICON -->
            <svg
                class="absolute left-3 text-gray-400 w-4 h-4 pointer-events-none"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            <!-- INPUT -->
            <input
                type="text"
                placeholder="{{ $placeholder }}"
                wire:model.live.debounce.300ms="searchText"
                class="w-full h-10 pl-9 pr-10 text-sm
                       bg-white/5 text-white placeholder-gray-400
                       border border-white/10 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500 transition"
            />

            <!-- CLEAR BUTTON (X) -->
            @if(!empty($searchText))
                <button
                    type="button"
                    wire:click="clear"
                    class="absolute right-2 text-gray-400 hover:text-white transition"
                >
                    ✕
                </button>
            @endif

        </div>
    </form>

    <!-- RESULTS -->
    <div class="absolute left-0 right-0 mt-2 z-50">
        <livewire:search-result
            :searchResults="$searchResults"
            :show="!empty($searchText)"
        />
    </div>

</div>
