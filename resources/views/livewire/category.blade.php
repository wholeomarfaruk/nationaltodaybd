<div>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Manage Categories` }" class="mb-4">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{ route('admin.dashboard') }}">
                                Home
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round" />
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
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            @can('category.create')
                            <!-- Modal -->
                            <button wire:click="openCreateModal"
                                class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                                Create New Category
                            </button>
                            @endcan

                            <!-- End Modal -->
                        </div>
                        <div>
                            <input type="text" wire:model.live="search" placeholder="Search by name"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <!-- ====== Table Six Start -->
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">

                            <nav class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <ul class="space-y-2">

                                    @foreach ($categories as $index => $category)


                                        <li>
                                            <input type="checkbox" id="menu{{ $index}}" class="peer hidden">
                                            <label for="menu{{ $index }}"
                                                class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg flex items-center justify-between group">

                                                <div class="flex items-center justify-start space-x-2">
                                                    <div>{{ $category->name }}</div>

                                                    <!-- Edit Button -->
                                                    <button wire:click="openEditModal({{ $category->id }})" type="button"
                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd"
                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>

                                                    <!-- Delete Button -->
                                                    {{-- <button wire:click="delete({{ $category->id }})" type="button"
                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-red-300 rounded-lg text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 10-1.553.894L9 4zm3 1a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 1a1 1 0 000 2v1a1 1 0 11-2 0V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button> --}}
                                                </div>

                                                @if ($category->children->count() > 0)
                                                    <svg class="w-4 h-4 transform peer-checked:rotate-90 transition-transform duration-200"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                @endif
                                            </label>

                                            @if ($category->children->count() > 0)


                                                <ul class="pl-4 mt-2 space-y-1 bg-gray-50 hidden
                                                                                                           peer-checked:block">
                                                    @foreach ($category->children as $indexChild => $child)


                                                        <li>
                                                            <input type="checkbox" id="menu{{$index}}-{{ $indexChild}}"
                                                                class="peer hidden">
                                                            <label for="menu{{$index}}-{{ $indexChild}}"
                                                                class="w-full px-4 py-2 bg-gray-200
                                                                                                                                                                    hover:bg-gray-300
                                                                                                                                                   cursor-pointer
                                                                                                                                                   rounded-lg flex items-center justify-between group">

                                                                <div class="flex items-center justify-start space-x-2">
                                                                    <div>{{ $child->name }}</div>

                                                                    <!-- Edit Button -->
                                                                    <button wire:click="openEditModal({{ $child->id }})" type="button"
                                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                                            viewBox="0 0 20 20" fill="currentColor">
                                                                            <path
                                                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                            <path fill-rule="evenodd"
                                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button>

                                                                    <!-- Delete Button -->
                                                                    {{-- <button wire:click="delete({{ $child->id }})" type="button"
                                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-red-300 rounded-lg text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                                            viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd"
                                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 10-1.553.894L9 4zm3 1a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 1a1 1 0 000 2v1a1 1 0 11-2 0V6z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </button> --}}
                                                                </div>

                                                                @if ($child->children->count() > 0)
                                                                    <svg class="w-4 h-4 transform peer-checked:rotate-90
                                                                                                                                                                                    transition-transform duration-200"
                                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                                    </svg>
                                                                @endif
                                                            </label>
                                                            @if ($child->children->count() > 0)
                                                                <ul
                                                                    class="pl-4 mt-1 space-y-1 bg-gray-100 hidden
                                                                                                                                                                                   peer-checked:block">
                                                                    @foreach ($child->children as $indexChild2 => $child2)

                                                                        <li>
                                                                            <label
                                                                                class="w-full px-4 py-2 bg-gray-200
                                                                                                                                                                            hover:bg-gray-300
                                                                                                                                                           cursor-pointer
                                                                                                                                                           rounded-lg flex items-center justify-between group">

                                                                                <div class="flex items-center justify-start space-x-2">
                                                                                    <div>{{ $child2->name }}</div>

                                                                                    <!-- Edit Button -->
                                                                                    <button wire:click="openEditModal({{ $child2->id }})"
                                                                                        type="button"
                                                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-3 w-3" viewBox="0 0 20 20"
                                                                                            fill="currentColor">
                                                                                            <path
                                                                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                                            <path fill-rule="evenodd"
                                                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                                                clip-rule="evenodd" />
                                                                                        </svg>
                                                                                    </button>

                                                                                    <!-- Delete Button -->
                                                                                    {{-- <button wire:click="delete({{ $child2->id }})"
                                                                                        type="button"
                                                                                        class="hidden group-hover:inline-flex items-center px-2 py-1 border border-red-300 rounded-lg text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-3 w-3" viewBox="0 0 20 20"
                                                                                            fill="currentColor">
                                                                                            <path fill-rule="evenodd"
                                                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 10-1.553.894L9 4zm3 1a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 1a1 1 0 000 2v1a1 1 0 11-2 0V6z"
                                                                                                clip-rule="evenodd" />
                                                                                        </svg>
                                                                                    </button> --}}
                                                                                </div>


                                                                            </label>

                                                                        </li>
                                                                    @endforeach


                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach


                                </ul>
                            </nav>

                        </div>
                    </div>
                    <!-- ====== Table Six End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    {{-- <div x-data="{ open: @entangle('editModal') }" x-show="open"
        class="fixed inset-0 z-99999 flex items-center justify-center bg-black/50" x-transition>
        <div @click.away="open = false"
            class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transition dark:bg-gray-700" x-show="open"
            x-transition>
            <h2 class="text-lg font-semibold mb-4">Edit User</h2>

            <form wire:submit.prevent="updateUser">

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Full Name
                    </label>
                    <input wire:model="name" type="text" placeholder="Enter full name"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>

                    @enderror
                </div>
                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Email Address
                    </label>
                    <input wire:model="email" type="email" placeholder="Enter email address"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        New Password
                    </label>
                    <div x-data="{ showPassword: false }" class="relative">
                        <input wire:model="password" :type="showPassword ? 'text' : 'password'"
                            placeholder="Enter New password"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        <span @click="showPassword = !showPassword"
                            class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                            <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" />
                            </svg>

                            <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" />
                            </svg>
                        </span>
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>

                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Select Role
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select wire:model="selectedRole"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                            @change="isOptionSelected = true">

                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                Select Option
                            </option>
                            @foreach ($roles as $role)


                            <option value="{{ $role->id }}" {{ $role->name == $selectedRole ? 'selected' : '' }}
                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                {{ $role->name }}
                            </option>
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
                    @error('selectedRole')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


            </form>

            <!-- Modal footer -->
            <div class="mt-4 flex justify-end">
                <button wire:click="closeEditModal" @click="open = false"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2 hover:bg-gray-400inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">Cancel</button>
                <button wire:click="updateUser"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </div>
    </div> --}}
    <!-- create user Modal -->
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
    <div x-data="{ open: @entangle('editModal') }" x-show="open"
        class="fixed inset-0 z-99999 flex items-center justify-center bg-black/50" x-transition>
        <div @click.away="open = false"
            class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transition dark:bg-gray-700" x-show="open"
            x-transition>
            <h2 class="text-lg font-semibold mb-4">Edit Category</h2>


            <form wire:submit.prevent="updateCategory">

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Category Name
                    </label>
                    <input wire:model="editCategoryName" type="text" placeholder="Enter full name"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('editCategoryName')
                        <span class="text-red-500 text-sm">{{ $message }}</span>

                    @enderror
                </div>

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Select Parent Category
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select wire:model="selectedCategory_parent_id"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                            @change="isOptionSelected = true">

                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                No Parent Category
                            </option>
                            @foreach ($categories as $category)


                                <option value="{{ $category->id }}" {{ $category->id == $selectedCategory_parent_id ? 'selected' : '' }}
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    {{ $category->name }}
                                </option>
                                @if ($category->children->count() > 0)
                                    @foreach ($category->children as $child)
                                        <option value="{{ $child->id }}" {{ $child->id == $selectedCategory_parent_id ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400 pl-4">
                                            &emsp;{{ $child->name }}
                                        </option>
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
                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Url
                    </label>
                    @if($category->slug)
                    {{-- @dd($category->slug); --}}
                    <input type="text"  value="{{ $edit_url }}" readonly
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @endif
                </div>



            </form>

            <!-- Modal footer -->
            <div class="mt-4 flex justify-end gap-2">
                <button @click="open = false"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">Cancel</button>
                <button wire:click="updateCategory"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
            </div>
        </div>
    </div>
    {{-- <div x-data="{ open: @entangle('viewModal') }" x-show="open"
        class="fixed inset-0 z-99999 flex items-center justify-center bg-black/50" x-transition>
        <div @click.away="open = false"
            class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg transition dark:bg-gray-700" x-show="open"
            x-transition>
            <h2 class="text-lg font-semibold mb-4">View User</h2>

            <form wire:submit.prevent="updateUser">

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Full Name
                    </label>
                    <input wire:model="name" type="text" readonly disabled
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>

                    @enderror
                </div>
                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Email Address
                    </label>
                    <input wire:model="email" type="email" readonly disabled
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-2">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Role
                    </label>
                    <input wire:model="selectedRole" type="text" readonly disabled
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('selectedRole')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


            </form>

            <!-- Modal footer -->
            <div class="mt-4 flex justify-end">
                <button wire:click="closeViewModal"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">Close</button>
            </div>
        </div>
    </div> --}}



</div>
@push('scripts')

    <script>

        Livewire.on('categoryUpdated', () => {
            $toaster.fire({
                icon: 'success',
                title: 'User updated successfully!'
            });
        });
        Livewire.on('categoryCreated', () => {

            $toaster.fire({
                icon: 'success',
                title: 'Category created successfully!'
            });
        });
        Livewire.on('categoryDeleted', () => {
            $toaster.fire({
                icon: 'success',
                title: 'Category deleted successfully!'
            });
        });
        Livewire.on('categoryNotFound', () => {
            $toaster.fire({
                icon: 'error',
                title: 'Category not found!'
            });
        });

    </script>

@endpush
