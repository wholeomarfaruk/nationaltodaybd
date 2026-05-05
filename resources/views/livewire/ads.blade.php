<div>
    <div class="container mx-auto p-4 md:p-8">

        {{-- <div class="flex space-x-2 mb-6">
            <button class="bg-cyan-100 text-cyan-700 font-semibold py-2 px-5 rounded-full text-sm shadow-sm">
                All Ads
            </button>
            <button
                class="bg-transparent text-gray-600 font-semibold py-2 px-5 rounded-full text-sm hover:bg-gray-200 transition-colors">
                Active
            </button>
            <button
                class="bg-transparent text-gray-600 font-semibold py-2 px-5 rounded-full text-sm hover:bg-gray-200 transition-colors">
                Inactive
            </button>
            <button
                class="bg-transparent text-gray-600 font-semibold py-2 px-5 rounded-full text-sm hover:bg-gray-200 transition-colors">
                Expired
            </button>
        </div> --}}

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">

                <div class="lg:col-span-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" wire:model.live="search" id="search" placeholder="Search ads..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <div class="flex space-x-2">
                        <select wire:model.live="status" name="" id=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                </div>

                <div class="md:col-span-2 lg:col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <label for="date-from" class="block text-sm font-medium text-gray-700 mb-1">From</label>
                        <input wire:model.live="date_from" type="date" id="date-from"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label  for="date-to" class="block text-sm font-medium text-gray-700 mb-1">To</label>
                        <input wire:model.live="date_to" type="date" id="date-to"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
            @if ($ads->count() > 0)

                @foreach ($ads as $ad)
                    @if ($ad->status == 1)
                        <div class="relative rounded-lg shadow-xl overflow-hidden min-h-[280px]">
                            <img class="absolute top-0 right-0 h-full w-full md:w-3/5 object-cover"
                                src="{{ $ad->image }}"
                                alt="Workspace">

                            <div
                                class="relative h-full w-full md:w-3/5 p-8 flex flex-col justify-center bg-gradient-to-r from-blue-900 to-blue-800/80">
                                <div
                                    class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center border-2 border-white/20 mb-4">
                                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">{{ $ad->title }}</h3>
                                <p class="text-blue-100 mb-2">{{ $ad->description }}</p>
                                <p class=""><span class="text-xs text-gray-200 ">Ad ID #{{ $ad->id }}</span>
                                </p>
                                <p class="text-xs text-gray-200">
                                    Updated At {{ \Carbon\Carbon::parse($ad->updated_at)->format('d-m-Y') }}
                                </p>
                                <p class="mb-4"><span class="text-xs text-red-200 ">Expire At
                                        {{ \Carbon\Carbon::parse($ad->expire_at)->format('d-m-Y') }}</span></p>
                                <div class="flex items-center justify-start gap-3">
                                    <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                        class="w-auto self-start bg-white text-gray-900 font-bold px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                        Edit Ad
                                    </a>

                                </div>
                            </div>
                             <span class="absolute top-2 right-3 text-xs">
                                <span
                                    class="inline-flex items-center justify-center gap-1 rounded-full bg-success-50 px-2.5 py-0.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                    Active
                                </span>
                            </span>
                        </div>
                    @else
                        <div class="relative rounded-lg shadow-xl overflow-hidden min-h-[280px]">
                            <img class="absolute top-0 right-0 h-full w-full md:w-3/5 object-cover"
                                src="{{ $ad->image }}"
                                alt="Workspace">

                            <div
                                class="relative h-full w-full md:w-3/5 p-8 flex flex-col justify-center bg-gradient-to-r from-gray-800 to-gray-700/80">
                                <div
                                    class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center border-2 border-white/20 mb-4">
                                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                </div>
                                <h3 class="text-3xl font-bold text-white mb-2">{{ $ad->title }}</h3>
                                <p class="text-blue-100 mb-2">{{ $ad->description }}</p>
                                <p class=""><span class="text-xs text-gray-200 ">Ad ID #{{ $ad->id }}</span>
                                </p>
                                <p class="text-xs text-gray-200">
                                    Updated At {{ \Carbon\Carbon::parse($ad->updated_at)->format('d-m-Y') }}
                                </p>
                                <p class="mb-4"><span class="text-xs text-red-200 ">Expire At
                                        {{ \Carbon\Carbon::parse($ad->expire_at)->format('d-m-Y') }}</span></p>
                                <div class="flex items-center justify-start gap-3">
                                    <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                        class="w-auto self-start bg-white text-gray-900 font-bold px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                        Edit Ad
                                    </a>

                                </div>
                            </div>
                            <span class="absolute top-2 right-3 text-xs">
                                <span
                                    class="inline-flex items-center justify-center gap-1 rounded-full bg-error-50 px-2.5 py-0.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                    Inactive
                                </span>
                            </span>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-span-1">
                    <p class="text-gray-500 text-center">No ads found.</p>
                </div>
            @endif
            {{-- <div class="relative rounded-lg shadow-xl overflow-hidden min-h-[280px]">
                <img class="absolute top-0 right-0 h-full w-full md:w-3/5 object-cover"
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80"
                    alt="Collaboration">

                <div
                    class="relative h-full w-full md:w-3/5 p-8 flex flex-col justify-center bg-gradient-to-r from-gray-800 to-gray-700/80">
                    <div
                        class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center border-2 border-white/20 mb-4">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-2">Deals on Demand</h3>
                    <p class="text-gray-200 mb-6">The step by step process to craft 6-figure offers.</p>
                    <div class="flex items-center justify-center gap-3">
                        <a href="#"
                            class="w-auto self-start bg-white text-gray-900 font-bold px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                            Edit Ad
                        </a>
                        <a href="#"
                            class="group w-auto self-start bg-white text-gray-900 font-bold px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">

                            <svg class="cursor-pointer fill-gray-700 dark:fill-gray-400 group-hover:fill-error-500"
                                width="23" height="23" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">

                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
