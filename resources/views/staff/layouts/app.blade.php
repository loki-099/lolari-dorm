<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Staff Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.0.0/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <script>
        // Initialize dark mode from localStorage or system preference
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-white dark:bg-gray-900">
    <!-- Top Navigation Bar -->
    <nav class="fixed top-0 z-50 w-full bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <!-- Mobile Sidebar Toggle -->
                    <button data-drawer-target="sidebar-nav" data-drawer-toggle="sidebar-nav" aria-controls="sidebar-nav" type="button" class="sm:hidden inline-flex items-center justify-center p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                        </svg>
                    </button>

                    <!-- Logo -->
                    <a href="{{ route('staff.dashboard') }}" class="flex ms-2 md:me-24">
                        <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-900 dark:from-blue-600 dark:to-blue-900 rounded-lg shadow-md flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                            </svg>
                        </div>
                        <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">Staff Portal</span>
                    </a>
                </div>

                <!-- Right side items -->
                <div class="flex items-center gap-4">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="inline-flex items-center justify-center p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <!-- Sun Icon (shown in dark mode) -->
                        <svg id="theme-toggle-light-icon" class="w-6 h-6 hidden dark:block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M13 3a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0V3ZM6.343 4.929A1 1 0 0 0 4.93 6.343l1.414 1.414a1 1 0 0 0 1.414-1.414L6.343 4.929Zm12.728 1.414a1 1 0 0 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 1.414 1.414l1.414-1.414ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm-9 4a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2H3Zm16 0a1 1 0 1 0 0 2h2a1 1 0 1 0 0-2h-2ZM7.757 17.657a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414Zm9.9-1.414a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM13 19a1 1 0 1 0-2 0v2a1 1 0 1 0 2 0v-2Z" clip-rule="evenodd"/>
                        </svg>

                        <!-- Moon Icon (shown in light mode) -->
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>

                    <!-- User Menu -->
                    <div class="flex items-center gap-3">
                        <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-900 dark:from-blue-600 dark:to-indigo-900 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>

                        <!-- User Dropdown -->
                        <div class="z-50 hidden bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow w-48" id="dropdown-user">
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 truncate">Staff Account</p>
                            </div>
                            <ul class="p-3 text-sm text-gray-700 dark:text-gray-200 space-y-1">
                                <li>
                                    <a href="{{ route('staff.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">Dashboard</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded text-red-600 dark:text-red-400">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar Navigation -->
    <aside id="sidebar-nav" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('staff.dashboard') }}" 
                    class="flex items-center p-2 rounded-lg group transition-colors duration-200
                    {{ request()->routeIs('staff.dashboard') 
                        ? 'bg-blue-50 text-blue-600 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('staff.dashboard') ? 'text-blue-600 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('staff.boarders.index') }}" 
                    class="flex items-center p-2 rounded-lg group transition-colors duration-200
                    {{ request()->routeIs('staff.boarders.*') 
                        ? 'bg-blue-50 text-blue-600 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('staff.boarders.*') ? 'text-blue-600 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                        </svg>
                        <span class="ms-3">Boarders</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('staff.payments.index') }}" 
                    class="flex items-center p-2 rounded-lg group transition-colors duration-200
                    {{ request()->routeIs('staff.payments.*') 
                        ? 'bg-blue-50 text-blue-600 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('staff.payments.*') ? 'text-blue-600 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                        <span class="ms-3">Payments</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('staff.rooms.index') }}" 
                    class="flex items-center p-2 rounded-lg group transition-colors duration-200
                    {{ request()->routeIs('staff.rooms.*') 
                        ? 'bg-blue-50 text-blue-600 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('staff.rooms.*') ? 'text-blue-600 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                        </svg>
                        <span class="ms-3">Rooms</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('staff.reports.index') }}" 
                    class="flex items-center p-2 rounded-lg group transition-colors duration-200
                    {{ request()->routeIs('staff.reports.*') 
                        ? 'bg-blue-50 text-blue-600 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('staff.reports.*') ? 'text-blue-600 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                        <span class="ms-3">Reports</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="pt-20 sm:ml-64">
        <!-- Flash Messages -->
        <div class="sticky top-20 z-30">
            @if ($errors->any())
                <div class="mx-4 md:mx-6 mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-sm font-semibold text-red-900 dark:text-red-300">Validation Errors</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-800 dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mx-4 md:mx-6 mt-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-sm text-green-800 dark:text-green-300">
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-4 md:mx-6 mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-sm text-red-800 dark:text-red-300">
                        <p class="font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <div class="p-4 md:p-6">
            @yield('content')
        </div>
    </main>

    <!-- Flowbite Theme Toggle Script -->
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                if (htmlElement.classList.contains('dark')) {
                    htmlElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    htmlElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            });
        }
    </script>

    @yield('scripts')
</body>
</html>
