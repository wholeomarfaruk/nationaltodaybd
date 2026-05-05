@extends('layouts.admin')
@section('content')
    <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Role Edit` }" class="mb-3">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <a href="{{ route('admin.roles') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                    Back
                </a>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="index.html">
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

        <div
            class="min-h-screen rounded-2xl border border-gray-200 bg-white px-5 py-7 xl:px-10 xl:py-12 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5">
                <div class="flex items-center justify-start">
                    <div>

                        <!-- Modal -->
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Role Edit</h2>



                        <!-- End Modal -->
                    </div>

                </div>
            </div>
            <div>

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">

                        <input hidden type="text" name="role_id" id="role_id" value="{{ $role->id }}" required>
                    </div>
                    <div class="mt-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Role Name
                        </label>
                        <input name="name" type="name" value="{{ $role->name }}" required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4 mt-2">
                        <label>Permissions</label>
                        <br>
                        <label class="inline-flex items-center">
                            <input type="checkbox" x-data
                                x-on:change="
                                document.querySelectorAll('input[type=\'checkbox\'][name=\'permissions[]\']').forEach(cb => cb.checked = $event.target.checked)
                            "
                                class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Select All</span>
                        </label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out dark:text-gray-400"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-400">{{ $permission->name }}</span>
                            </label>
                        </div>
                    @endforeach
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Role
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
