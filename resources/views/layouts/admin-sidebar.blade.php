<!-- ===== Sidebar Start ===== -->
<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-99 flex h-screen w-[290px] flex-col overflow-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0 transition-all duration-300">

    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-6 pb-6 border-b border-gray-200 dark:border-gray-800">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 w-full" :class="sidebarToggle ? '' : ''">
            <span class="logo w-full" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden w-full object-contain" src="{{ asset('tailadmin/images/logo/logo.png') }}" alt="Logo" />
                <img class="hidden dark:block h-12 w-full object-contain" src="{{ asset('tailadmin/images/logo/logo.png') }}" alt="Logo" />
            </span>
            <img class="logo-icon h-10 flex-shrink-0" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('tailadmin/images/logo/logo-icon.png') }}" alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER END -->

    <!-- SIDEBAR MENU -->
    <div class="flex flex-col flex-1 overflow-y-auto py-6 duration-300 ease-linear">
        <nav class="space-y-1">

            <!-- CORE SECTION -->
            <div>
                <h3 class="mb-4 px-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Core</span>
                </h3>
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.dashboard' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                            <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 13H11V3H3V13ZM3 21H11V15H3V21ZM13 21H21V11H13V21ZM13 3V9H21V3H13Z" fill="currentColor"/>
                            </svg>
                            <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- MANAGEMENT SECTION -->
            <div>
                <h3 class="mb-4 px-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Management</span>
                </h3>
                <ul class="space-y-2">
                    <!-- Users -->
                    @can('user.view')
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.users' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 11C17.66 11 18.99 9.66 18.99 8C18.99 6.34 17.66 5 16 5C14.34 5 13 6.34 13 8C13 9.66 14.34 11 16 11ZM8 11C9.66 11 10.99 9.66 10.99 8C10.99 6.34 9.66 5 8 5C6.34 5 5 6.34 5 8C5 9.66 6.34 11 8 11ZM8 13C6 13 2 14.01 2 16V20H14V16C14 14.01 10 13 8 13ZM16 13C15.71 13 15.38 13.02 15.03 13.05C16.19 14.89 17 17.07 17 20V20H22V16C22 14.01 18 13 16 13Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Users</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Authors -->
                    @can('role.view')
                        <li>
                            <a href="{{ route('admin.authors') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.authors' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 13.5H13V11.5H3V13.5ZM3 9.5H13V7.5H3V9.5ZM3 5.5H13V3.5H3V5.5ZM15.5 13C16.33 13 17 12.33 17 11.5C17 10.67 16.33 10 15.5 10C14.67 10 14 10.67 14 11.5C14 12.33 14.67 13 15.5 13ZM15.5 19C16.33 19 17 18.33 17 17.5C17 16.67 16.33 16 15.5 16C14.67 16 14 16.67 14 17.5C14 18.33 14.67 19 15.5 19ZM15.5 7C16.33 7 17 6.33 17 5.5C17 4.67 16.33 4 15.5 4C14.67 4 14 4.67 14 5.5C14 6.33 14.67 7 15.5 7Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Authors</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Roles -->
                    @can('role.view')
                        <li>
                            <a href="{{ route('admin.roles') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.roles' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM10 17H8V15H10V17ZM10 13H8V7H10V13ZM16 17H14V15H16V17ZM16 13H14V7H16V13Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Roles</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>

            <!-- CONTENT SECTION -->
            <div>
                <h3 class="mb-4 px-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Content</span>
                </h3>
                <ul class="space-y-2">
                    <!-- Category -->
                    @can('category.view')
                        <li>
                            <a href="{{ route('admin.category.list') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.category.list' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 4H4C2.9 4 2 4.9 2 6V20C2 21.1 2.9 22 4 22H20C21.1 22 22 21.1 22 20V10H12V4ZM13 13H8V11H13V13Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Category</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Menus -->
                    @can('category.view')
                        <li>
                            <a href="{{ route('admin.allmenu.list') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.allmenu.list' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 18H21V16H3V18ZM3 13H21V11H3V13ZM3 6V8H21V6H3Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Menus</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Ads -->
                    @can('category.view')
                        <li>
                            <a href="{{ route('admin.ads') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.ads' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5 13C20.33 13 21 12.33 21 11.5V7C21 5.9 20.1 5 19 5H5C3.9 5 3 5.9 3 7V13C3 14.1 3.9 15 5 15H17.5C18.33 15 19 14.33 19 13.5V13ZM7 11H5V7H7V11ZM13 11H11V7H13V11ZM19 11H17V7H19V11ZM2 20H20V18H2V20Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Ads</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Posts -->
                    @can('post.view')
                        <li>
                            <a href="{{ route('admin.post.list') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.post.list' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM16 18H8V16H16V18ZM16 14H8V12H16V14ZM13 9H8V7H13V9Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Posts</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Video Posts -->
                    @can('post.view')
                        <li>
                            <a href="{{ route('admin.video.post.list') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.video.post.list' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 3H6C4.9 3 4 3.9 4 5V19C4 20.1 4.9 21 6 21H18C19.1 21 20 20.1 20 19V5C20 3.9 19.1 3 18 3ZM9 16V8L15.5 12L9 16Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Video Posts</span>
                            </a>
                        </li>
                    @endcan

                    <!-- Photocard Templates -->
                    <li>
                        <a href="{{ route('admin.photocard.templates') }}"
                            class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{Route::currentRouteName() === 'admin.photocard.templates' ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                            <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L21 19H3L8.5 13.5Z" fill="currentColor"/>
                            </svg>
                            <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Photocard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SETTINGS SECTION -->
            @can('settings.view')
                <div>
                    <h3 class="mb-4 px-2 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">Settings</span>
                    </h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.settings') }}"
                                class="menu-item group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{request()->is('admin/settings') || request()->is('admin/settings/*') ? 'menu-item-active bg-brand-50 text-brand-600 dark:bg-brand-900/20 dark:text-brand-400' : 'menu-item-inactive text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/50'}}">
                                <svg class="flex-shrink-0 w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.14 12.94C19.18 12.64 19.2 12.33 19.2 12C19.2 11.67 19.18 11.36 19.14 11.06L21.16 9.48C21.34 9.34 21.39 9.07 21.28 8.87L19.36 5.55C19.27 5.4 19.1 5.35 18.95 5.45L16.56 6.96C16.04 6.5 15.48 6.13 14.87 5.86L14.5 3.21C14.46 3.02 14.3 2.87 14.11 2.87H10.89C10.7 2.87 10.54 3.02 10.51 3.21L10.13 5.86C9.52 6.13 8.96 6.5 8.44 6.96L6.05 5.45C5.9 5.35 5.73 5.4 5.64 5.55L3.72 8.87C3.61 9.07 3.66 9.34 3.84 9.48L5.86 11.06C5.82 11.36 5.8 11.67 5.8 12C5.8 12.33 5.82 12.64 5.86 12.94L3.84 14.52C3.66 14.66 3.61 14.93 3.72 15.13L5.64 18.45C5.73 18.6 5.9 18.65 6.05 18.55L8.44 17.04C8.96 17.5 9.52 17.87 10.13 18.14L10.51 20.79C10.54 20.98 10.7 21.13 10.89 21.13H14.11C14.3 21.13 14.46 20.98 14.49 20.79L14.87 18.14C15.48 17.87 16.04 17.5 16.56 17.04L18.95 18.55C19.1 18.65 19.27 18.6 19.36 18.45L21.28 15.13C21.39 14.93 21.34 14.66 21.16 14.52L19.14 12.94ZM12.5 15.5C11.12 15.5 10 14.38 10 13C10 11.62 11.12 10.5 12.5 10.5C13.88 10.5 15 11.62 15 13C15 14.38 13.88 15.5 12.5 15.5Z" fill="currentColor"/>
                                </svg>
                                <span class="menu-item-text flex-1" :class="sidebarToggle ? 'lg:hidden' : ''">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endcan
        </nav>
    </div>
    <!-- SIDEBAR MENU END -->
</aside>
<!-- ===== Sidebar End ===== -->
