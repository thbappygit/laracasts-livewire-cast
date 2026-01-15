<div x-data="{
        modalOpen: false,
        selectedId: null,
        toasts: [],
        addToast(type, message){
            const id = Date.now() + Math.random();
            this.toasts.push({ id, type, message });
            setTimeout(() => this.removeToast(id), 3500);
        },
        removeToast(id){
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }" x-on:notify.window="addToast($event.detail.type, $event.detail.message)"
    class="mx-auto w-11/12 lg:w-3/4 mb-6">

    <!-- Initial session toasts (create/update redirects) -->
    <div x-cloak x-init="
        $nextTick(() => {
            $el.dataset.success && addToast('success', $el.dataset.success);
            $el.dataset.error && addToast('error', $el.dataset.error);
        })
    " data-success="{{ session('success') }}" data-error="{{ session('error') }}">
    </div>

    <!-- Header actions -->
    <div class="mt-4 mb-3 flex flex-col sm:flex-row gap-3 sm:items-end sm:justify-between">
        <a wire:navigate href="{{ route('dashboard.articles.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-green-600 rounded-md shadow hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:outline-none">
            + Create Article
        </a>

        <div class="flex gap-2">
            <button wire:click="showAll" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-900 hover:bg-neutral-800 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:outline-none">
                Show All
            </button>
            <button wire:click="showPublished" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                Show Published: <livewire:published-count placeholder-text=" Counting.."/>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-sm bg-white">
        <table class="min-w-full">
            <thead>
            <tr class="bg-gray-800 text-white">
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Title</th>
                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($articles as $article)
                <tr wire:key="{{ $article->id }}" class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $article->id }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $article->title }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <!-- Ellipsis button -->
                            <button
                                @click="open = !open"
                                @click.outside="open = false"
                                class="inline-flex items-center justify-center rounded-full p-2
                   text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition"
                                title="Actions"
                            >
                                <!-- Heroicon: ellipsis-vertical -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" x-transition.opacity.scale.origin.top.right x-cloak class="absolute right-0 z-20 mt-2 w-36 origin-top-right rounded-md bg-white border border-gray-200 shadow-lg">
                                <a wire:navigate href="/dashboard/articles/{{ $article->id }}/edit" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    ✏️ Edit
                                </a>

                                <button @click="open=false; selectedId={{ $article->id }}; modalOpen=true" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    🗑 Delete
                                </button>
                            </div>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <div class="rounded-lg bg-white border border-gray-200 shadow-sm px-3 py-2">
            {{ $articles->links(data: ['scrollTo' => false]) }}
        </div>
    </div>


    <!-- Toasts -->
    <div class="fixed top-4 right-4 z-[100] space-y-2" aria-live="assertive">
        <template x-for="t in toasts" :key="t.id">
            <div x-show="true" x-transition.opacity.duration.300ms class="pointer-events-auto flex max-w-sm items-start gap-3 rounded-md border p-3 shadow-md"
                 :class="{
                    'bg-green-50 border-green-200 text-green-800': t.type==='success',
                    'bg-red-50 border-red-200 text-red-800': t.type==='error',
                    'bg-blue-50 border-blue-200 text-blue-800': t.type!=='success' && t.type!=='error'
                 }">
                <div class="shrink-0">
                    <template x-if="t.type==='success'">
                        <svg class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 10.736a1 1 0 111.414-1.414l3.05 3.05 6.657-6.657a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </template>
                    <template x-if="t.type==='error'">
                        <svg class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2H9v-2zm0-8h2v6H9V5z" clip-rule="evenodd"/></svg>
                    </template>
                </div>
                <div class="flex-1 text-sm" x-text="t.message"></div>
                <button @click="removeToast(t.id)" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" stroke="currentColor" fill="none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Confirmation Modal -->
    <template x-teleport="body">
        <div x-show="modalOpen" x-cloak class="fixed inset-0 z-[99] flex items-center justify-center">
            <!-- Backdrop -->
            <div x-show="modalOpen"
                 x-transition.opacity.duration.250ms
                 class="absolute inset-0 bg-black/40" @click="modalOpen=false"></div>
            <!-- Panel -->
            <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                 x-transition.scale.origin.top.duration.200ms
                 class="relative mx-4 w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">Delete Article</h3>
                        <p class="mt-1 text-sm text-gray-600">Are you sure you want to delete this article? This action cannot be undone.</p>
                    </div>
                    <button @click="modalOpen=false" class="rounded-full p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button @click="modalOpen=false" class="inline-flex items-center justify-center rounded-md border px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button @click="$wire.delete(selectedId); modalOpen=false" class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-600">Delete</button>
                </div>
            </div>
        </div>
    </template>
</div>
