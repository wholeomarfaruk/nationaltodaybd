<div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5">
            <div class="flex items-center justify-between">
                <div >
                    @can('post.create')
                    <!-- Modal -->
                    <a href="{{ route('admin.video.post.create') }}"
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
                                                    <div class="h-10 w-50 overflow-hidden rounded-lg">

                                                        <img class="w-100" src="{{ $post->featured_image }}"
                                                            alt="brand" />
                                                    </div> -

                                                    <div>
                                                        <span
                                                            class="text-theme-sm block font-medium text-gray-800 dark:text-white/90">
                                                            {{ $post->title?? 'No title' }}
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
                                            <div class="flex items-center gap-2">

                                                @if ($post->status === 'published' && $post->category)
                                                    <a target="_blank"  href="{{route('post.show',['category'=>$post->category->name,'slug'=>$post->slug])}}"
                                                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                        Show
                                                    </a>
                                                @elseif ($post->status === 'draft')
                                                    {{-- <button wire:click="openViewModal({{ $post->id }})"
                                                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                        Preview
                                                    </button> --}}
                                                @endif


                                                @can('post.edit')
                                                    <a href="{{ route('admin.video.post.edit', $post->id) }}"
                                                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                        Edit
                                                    </a>
                                                @endcan
                                                @can('post.delete')
                                                    <button wire:click="deletePost({{ $post->id }})"
                                                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white">
                                                        Delete
                                                    </button>
                                                @endcan
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
    </script>
@endpush
