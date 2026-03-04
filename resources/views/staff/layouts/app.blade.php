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
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
            <div class="flex flex-col h-full">
                <!-- Logo/Brand -->
                <div class="p-6 border-b border-gray-200">
                    <h1 class="text-xl font-bold text-gray-900">Staff Portal</h1>
                    <p class="text-sm text-gray-500">Lolari Dormitory</p>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="{{ route('staff.dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 @if(request()->routeIs('staff.dashboard')) bg-blue-50 text-blue-600 @endif">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        <span>Front Desk</span>
                    </a>

                    <a href="{{ route('staff.boarders.index') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 @if(request()->routeIs('staff.boarders.*')) bg-blue-50 text-blue-600 @endif">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                        <span>Boarders</span>
                    </a>

                    <a href="{{ route('staff.payments.index') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 @if(request()->routeIs('staff.payments.*')) bg-blue-50 text-blue-600 @endif">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        <span>Payments</span>
                    </a>

                    <a href="{{ route('staff.rooms.index') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 @if(request()->routeIs('staff.rooms.*')) bg-blue-50 text-blue-600 @endif">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5zm0 3v-1h-5v1h5z"></path></svg>
                        <span>Rooms</span>
                    </a>

                    <a href="{{ route('staff.payments.index') }}" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                        <span>Reports</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Staff</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" title="Logout" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 100-2H4V5a1 1 0 00-1-1zm15.707 9.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L16.586 13H9a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 011.414-1.414l4 4z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="max-w-7xl mx-auto">
                <!-- Top Bar -->
                <div class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-900">@yield('title')</h2>
                </div>

                <!-- Flash Messages -->
                @if ($errors->any())
                    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm font-medium text-red-800">Errors occurred:</p>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-800">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="p-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
