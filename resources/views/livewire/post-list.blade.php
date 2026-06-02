<div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <div class="flex items-center justify-between">
                <div >
                    @can('post.create')
                    <!-- Modal -->
                    <a href="{{ route('admin.post.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                        Create New Post
                    </a>
                    @endcan

                    <!-- End Modal -->
                </div>
                <div x-data="{ text: '' }" class="relative">
                    <input   x-model="text"  type="text" wire:model.live="search" placeholder="Search by title"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    <button type="button" x-show="text.length > 0" @click="text = ''"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        ✖
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- ====== Table Six Start -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            ID
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            title
                                        </p>
                                    </div>
                                </th>


                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            Category
                                        </p>
                                    </div>
                                </th>
                                {{-- <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">

                                            Featured
                                        </p>
                                    </div>
                                </th> --}}
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            Visits
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            Created At
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            Status
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                            Action
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->
                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @if ($posts->isEmpty())
                                <tr>
                                    <td colspan="7" class="px-5 py-4 sm:px-6 text-center">
                                        <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                            No posts found.
                                        </p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post->id }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">

                                                    </p>
                                                    <div class="h-20 min-w-20 overflow-hidden rounded-lg">

                                                        <img style="height:100%; width: auto;" src="{{ $post->featured_image }}"
                                                            alt="brand" />
                                                    </div> -

                                                    <div>
                                                        <span
                                                            class="text-theme-sm block font-medium text-gray-800 dark:text-white/90">
                                                            {{ $post->title }}
                                                        </span>
                                                        <span
                                                            class="text-theme-xs block text-gray-500 dark:text-gray-400">

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post?->category?->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </td>
                                        {{-- <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post->is_featured ? 'Yes' : 'No' }}
                                                </p>
                                            </div>
                                        </td> --}}

                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post->views }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    {{ $post->created_at }}
                                                </p>
                                            </div>
                                        </td>

                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="text-theme-sm text-gray-500 dark:text-gray-400">
                                                    @if ($post->status === 'published')
                                                        <span
                                                            class="inline-flex rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                            Published
                                                        </span>
                                                    @elseif ($post->status === 'draft')
                                                        <span
                                                            class="inline-flex rounded-full bg-orange-400/10 px-2 py-0.5 text-theme-xs font-medium text-orange-400">
                                                            Draft
                                                        </span>
                                                    @endif

                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div x-data="{ open: false, photocardOpen: false }" class="relative">
                                                <button @click="open = !open" @click.away="open = false"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>
                                                <div x-show="open" x-transition
                                                    class="absolute right-0 mt-2 w-48 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700 z-50">
                                                    <div class="py-1">
                                                        @if ($post->status === 'published')
                                                            <a target="_blank"  href="{{route('post.show',['category'=>$post->category->name,'slug'=>$post->slug])}}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                                Show
                                                            </a>
                                                        @endif

                                                        @can('post.edit')
                                                            <a href="{{ route('admin.post.edit', $post->id) }}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                                Edit
                                                            </a>
                                                        @endcan

                                                        <button type="button" @click="open = false; photocardOpen = true"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                            Photocard
                                                        </button>

                                                        <button @click="navigator.clipboard.writeText('{{ url(route('post.show',['category'=>$post->category->name,'slug'=>$post->slug])) }}'); open = false; $toaster.fire({icon: 'success', title: 'URL copied to clipboard'})"
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                                                            Copy URL
                                                        </button>

                                                        @can('post.delete')
                                                            <button @click="open = false" wire:click="deletePost({{ $post->id }})"
                                                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 dark:text-red-400 dark:hover:bg-white/[0.05]">
                                                                Delete
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </div>

                                                <!-- Template Picker Modal -->
                                                <template x-if="photocardOpen">
                                                    <div @click="photocardOpen = false" class="fixed inset-0 z-40 bg-black/50"></div>
                                                </template>

                                                <template x-if="photocardOpen">
                                                    <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
                                                        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-md w-full">
                                                            <div class="p-6">
                                                                <div class="flex items-center justify-between mb-4">
                                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Select Template</h3>
                                                                    <button type="button" @click="photocardOpen = false"
                                                                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <div class="space-y-2 mb-6">
                                                                    @forelse ($activeTemplates as $template)
                                                                        <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                                                                            <div>
                                                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $template->name }}</p>
                                                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $template->slug }}</p>
                                                                            </div>
                                                                            <button type="button" @click="photocardOpen = false" wire:click="generatePhotoCard({{ $post->id }}, '{{ $template->slug }}')"
                                                                                class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                                                                Generate
                                                                            </button>
                                                                        </div>
                                                                    @empty
                                                                        <p class="text-sm text-gray-600 dark:text-gray-400">No active templates available</p>
                                                                    @endforelse
                                                                </div>

                                                                <button type="button" @click="photocardOpen = false"
                                                                    class="w-full inline-flex items-center justify-center rounded-lg bg-gray-200 px-4 py-3 text-sm font-medium text-gray-800 hover:bg-gray-300 transition dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                                                                    Cancel
                                                                </button>
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
                        {{ $posts->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
            <!-- ====== Table Six End -->
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('deletePost', (data) => {
            console.log(data[0].error)
            console.log(data[0].success)
            if (typeof data.error !== "undefined" || typeof data.error !== null) {
                $toaster.fire({
                    icon: 'error',
                    title: 'Post not found'
                });
            }
            if (typeof data.success !== "undefined" || typeof data.success !== null) {
                $toaster.fire({
                    icon: 'success',
                    title: 'Post deleted successfully'
                });
            }

        });

        Livewire.on('download-photocard', function(data) {
            console.log('Download event received:', data);
            const filename = data.filename || data[0]?.filename;
            if (filename) {
                const url = '{{ route("admin.photocard.download") }}?file=' + encodeURIComponent(filename);
                console.log('Downloading from:', url);
                window.location = url;
            } else {
                console.error('No filename in event data:', data);
            }
        });

        Livewire.on('photocardGenerated', (data) => {
            if (data.success) {
                $toaster.fire({
                    icon: 'success',
                    title: 'Photocard generated successfully'
                });
            }
        });

        Livewire.on('photocardGenerationFailed', (data) => {
            $toaster.fire({
                icon: 'error',
                title: 'Photocard generation failed: ' + (data.error || 'Unknown error')
            });
        });
    </script>
@endpush
