<div>
    <form wire:submit="save" class="w-9/12 mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Edit Article</h2>

        <!-- Title Field -->
        <div class="mb-4">
            <label wire:dirty.class="text-orange-500" wire:target="articleForm.title" for="title" class="block text-gray-700 font-medium mb-2">
                Title <span wire:dirty wire:target="articleForm.title">*</span>
            </label>
            <input type="text" id="title" wire:model="articleForm.title"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter article title">
            @error('articleForm.title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Content Field -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-medium mb-2" wire:dirty.class="text-orange-500"
                   wire:target="articleForm.content">
                Content <span wire:dirty wire:target="articleForm.content">*</span>

            </label>
            <textarea id="content" wire:model="articleForm.content" rows="6"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Enter article content"></textarea>
            @error('articleForm.content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>



        {{--        publish status--}}
        <div class=" mb-4">
            <input wire:model.boolean="articleForm.published"  type="checkbox" class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft">
            <label for="default-checkbox" class="select-none ms-2 text-sm font-medium text-heading" wire:dirty.class="text-orange-500" wire:target="articleForm.published">
                Published <span wire:dirty wire:target="articleForm.published">*</span>
            </label>
        </div>

        <div class="mb-4">

            <div>
                <div wire:dirty.class="text-orange-500" wire:target="articleForm.notification" class="mb-2">Notification Options <span wire:dirty wire:target="articleForm.notification">*</span></div>
                <div class="flex gap-6">
                    <label class="flex items-center">
                        <input type="radio" value="email" class="mr-2" wire:model="articleForm.notification">
                        Email
                    </label>

                    <label class="flex items-center">
                        <input type="radio" value="sms" class="mr-2" wire:model="articleForm.notification">
                        SMS
                    </label>

                    <label class="flex items-center">
                        <input type="radio" value="none" class="mr-2" wire:model="articleForm.notification">
                        None
                    </label>
                </div>
            </div>


        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button disabled
                type="submit"
                    wire:dirty.class="hover:bg-gray-700"
                wire:dirty.remove.attr="disabled"
                class="bg-gray-950 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition flex items-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <!-- Spinner -->
                <svg
                    wire:loading
                    wire:target="save"
                    class="animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>
                </svg>

                <!-- Button Text -->
                <span wire:loading.remove wire:target="save">
            Update Article
        </span>
                <span wire:loading wire:target="save">
            Processing...
        </span>
            </button>
        </div>


    </form>

</div>
