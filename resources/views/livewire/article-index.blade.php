<div class="m-auto w-1/2">
    @foreach($articles as $article)
        <div class="mb-4 p-4 border rounded-lg hover:shadow-lg transition" wire:key="{{ $article->id }}">
            <h2 class="text-xl font-semibold mb-2">{{ $article->title }}</h2>
            <p class="text-gray-700">{{ Str::limit($article->content, 300) }}</p>
            <a wire:navigate href="/articles/{{ $article->id }}" class="text-indigo-600 hover:underline mt-2 inline-block">Read more</a>
        </div>

    @endforeach
</div>
