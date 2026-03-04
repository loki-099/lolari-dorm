<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Staff Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.0.0/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.0.0/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm flex flex-col">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Staff Portal</h1>
                        <p class="text-xs text-gray-500">Lolari Dorm</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('staff.dashboard')) bg-blue-50 text-blue-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('staff.boarders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('staff.boarders.*')) bg-blue-50 text-blue-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                    <span>Boarders</span>
                </a>

                <a href="{{ route('staff.payments.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('staff.payments.*')) bg-blue-50 text-blue-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                    <span>Payments</span>
                </a>

                <a href="{{ route('staff.rooms.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors @if(request()->routeIs('staff.rooms.*')) bg-blue-50 text-blue-600 @else text-gray-700 hover:bg-gray-100 @endif">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5zm0 3v-1h-5v1h5z"></path></svg>
                    <span>Rooms</span>
                </a>

                <div class="my-2 border-t border-gray-200"></div>

                <a href="{{ route('staff.payments.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                    <span>Reports</span>
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-gray-200 space-y-3">
                <div class="flex items-center gap-3 px-2">
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Staff Account</p>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 100-2H4V5a1 1 0 00-1-1zm15.707 9.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L16.586 13H9a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 011.414-1.414l4 4z" clip-rule="evenodd"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-auto flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-6 py-4">
                    <h2 class="text-2xl font-bold text-gray-900">@yield('title')</h2>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-auto">
                <div class="max-w-7xl mx-auto">
                    <!-- Flash Messages -->
                    @if ($errors->any())
                        <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-lg flex gap-3">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-red-800">Please fix the following errors:</p>
                                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mx-6 mt-6 p-4 bg-green-50 border border-green-200 rounded-lg flex gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-lg flex gap-3">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    @endif

                    <!-- Page Content -->
                    <div class="p-6">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
