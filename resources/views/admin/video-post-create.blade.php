@extends('layouts.admin')
@section('content')
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Create Video Post` }">
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

        <div class="space-y-2 sm:space-y-2">

           @livewire('video-post-create')
        </div>
    </div>
@endsection
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
