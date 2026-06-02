<div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <div class="flex items-center justify-between">
                <div x-data="{ text: '' }" class="relative flex-1">
                    <input x-model="text" type="text" wire:model.live="search" placeholder="Search templates..."
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    <button type="button" x-show="text.length > 0" @click="text = ''"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        ✖
                    </button>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">
                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Name</p>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Slug</p>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Description</p>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Status</p>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Action</p>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @if ($templates->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-theme-sm text-gray-500 dark:text-gray-400">No templates found.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($templates as $template)
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">{{ $template->name }}</p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400">{{ $template->slug }}</p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <p class="text-theme-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $template->description }}</p>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            @if ($template->is_active)
                                                <span class="inline-flex rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full bg-gray-100 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div x-data="{ open: false, configOpen: false }" class="relative">
                                                <button type="button" @click="open = !open" @click.away="open = false"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>

                                                <div x-show="open" x-transition
                                                    class="absolute right-0 mt-2 w-48 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 z-50">
                                                    <div class="py-1">
                                                        <button type="button" @click="open = false; configOpen = true"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                            View Config
                                                        </button>
                                                        <a href="{{ route('admin.photocard.field-map', $template->id) }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                            Edit Fields
                                                        </a>
                                                        <button type="button" @click="open = false" wire:click="toggleActive({{ $template->id }})"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                            {{ $template->is_active ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Config Modal -->
                                                <template x-if="configOpen">
                                                    <div @click="configOpen = false" class="fixed inset-0 z-40 bg-black/50"></div>
                                                </template>

                                                <template x-if="configOpen">
                                                    <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
                                                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                                                            <div class="p-6">
                                                                <div class="flex items-center justify-between mb-4">
                                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Template Config</h3>
                                                                    <button type="button" @click="configOpen = false"
                                                                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 overflow-auto max-h-[60vh]">
                                                                    <pre class="text-theme-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap break-words">{{ json_encode($template->config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                                                </div>

                                                                <div class="mt-4">
                                                                    <button type="button" @click="configOpen = false"
                                                                        class="w-full inline-flex items-center justify-center rounded-lg bg-gray-200 px-4 py-3 text-sm font-medium text-gray-800 hover:bg-gray-300 transition dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $templates->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('templateToggled', (data) => {
            if (data.success) {
                $toaster.fire({
                    icon: 'success',
                    title: data.active ? 'Template activated' : 'Template deactivated'
                });
            }
        });

        Livewire.on('templateNotFound', (data) => {
            if (data.error) {
                $toaster.fire({
                    icon: 'error',
                    title: 'Template not found'
                });
            }
        });
    </script>
@endpush
