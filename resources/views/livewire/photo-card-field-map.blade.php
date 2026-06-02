<div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Field Mappings</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Configure how template fields map to post data</p>
        </div>

        <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <div class="space-y-6">
                @foreach ($maps as $fieldKey => $mapData)
                    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-800">
                        <div class="mb-4 flex items-center gap-3">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">{{ $fieldKey }}</h3>
                            @if (in_array($fieldKey, $requiredFields))
                                <span class="inline-flex rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-700 dark:bg-red-500/15 dark:text-red-400">
                                    Required
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                    Optional
                                </span>
                            @endif
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <!-- Source Type Dropdown -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Source Type
                                </label>
                                <select wire:model="maps.{{ $fieldKey }}.source_type"
                                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                    <option value="post_field">Post Field</option>
                                    <option value="setting">Site Setting</option>
                                    <option value="static">Static Value</option>
                                </select>
                            </div>

                            <!-- Source Value - Dynamic based on type -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Value
                                </label>

                                @if ($maps[$fieldKey]['source_type'] === 'post_field')
                                    <select wire:model="maps.{{ $fieldKey }}.source_value"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">-- Select Field --</option>
                                        @foreach ($postFieldOptions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @elseif ($maps[$fieldKey]['source_type'] === 'setting')
                                    <select wire:model="maps.{{ $fieldKey }}.source_value"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                        <option value="">-- Select Setting --</option>
                                        @foreach ($settingOptions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" wire:model="maps.{{ $fieldKey }}.source_value"
                                        placeholder="Enter static value"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex gap-3">
                <button wire:click="save"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Field Mappings
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('fieldMapSaved', (data) => {
            if (data.success) {
                $toaster.fire({
                    icon: 'success',
                    title: 'Field mappings saved successfully'
                });
            }
        });
    </script>
@endpush
