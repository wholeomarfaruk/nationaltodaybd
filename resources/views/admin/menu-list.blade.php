@extends('layouts.admin')
@section('content')


<div>
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Menus List` }" class="mb-4">
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

                <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <!-- ====== Table Six Start -->
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">

                            <nav class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <ul class="space-y-2">




                                        <li>
                                            <a href="{{ route('admin.mainmenu.list') }}">
                                            <label for="menu"
                                                class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg flex items-center justify-between group">

                                                <div class="flex items-center justify-start space-x-2">
                                                    <div>Desktop Menu</div>
                                                </div>

                                            </label>
</a>

                                        </li>
                                        <li>
                                            <a href="{{ route('admin.menu.list') }}">
                                            <label for="menu"
                                                class="w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg flex items-center justify-between group">

                                                <div class="flex items-center justify-start space-x-2">
                                                    <div>Sidebar Menu</div>
                                                </div>

                                            </label>
                                            </a>


                                        </li>

                                </ul>
                            </nav>

                        </div>
                    </div>
                    <!-- ====== Table Six End -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
