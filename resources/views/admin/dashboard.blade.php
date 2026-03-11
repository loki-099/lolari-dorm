@extends('layouts.admin')

@section('content')
    <div class="px-4 pt-6 space-y-6">
       
        <!-- Stats Cards Grid -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Occupancy Rate Card -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Occupancy Rate</h5>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $occupancyRate }}%</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $occupiedRooms }}/{{ $totalRooms }} rooms occupied</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700 mt-4">
                    <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500" style="width: {{ $occupancyRate }}%"></div>
                </div>
            </div>

            <!-- Pending Payments Card -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Pending Payments</h5>
                        <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-2">{{ $pendingPayments }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Awaiting completion</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-amber-100 dark:bg-amber-900/30 rounded-full">
                        <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('staff.payments.create') }}" class="inline-flex items-center text-xs font-medium text-amber-600 hover:underline dark:text-amber-500">
                        View pending
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Available Rooms Card -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <h5 class="text-gray-600 dark:text-gray-400 text-sm font-semibold uppercase tracking-wider">Available Rooms</h5>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $availableRooms }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Ready for assignment</p>
                    </div>
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-full">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 7H7v6h6V7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('staff.rooms.assign-form') }}" class="inline-flex items-center text-xs font-medium text-green-600 hover:underline dark:text-green-500">
                        Assign room
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions and Revenue Widgets -->
        <div class="grid gap-4 mb-6 xl:grid-cols-2">
            <!-- Quick Actions -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- New Boarder Button -->
                    <a href="{{ route('admin.boarders.create') }}" class="inline-flex flex-col items-center justify-center gap-2 px-5 py-4 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 border border-transparent rounded-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        <span>New Boarder</span>
                    </a>

                    <!-- Log Payment Button -->
                    <a href="{{ route(name: 'admin.transactions.create') }}" class="inline-flex flex-col items-center justify-center gap-2 px-5 py-4 text-sm font-medium text-white bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-800 border border-transparent rounded-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Log Payment</span>
                    </a>

                    <!-- Assign Room Button -->
                    <a href="" class="inline-flex flex-col items-center justify-center gap-2 px-5 py-4 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 dark:bg-purple-700 dark:hover:bg-purple-800 border border-transparent rounded-lg transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Assign Room</span>
                    </a>
                </div>
            </div>

            <!-- Revenue Overview -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">₱{{ number_format($totalRevenue ?? 0, 2) }}</span>
                        <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Total Revenue</h3>
                    </div>
                    <div class="flex items-center justify-end flex-1 text-base font-medium text-green-500 dark:text-green-400">
                        +12.5%
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <!-- Placeholder for chart - can be integrated with ApexCharts or Chart.js -->
                <div class="flex items-center justify-center h-32 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Revenue chart visualization</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Tabs and Recent Transactions -->
        <div class="grid gap-4 mb-6 xl:grid-cols-2">
            <!-- Statistics This Month -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">

                    <button                    Statistics this month data-popover-target="popover-description" data-popover-placement="bottom-end" type="button">
                        <svg class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Show information</span>
                    </button>
                </h3>
                
                <!-- Tab Navigation -->
                <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 mb-4" id="dashboardStatsTab" data-tabs-toggle="#dashboardStatsContent" role="tablist">
                    <li class="w-full">
                        <button id="boarders-tab" data-tabs-target="#boarders" type="button" role="tab" aria-controls="boarders" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Boarders</button>
                    </li>
                    <li class="w-full">
                        <button id="rooms-tab" data-tabs-target="#rooms" type="button" role="tab" aria-controls="rooms" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Rooms</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div id="dashboardStatsContent">
                    <!-- Boarders Stats -->
                    <div class="hidden pt-4" id="boarders" role="tabpanel" aria-labelledby="boarders-tab">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Total Boarders</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Active residents</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $totalBoarders ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Active Payments</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">This month</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $completedPayments ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Pending Payments</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Awaiting confirmation</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $pendingPayments ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3a1 1 0 001 1h3v-3a3 3 0 013-3z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">New This Month</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">New registrations</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $newBoardersThisMonth ?? 0 }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Rooms Stats -->
                    <div class="hidden pt-4" id="rooms" role="tabpanel" aria-labelledby="rooms-tab">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10.5 1.5H5a1.5 1.5 0 00-1.5 1.5v3H1.5a1.5 1.5 0 00-1.5 1.5v10a1.5 1.5 0 001.5 1.5h17a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 0 00-1.5-1.5H13V3a1.5 1.5 0 00-1.5-1.5z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Total Rooms</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">In dormitory</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $totalRooms ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Occupied Rooms</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Currently in use</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $occupiedRooms ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Available Rooms</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Ready for assignment</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $availableRooms ?? 0 }}
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="font-medium text-gray-900 truncate dark:text-white">Occupancy Rate</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Current occupancy</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $occupancyRate ?? 0 }}%
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Recent Boarder Movements</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">Latest check-ins and check-outs</span>
                </div>
            </div>

            <!-- Tab Navigation -->
            <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 mb-4" id="movementsTab" data-tabs-toggle="#movementsContent" role="tablist">
                <li class="w-full">
                    <button id="checkin-tab" data-tabs-target="#checkin" type="button" role="tab" aria-controls="checkin" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            In
                        </span>
                    </button>
                </li>
                <li class="w-full">
                    <button id="checkout-tab" data-tabs-target="#checkout" type="button" role="tab" aria-controls="checkout" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                            Out
                        </span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div id="movementsContent">
                <!-- Check-in Movements -->
                <div class="hidden pt-4" id="checkin" role="tabpanel" aria-labelledby="checkin-tab">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">John Doe</p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">Room 101</p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">2 hours ago</div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">Michael Johnson</p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">Room 102</p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">6 hours ago</div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">Robert Brown</p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">Room 103</p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">1 day ago</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Check-out Movements -->
                <div class="hidden pt-4" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">Jane Smith</p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">Room 104</p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">4 hours ago</div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">Sarah Wilson</p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">Room 105</p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">8 hours ago</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 sm:pt-6">
                <div>
                    <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" type="button" data-dropdown-toggle="movements-dropdown">Last 7 days <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="movements-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">Last 7 days</p>
                        </div>
                        <ul class="py-1" role="none">
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Yesterday</a></li>
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Today</a></li>
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 7 days</a></li>
                            <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 30 days</a></li>
                        </ul>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">View All Movements<svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Recent Transactions</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of latest transactions</span>
                </div>
                <div class="items-center sm:flex">
                    <div class="flex items-center">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                            Filter by status
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="filterDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Category</h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                <li class="flex items-center">
                                    <input id="filter-completed" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked />
                                    <label for="filter-completed" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Completed</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="filter-pending" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked />
                                    <label for="filter-pending" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Pending</label>
                                </li>
                                <li class="flex items-center">
                                    <input id="filter-failed" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                    <label for="filter-failed" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Failed</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


                    <!-- Flowbite UI Table -->
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Room
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Boarder
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Amount
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Type
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Method
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Date
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Status
                                            </th>
                                            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                                Received By
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @forelse($recentTransactions as $transaction)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $transaction->room->number ?? 'N/A' }}
                                                </td>
                                                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $transaction->boarder_id ?? 'N/A' }}
                                                </td>
                                                <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                    ₱{{ number_format($transaction->amount, 2) }}
                                                </td>
                                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    <span class="capitalize">{{ $transaction->type_display ?? 'Rent' }}</span>
                                                </td>
                                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $transaction->method_display ?? 'N/A' }}
                                                </td>
                                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $transaction->transaction_date }}
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    @if($transaction->display_status === 'Completed')
                                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Completed</span>
                                                    @elseif($transaction->display_status === 'Overdue')
                                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">Overdue</span>
                                                    @else
                                                        <span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-amber-400 border border-amber-100 dark:border-amber-500">Pending</span>
                                                    @endif
                                                </td>
                                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $transaction->staff_name }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        No transactions yet
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 sm:pt-6">
                <div>
                    <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" type="button" data-dropdown-toggle="transactions-dropdown">Last 7 days <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="transactions-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                                Last 7 days
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Today</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 30 days</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                        View All Transactions
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
        </div>

        <!-- Recent Boarder Movements -->
        
    </div>
@endsection


