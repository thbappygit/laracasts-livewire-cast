<div class="mx-auto w-1/2 lg:w-3/4 mb-6 overflow-x-auto">

    <div class="mt-3 mb-2">
        <a  wire:navigate href="{{route('dashboard.articles.create')}}"
            class="px-6 py-2 active:scale-95 transition bg-blue-500 rounded text-white text-sm font-medium">

            Create Article
        </a>


    </div>


    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">

        <!-- Table Head -->
        <thead>
        <tr class="bg-gray-700 text-white">
            <th class="px-6 py-3 text-left text-xs font-semibold  uppercase">
                ID
            </th>
            <th class="px-6 py-3 text-left text-xs font-semibold  uppercase">
                Title
            </th>
            <th class="px-6 py-3 text-center text-xs font-semibold  uppercase">
                Actions
            </th>
        </tr>
        </thead>


        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-600">
        @foreach($articles as $article)
            <tr wire:key="{{ $article->id }}" class="hover:bg-gray-100 transition">

                <td class="px-6 py-4 text-sm font-medium text-gray-700">
                    {{ $article->id }}
                </td>

                <td class="px-6 py-4 text-sm text-gray-800">
                    {{ $article->title }}
                </td>

                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-4">

                        <!-- Edit -->
                        <a wire:navigate
                           href="/dashboard/articles/{{ $article->id }}/edit"
                           class="text-blue-600 hover:text-blue-800 transition"
                           title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                            </svg>
                        </a>

                        <!-- Delete -->
                        <button wire:click="delete({{ $article->id }})" wire:confirm="Are you sure you want to delete this article?"
                                class="text-red-600 hover:text-red-800 transition"
                                title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                    </div>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
