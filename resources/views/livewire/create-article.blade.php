<div>
    <form wire:submit="save" class="w-9/12 mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Create New Article</h2>

        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" id="title" wire:model="form.title"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter article title">
            @error('form.title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Content Field -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
            <textarea id="content" wire:model="form.content" rows="6"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Enter article content"></textarea>
            @error('form.content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

{{--        publish status--}}
        <div class=" mb-4">
            <input wire:model.boolean="form.published"  type="checkbox" class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
            <label for="default-checkbox" class="select-none ms-2 text-sm font-medium text-heading">Published</label>
        </div>

        <div class="mb-4">

            <div>
                <div class="mb-2">Notification Options</div>
                <div class="flex gap-6">
                    <label class="flex items-center">
                        <input type="radio" value="email" class="mr-2" wire:model="form.notification">
                        Email
                    </label>

                    <label class="flex items-center">
                        <input type="radio" value="sms" class="mr-2" wire:model="form.notification">
                        SMS
                    </label>

                    <label class="flex items-center">
                        <input type="radio" value="none" class="mr-2" wire:model="form.notification">
                        None
                    </label>
                </div>
            </div>


        </div>


        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-gray-950 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" wire:target="save">
                                <span class="inline-flex items-center">
                                    <svg wire:loading wire:target="save" xmlns="http://www.w3.org/2000/svg"
                                         width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round" class="animate-spin mr-2 text-current">
                                        <path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path
                                            d="m16.2 16.2 2.9 2.9"/><path
                                            d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path
                                            d="m4.9 4.9 2.9 2.9"/>
                                    </svg>

                                    <span wire:loading.remove wire:target="save">Create Article</span>
                                    <span wire:loading wire:target="save">Creating...</span>
                                </span>
            </button>

        </div>

    </form>

</div>
