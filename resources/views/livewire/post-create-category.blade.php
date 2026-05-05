<div>
    <div class="mt-2">
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Select Category
        </label>
        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
            <select wire:model="category_id" name="category_id"
                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">

                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                    Select a category
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        {{ $category->name }}
                    </option>
                    @if ($category->children->count() > 0)
                        @foreach ($category->children as $child)
                            <option value="{{ $child->id }}"
                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-4">
                                &#8195;{{ $child->name }}
                            </option>
                            @if ($child->children->count() > 0)
                                @foreach ($child->children as $child2)
                                    <option value="{{ $child2->id }}"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-6">
                                        &#8195; &#8195;{{ $child2->name }}
                                    </option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach

            </select>
            <span
                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </div>
        @error('parent_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <div class="align-right mt-2">
            <a class="text-sm text-blue-600 hover:underline" href="javascript:void(0)" wire:click="openCreateModal">
                Add New Category
            </a>
        </div>
    </div>
    <div x-data="{ open: @entangle('createModal') }" x-show="open"
        class="fixed inset-0 z-99999 flex items-center justify-center bg-black/50" x-transition>
        <div @click.away="open = false"
            class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transition dark:bg-gray-700" x-show="open"
            x-transition>
            <h2 class="text-lg font-semibold mb-4">Create New Category</h2>


            <form wire:submit.prevent="createCategory">

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Category Name
                    </label>
                    <input wire:model="name" type="text" placeholder="Enter full name"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Select Parent Category
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select wire:model="parent_id"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                            @change="isOptionSelected = true">

                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                No Parent Category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    {{ $category->name }}
                                </option>
                                @if ($category->children->count() > 0)
                                    @foreach ($category->children as $child)
                                        <option value="{{ $child->id }}"
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-4">
                                            &emsp;{{ $child->name }}
                                        </option>
                                        @if ($child->children->count() > 0)
                                @foreach ($child->children as $child2)
                                    <option value="{{ $child2->id }}"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-6">
                                        &#8195; &#8195;{{ $child2->name }}
                                    </option>
                                @endforeach
                            @endif
                                    @endforeach
                                @endif

                            @endforeach

                        </select>
                        <span
                            class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    @error('parent_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


            </form>

            <!-- Modal footer -->
            <div class="mt-4 flex justify-end gap-2">
                <button @click="open = false"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">Cancel</button>
                <button wire:click="createCategory"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </div>
    </div>
</div>
