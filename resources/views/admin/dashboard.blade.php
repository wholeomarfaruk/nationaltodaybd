@extends('layouts.admin')
@section('content')
<div class="p-4 mx-auto max-w-7xl md:p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Welcome to your admin dashboard</p>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Views Card -->
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Views</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalVisit ?? 0 }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Lifetime views</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-500/20">
                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Posts Card -->
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalPost ?? 0 }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Published & drafts</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 dark:bg-purple-500/20">
                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Categories</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCategories ?? 0 }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Active categories</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 dark:bg-green-500/20">
                    <svg class="w-7 h-7 text-green-600 dark:text-green-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 19H2V5H22V19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 8H22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 3V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 3V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Ads Card -->
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03] hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Ads</p>
                    <p class="mt-3 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalActiveAds ?? 0 }}</p>
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Currently running</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-100 dark:bg-orange-500/20">
                    <svg class="w-7 h-7 text-orange-600 dark:text-orange-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 5V14H5V5H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5 17H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts Section -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-hidden">
        <!-- Header -->
        <div class="border-b border-gray-200 dark:border-gray-800 px-6 py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Posts</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Latest articles published</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.post.list') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-700 transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.5 1.5H3.75C2.91 1.5 2.25 2.16 2.25 3V16.5C2.25 17.34 2.91 18 3.75 18H16.25C17.09 18 17.75 17.34 17.75 16.5V8.5L10.5 1.5Z"/>
                        </svg>
                        View All
                    </a>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse ($latestPosts as $post)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-lg">
                                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="h-full w-full object-cover"/>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $post->title }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at?->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $post->category?->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->views ?? 0 }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-600 dark:bg-green-400"></span>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-400">
                                        <span class="inline-block h-2 w-2 rounded-full bg-yellow-600 dark:bg-yellow-400"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="text-gray-500 dark:text-gray-400">No posts yet</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @supports (font-variant-numeric: tabular-nums) {
        table {
            font-variant-numeric: tabular-nums;
        }
    }
</style>
@endsection
