<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-xl p-6">
        <!-- Search Bar -->
        <form wire:submit.prevent>
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-4 h-4"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-4.35-4.35m1.6-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>

                    <input
                        type="text"
                        placeholder="{{$placeholder}}"
                        wire:model.live.debounce="searchText"
                        class="w-full pl-10 pr-3 py-2 border rounded-lg
                               focus:outline-none focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500"
                    />
                </div>

                <button
                    type="button"
                    wire:click.prevent="clear" {{empty($searchText) ? 'disabled' : ''}}
                    class="px-4 py-2 rounded-lg text-white bg-indigo-500
                           hover:bg-indigo-600 transition  disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    Clear
                </button>
            </div>
        </form>



        <livewire:search-result :searchResults="$searchResults" :show="!empty($searchText)"/>

    </div>
</div>
