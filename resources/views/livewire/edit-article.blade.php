<div x-data="{
    fileName: '',
    previewUrl: null,
    setFile(event) {
        const [file] = event.target.files;
        this.fileName = file ? file.name : '';
        this.previewUrl = file ? URL.createObjectURL(file) : null;
    }
}">
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

        <!-- Image Upload -->
        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-medium mb-2">Cover Image</label>
            <div class="flex items-start gap-4">
                <div class="w-32 h-32 rounded-md border bg-gray-50 flex items-center justify-center overflow-hidden">
                    @if(optional($this->articleForm->article)->image_url)
                        <img x-show="!previewUrl" src="{{ $this->articleForm->article->image_url }}" alt="Current Image" class="w-full h-full object-cover" />
                    @else
                        <div x-show="!previewUrl" class="text-gray-400 text-xs">No Image</div>
                    @endif
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Preview" class="w-full h-full object-cover" />
                    </template>
                </div>

                <div class="flex-1">
                    <input id="image" type="file" accept="image/*"
                           x-on:change="setFile($event)"
                           wire:model="articleForm.image"
                           class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-gray-800 cursor-pointer" />
                    <div class="mt-2 text-xs text-gray-500" x-text="fileName"></div>

                    <div class="mt-2 text-sm text-gray-600" wire:loading wire:target="articleForm.image">
                        Uploading... please wait
                    </div>
                    @error('articleForm.image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
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
