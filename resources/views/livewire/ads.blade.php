<div>
    <!-- Filters Section -->
    <div class="rounded-lg sm:rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-4 sm:p-6 mb-6 sm:mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <!-- Search -->
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5 sm:mb-2">Search</label>
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 w-4 sm:w-5 h-4 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" wire:model.live="search" placeholder="Search..."
                        class="w-full pl-9 sm:pl-10 pr-3 sm:pr-4 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-300 rounded-lg bg-white text-gray-900 placeholder:text-gray-500 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-400"/>
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5 sm:mb-2">Status</label>
                <select wire:model.live="status" class="w-full px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    <option value="">All Ads</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="expired">Expired</option>
                </select>
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5 sm:mb-2">From</label>
                <input wire:model.live="date_from" type="date"
                    class="w-full px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white"/>
            </div>

            <!-- Date To -->
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5 sm:mb-2">To</label>
                <input wire:model.live="date_to" type="date"
                    class="w-full px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent dark:border-gray-700 dark:bg-gray-900 dark:text-white"/>
            </div>
        </div>
    </div>

    <!-- Ads Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        @if ($ads->count() > 0)
            @foreach ($ads as $ad)
                <div class="group rounded-lg sm:rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Ad Card Content -->
                    <div class="flex flex-col sm:flex-row h-full">
                        <!-- Image Section -->
                        <div class="relative w-full sm:w-2/5 h-48 sm:h-64 overflow-hidden bg-gray-100 dark:bg-gray-900">
                            <img src="{{ $ad->image }}" alt="{{ $ad->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                @if ($ad->status == 1)
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-600 dark:bg-green-400"></span>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                        <span class="inline-block h-2 w-2 rounded-full bg-red-600 dark:bg-red-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1 p-3 sm:p-4 md:p-5 flex flex-col">
                            <!-- Header -->
                            <div class="flex-1">
                                <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">{{ $ad->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm line-clamp-2">{{ $ad->description }}</p>
                            </div>

                            <!-- Meta Information -->
                            <div class="space-y-1 sm:space-y-1.5 my-3 sm:my-4 text-xs sm:text-sm">
                                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                    <svg class="w-3 sm:w-4 h-3 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 01-2.828 2.828l-7-7A2 2 0 0012 3z"/>
                                    </svg>
                                    <span class="truncate">Ad ID: #{{ $ad->id }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                                    <svg class="w-3 sm:w-4 h-3 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="truncate">Updated: {{ \Carbon\Carbon::parse($ad->updated_at)->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-orange-600 dark:text-orange-400 font-medium">
                                    <svg class="w-3 sm:w-4 h-3 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="truncate">Expires: {{ \Carbon\Carbon::parse($ad->expire_at)->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-3 pt-2 sm:pt-3 border-t border-gray-200 dark:border-gray-800">
                                <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                    class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-brand-600 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-white hover:bg-brand-700 transition-colors">
                                    <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">No ads found</h3>
                <p class="mt-1 text-gray-600 dark:text-gray-400">No ads match your filters. Try adjusting your search.</p>
            </div>
        @endif
    </div>
</div>
