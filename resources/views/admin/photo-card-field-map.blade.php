@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-7xl p-4 md:p-6">
        <!-- Breadcrumb -->
        <div x-data="{ pageName: 'Edit Field Map' }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
                <nav>
                    <ol class="flex items-center gap-1.5 text-sm">
                        <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Home</a></li>
                        <li class="text-gray-400">&rsaquo;</li>
                        <li><a href="{{ route('admin.photocard.templates') }}" class="text-blue-600 hover:underline">Photocard Templates</a></li>
                        <li class="text-gray-400">&rsaquo;</li>
                        <li class="text-gray-700 dark:text-gray-300">{{ $template->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="space-y-5 sm:space-y-6">
            @livewire('photo-card-field-map-editor', ['templateId' => $template->id])
        </div>
    </div>
@endsection
