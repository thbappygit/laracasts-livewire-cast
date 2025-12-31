<div>
    <form wire:submit="changeGreeting()">
        <select class="border rounded p-4" wire:model.fill="greeting">
            <option value="Hello">Hello</option>
            <option value="Hi">Hi</option>
            <option value="Howdy" selected>Howdy</option>
            <option value="Hola">Hola</option>

        </select>

        <input type="text"  placeholder="Enter your name" class="border rounded px-2 py-1 mt-3" wire:model="name" />
        <br/>

        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror


        <div class="mt-4">
            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded">
                Greet Me
            </button>
        </div>
    </form>

    @if($greetingMessage !== '')
        <div>
            <h1 class="mt-4 text-2xl font-bold">{{ $greetingMessage }} !</h1>

        </div>

    @endif

</div>
