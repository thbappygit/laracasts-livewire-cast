<div>
    <div>
        Hello {{ $name }}!
    </div>

    <form wire:submit="changeName(document.querySelector('#name').value)">
        <input type="text" id="name" placeholder="Enter your name" class="border rounded px-2 py-1">


        <div class="mt-4">
            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded">
                Greet Me
            </button>
        </div>
    </form>

</div>
