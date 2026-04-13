@extends('layouts.admin')

@section('content')
<div class="pt-2 space-y-4">

    {{-- Row 1: KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Occupancy Rate --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Occupancy Rate</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-1">{{ $occupancyRate }}%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $occupiedRooms }} / {{ $totalRooms }} rooms occupied</p>
                </div>
                <div class="w-11 h-11 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline stroke-linecap="round" stroke-linejoin="round" points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-4">
                <div class="bg-blue-600 dark:bg-blue-500 h-1.5 rounded-full" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </div>

        {{-- Pending Payments --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pending Payments</p>
                    <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-1">{{ $pendingPayments }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Awaiting completion</p>
                </div>
                <div class="w-11 h-11 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="2" y="5" width="20" height="14" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="2" y1="10" x2="22" y2="10" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 hover:underline dark:text-amber-500">
                    View pending
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6"/></svg>
                </a>
            </div>
        </div>

        {{-- Available Rooms --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Available Rooms</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">{{ $availableRooms }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ready for assignment</p>
                </div>
                <div class="w-11 h-11 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.assignments.index') }}" class="inline-flex items-center gap-1 text-xs font-medium text-green-600 hover:underline dark:text-green-500">
                    Assign room
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 18l6-6-6-6"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Row 2: Revenue Chart + Quick Actions & Stats --}}
    <div class="grid grid-cols-1 xl:grid-cols-1 gap-4">

        {{-- Revenue Chart --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Revenue</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">₱{{ number_format($totalRevenue ?? 0, 2) }}</span>
                        <span class="text-xs font-medium px-2 py-0.5 rounded-md bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">+12.5%</span>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">vs. last month</p>
                </div>
                <select id="revRange" class="text-xs px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="6">Last 6 months</option>
                    <option value="12">Last 12 months</option>
                    <option value="3">Last 3 months</option>
                </select>
            </div>

            {{-- Chart Legend --}}
            <div class="flex items-center gap-4 mb-3">
                <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                    <span class="w-2.5 h-2.5 rounded-sm bg-blue-500 inline-block"></span>Revenue
                </span>
                <span class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                    <span class="w-2.5 h-2.5 rounded-sm bg-amber-400 inline-block"></span>Target
                </span>
            </div>

            <div class="relative w-full" style="height: 220px;">
                <canvas id="revenueChart" role="img" aria-label="Monthly revenue bar chart with target line overlay">Monthly revenue trend data.</canvas>
            </div>
        </div>

        {{-- Quick Actions + Stats --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">

            {{-- Quick Actions --}}
            <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Quick Actions</h3>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('admin.boarders.create') }}" class="inline-flex items-center gap-3 px-4 py-2.5 rounded-lg border text-sm font-medium transition-colors bg-blue-50 border-blue-200 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-400 dark:hover:bg-blue-900/40">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        New Boarder
                    </a>
                    <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center gap-3 px-4 py-2.5 rounded-lg border text-sm font-medium transition-colors bg-green-50 border-green-200 text-green-700 hover:bg-green-100 dark:bg-green-900/20 dark:border-green-800 dark:text-green-400 dark:hover:bg-green-900/40">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Log Payment
                    </a>
                    <a href="{{ route('admin.assignments.index') }}" class="inline-flex items-center gap-3 px-4 py-2.5 rounded-lg border text-sm font-medium transition-colors bg-purple-50 border-purple-200 text-purple-700 hover:bg-purple-100 dark:bg-purple-900/20 dark:border-purple-800 dark:text-purple-400 dark:hover:bg-purple-900/40">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                        Assign Room
                    </a>
                </div>
            </div>

            {{-- Stats This Month --}}
            <div class="flex-1 p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Statistics this month</h3>

                {{-- Tabs --}}
                <div class="flex border-b border-gray-200 dark:border-gray-700 mb-3" id="statsTabBar">
                    <button data-tab="boarders" class="stats-tab px-4 py-2 text-xs font-medium border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 -mb-px" type="button">Boarders</button>
                    <button data-tab="rooms" class="stats-tab px-4 py-2 text-xs font-medium border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 -mb-px" type="button">Rooms</button>
                </div>

                {{-- Boarders Tab --}}
                <div id="stats-boarders" class="stats-panel space-y-1">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total boarders</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $totalBoarders ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Active payments</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $completedPayments ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Pending payments</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $pendingPayments ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">New this month</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $newBoardersThisMonth ?? 0 }}</span>
                    </div>
                </div>

                {{-- Rooms Tab --}}
                <div id="stats-rooms" class="stats-panel hidden space-y-1">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total rooms</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $totalRooms ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Occupied</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $occupiedRooms ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Available</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $availableRooms ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Occupancy rate</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $occupancyRate ?? 0 }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Movements + Transactions --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">

        {{-- Recent Boarder Movements --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Recent Movements</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Latest check-ins and check-outs</p>
                </div>
                <select class="text-xs px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>Today</option>
                </select>
            </div>

            {{-- Tabs --}}
            <div class="flex border-b border-gray-200 dark:border-gray-700 mb-3" id="movTabBar">
                <button data-movtab="checkin" class="mov-tab px-4 py-2 text-xs font-medium border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 -mb-px flex items-center gap-1.5" type="button">
                    <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    Check-in
                </button>
                <button data-movtab="checkout" class="mov-tab px-4 py-2 text-xs font-medium border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 -mb-px flex items-center gap-1.5" type="button">
                    <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Check-out
                </button>
            </div>

            {{-- Check-in Panel --}}
            <div id="mov-checkin" class="mov-panel divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentCheckIns ?? [] as $movement)
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $movement->boarder_name ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room {{ $movement->room_number ?? 'N/A' }}</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $movement->time_ago ?? '' }}</span>
                </div>
                @empty
                {{-- Placeholder data if no dynamic data yet --}}
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">John Doe</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room 101</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">2 hrs ago</span>
                </div>
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Michael Johnson</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room 102</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">6 hrs ago</span>
                </div>
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Robert Brown</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room 103</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">1 day ago</span>
                </div>
                @endforelse
            </div>

            {{-- Check-out Panel --}}
            <div id="mov-checkout" class="mov-panel hidden divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($recentCheckOuts ?? [] as $movement)
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $movement->boarder_name ?? 'N/A' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room {{ $movement->room_number ?? 'N/A' }}</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $movement->time_ago ?? '' }}</span>
                </div>
                @empty
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Jane Smith</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room 104</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">4 hrs ago</span>
                </div>
                <div class="flex items-center gap-3 py-2.5">
                    <div class="w-9 h-9 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Sarah Wilson</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Room 105</p>
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">8 hrs ago</span>
                </div>
                @endforelse
            </div>

            <div class="pt-3 mt-3 border-t border-gray-100 dark:border-gray-700">
                <a href="#" class="text-xs font-medium text-blue-600 hover:underline dark:text-blue-400">View all movements →</a>
            </div>
        </div>

        {{-- Recent Transactions --}}
        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Latest payment activity</p>
                </div>
                <div class="flex items-center gap-2">
                    <select class="text-xs px-2.5 py-1.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Today</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th class="pb-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Boarder</th>
                            <th class="pb-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Room</th>
                            <th class="pb-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Amount</th>
                            <th class="pb-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                            <th class="pb-2 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition-colors">
                            <td class="py-2.5 pr-3 text-sm font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $transaction->boarder->full_name ?? ($transaction->boarder_id ?? 'N/A') }}
                            </td>
                            <td class="py-2.5 pr-3 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $transaction->room->number ?? 'N/A' }}
                            </td>
                            <td class="py-2.5 pr-3 text-sm font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                ₱{{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="py-2.5 pr-3 whitespace-nowrap">
                                @if($transaction->display_status === 'Completed')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Completed</span>
                                @elseif($transaction->display_status === 'Overdue')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Overdue</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">Pending</span>
                                @endif
                            </td>
                            <td class="py-2.5 text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $transaction->transaction_date }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-5 h-5 mx-auto mb-1 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                No transactions yet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-3 mt-3 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <a href="#" class="text-xs font-medium text-blue-600 hover:underline dark:text-blue-400">View all transactions →</a>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ─── Revenue Chart ─────────────────────────────────────────────────────────
    const datasets = {
        6:  { labels: ['Oct','Nov','Dec','Jan','Feb','Mar'],         rev: [198000,215000,243000,229000,261000,{{ $totalRevenue ?? 284500 }}], target: [210000,210000,240000,240000,260000,280000] },
        12: { labels: ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar'], rev: [165000,172000,181000,193000,178000,190000,198000,215000,243000,229000,261000,{{ $totalRevenue ?? 284500 }}], target: [175000,180000,185000,195000,185000,195000,210000,210000,240000,240000,260000,280000] },
        3:  { labels: ['Jan','Feb','Mar'],                           rev: [229000,261000,{{ $totalRevenue ?? 284500 }}], target: [240000,260000,280000] }
    };

    const isDark   = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const gridCol  = isDark ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.06)';
    const tickCol  = isDark ? '#9ca3af' : '#6b7280';

    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datasets[6].labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: datasets[6].rev,
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    borderSkipped: false,
                    order: 2
                },
                {
                    label: 'Target',
                    data: datasets[6].target,
                    type: 'line',
                    borderColor: '#f59e0b',
                    backgroundColor: 'transparent',
                    borderWidth: 1.5,
                    pointRadius: 3,
                    pointBackgroundColor: '#f59e0b',
                    tension: 0.3,
                    order: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function (ctx) {
                            return ' ₱' + (ctx.raw / 1000).toFixed(0) + 'k';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: tickCol, font: { size: 11 } }
                },
                y: {
                    grid: { color: gridCol },
                    border: { display: false },
                    ticks: {
                        color: tickCol,
                        font: { size: 11 },
                        callback: function (v) { return '₱' + (v / 1000).toFixed(0) + 'k'; }
                    }
                }
            }
        }
    });

    document.getElementById('revRange').addEventListener('change', function () {
        const d = datasets[this.value];
        chart.data.labels           = d.labels;
        chart.data.datasets[0].data = d.rev;
        chart.data.datasets[1].data = d.target;
        chart.update();
    });

    // ─── Stats Tabs ────────────────────────────────────────────────────────────
    document.querySelectorAll('.stats-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const target = this.dataset.tab;
            document.querySelectorAll('.stats-tab').forEach(function (t) {
                t.classList.remove('border-blue-600', 'text-blue-600', 'dark:text-blue-400', 'dark:border-blue-400');
                t.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            });
            this.classList.add('border-blue-600', 'text-blue-600', 'dark:text-blue-400', 'dark:border-blue-400');
            this.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');

            document.querySelectorAll('.stats-panel').forEach(function (p) { p.classList.add('hidden'); });
            document.getElementById('stats-' + target).classList.remove('hidden');
        });
    });

    // ─── Movements Tabs ────────────────────────────────────────────────────────
    document.querySelectorAll('.mov-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const target = this.dataset.movtab;
            document.querySelectorAll('.mov-tab').forEach(function (t) {
                t.classList.remove('border-blue-600', 'text-blue-600', 'dark:text-blue-400', 'dark:border-blue-400');
                t.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            });
            this.classList.add('border-blue-600', 'text-blue-600', 'dark:text-blue-400', 'dark:border-blue-400');
            this.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');

            document.querySelectorAll('.mov-panel').forEach(function (p) { p.classList.add('hidden'); });
            document.getElementById('mov-' + target).classList.remove('hidden');
        });
    });

});
</script>
@endsection