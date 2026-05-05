<div>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `General Settings` }" class="mb-6">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{ route('admin.dashboard') }}">
                                Home
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{ route('admin.settings') }}">
                                Settings
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                <div class="border-t border-gray-100 p-6 dark:border-gray-800 xl:p-10">
                    <form wire:submit.prevent="updateSetting">
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>

                        </div>
                        <div class="grid grid-cols-1 gap-2">
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="site_title"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        Site Title <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="site_title" wire:model="site_title" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter site name">
                                    @error('site_title')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="site_tagline"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        Tag Line <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="site_tagline" wire:model="site_tagline" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter site tag line">
                                    @error('site_tagline')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="phone"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        Phone <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="phone" wire:model="phone" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter Phone">
                                    @error('phone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="secondary_phone"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        secondary phone <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="secondary_phone" wire:model="secondary_phone" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter secondary phone">
                                    @error('secondary_phone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="email"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        Email <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="email" wire:model="email" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter email">
                                    @error('email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="address"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        address <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <input id="address" wire:model="address" type="text"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        placeholder="Enter address">
                                    @error('address')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <label for="footer_text"
                                        class="mb-2 block text-sm font-medium text-gray-800 dark:text-white/90">
                                        Footer text <span class="text-red-400 ml-2">*</span>
                                    </label>
                                    <textarea  id="footer_text" wire:model="footer_text" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" rows="4" placeholder="Enter footer_text"></textarea>
                                    @error('footer_text')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                                <div class="mt-2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Logo
                                    </label>
                                    <input wire:model="logo" type="file"
                                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                    @error('logo')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading wire:target="logo">
                                        <span class="text-xs text-gray-500">Uploading...</span>
                                    </div>

                                    @if ($logo)
                                        {{-- @dd($logo); --}}
                                        <div class="mt-2">
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                                            <img src="{{ $logo->temporaryUrl() }}" alt="Image Preview"
                                                class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
                                        </div>
                                    @elseif($old_logo)
                                       <div class="mt-2">
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                                            <img src="{{ asset($old_logo) }}" alt="Image Preview"
                                                class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Favicon
                                    </label>
                                    <input wire:model="favicon" type="file"
                                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                    @error('favicon')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading wire:target="favicon">
                                        <span class="text-xs text-gray-500">Uploading...</span>
                                    </div>

                                    @if ($favicon)
                                        {{-- @dd($favicon); --}}
                                        <div class="mt-2">
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                                            <img src="{{ $favicon->temporaryUrl() }}" alt="Image Preview"
                                                class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
                                        </div>
                                    @elseif($old_favicon)
                                       <div class="mt-2">
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Preview:</label>
                                            <img src="{{ asset($old_favicon) }}" alt="Image Preview"
                                                class="rounded-lg max-h-40 border border-gray-200 dark:border-gray-700">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->





</div>
