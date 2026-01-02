<div class="max-w-lg mx-auto mt-10">
    <div class="bg-white shadow-md rounded-xl p-6">
        <h2 class="text-2xl font-bold mb-2 text-indigo-600 flex">
            {{$article->title}}
        </h2>
        <div class="mt-4">
            {{$article->content ?? ''}}
        </div>
    </div>
</div>
