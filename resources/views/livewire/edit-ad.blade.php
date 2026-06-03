<div>
    <form wire:submit.prevent="updateAd" class="max-w-4xl">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-brand-600 to-brand-700 px-6 py-4 sm:px-8 sm:py-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Edit Advertisement</h2>
                    <!-- Status Toggle -->
                    <div class="flex items-center gap-3 bg-white/15 backdrop-blur-sm rounded-lg px-4 py-2.5 border border-white/20">
                        <label class="flex cursor-pointer items-center gap-4 text-white select-none" x-data="{ isActive: $wire.status === 'active' }">
                            <div class="relative h-6 w-11 flex-shrink-0 rounded-full overflow-hidden bg-white/20" :class="isActive ? 'bg-emerald-400/80' : 'bg-white/20'">
                                <input type="checkbox" class="sr-only" :checked="isActive" @change="isActive = !isActive; $wire.status = isActive ? 'active' : 'inactive'">
                                <div :class="isActive ? 'translate-x-2.5' : 'translate-x-0.5'"
                                    class="h-5 w-5 rounded-full bg-white shadow-lg transition-all duration-300 relative top-0.5 left-0.5"></div>
                            </div>
                            <span class="text-sm font-semibold whitespace-nowrap" x-text="isActive ? 'Active' : 'Inactive'"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6 sm:p-8 space-y-8">

                <!-- Basic Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Basic Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Ad Title
                            </label>
                            <input wire:model="title" type="text" placeholder="Enter ad title"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-400"/>
                            @error('title')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Expiry Date Field -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Expiry Date
                            </label>
                            <input wire:model="expire_at" type="datetime-local"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white"/>
                            @error('expire_at')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Link Section -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Ad Link
                    </label>
                    <input wire:model="link" type="text" placeholder="https://example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-400"/>
                    @error('link')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Section -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea wire:model="description" placeholder="Enter ad description" rows="5"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-400"></textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Section -->
                <div class="border-t border-gray-200 dark:border-gray-800 pt-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Ad Image
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Upload Area -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Upload Image
                            </label>
                            <div class="rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700 p-8 text-center hover:border-brand-500 hover:bg-brand-50 dark:hover:bg-brand-500/10 transition-colors cursor-pointer">
                                <svg class="mx-auto w-12 h-12 text-gray-400 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <label class="relative cursor-pointer">
                                    <span class="font-semibold text-brand-600 dark:text-brand-400">Upload a file</span>
                                    <input wire:model="image" type="file" class="sr-only"/>
                                </label>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-2">PNG, JPG up to 10MB (Recommended: 300x250 px, 3:2 ratio)</p>
                            </div>
                            @error('image')
                                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview Area -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                Preview
                            </label>
                            <div class="rounded-lg border border-gray-300 dark:border-gray-700 overflow-hidden bg-gray-50 dark:bg-gray-900 h-64 flex items-center justify-center">
                                @php
                                    $imageUrl = is_string($image) ? $image : (isset($image) && method_exists($image, 'temporaryUrl') ? $image->temporaryUrl() : '');
                                @endphp
                                @if ($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="Preview" class="w-full h-full object-cover"/>
                                @else
                                    <div class="text-center">
                                        <svg class="mx-auto w-12 h-12 text-gray-400 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">No image selected</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3 pt-4 border-t border-gray-200 dark:border-gray-800">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-brand-600 hover:bg-brand-700 px-6 py-3 text-base font-semibold text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Ad
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        Livewire.on('showSuccessAlert', () => {
            $toaster.fire({
                icon: 'success',
                title: 'Ad updated successfully!'
            });
        });
    </script>
@endpush
