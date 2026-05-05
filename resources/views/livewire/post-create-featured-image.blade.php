<div>

    <div class="mt-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Featured Image
        </label>
        <input wire:model="featured_image" type="file"
            class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
        @error('featured_image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        @if ($featured_image && get_class($featured_image))
            @dd($featured_image);
            <div class="mt-2">
                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                <img src="{{ $featured_image->temporaryUrl() }}" alt="Image Preview"
                    class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
            </div>
        @endif
    </div>

</div>
