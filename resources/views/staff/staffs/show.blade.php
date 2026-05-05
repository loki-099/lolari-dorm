@extends('layouts.staff')

@section('title', 'Staff Details')

@section('content')
<div class="space-y-6">
    <!-- Staff Info Card -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $staff->user->first_name }} {{ $staff->user->last_name }}</h2>
                <div class="mt-2">
                    @if($staff->status === 'active')
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 dark:bg-green-900/30 dark:text-green-400 rounded-full border border-green-200 dark:border-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 dark:bg-red-900/30 dark:text-red-400 rounded-full border border-red-200 dark:border-red-800">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('staff.staffs.edit', $staff) }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('staff.staffs.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 rounded-lg dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Contact Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pt-6 border-t border-gray-200 dark:border-gray-600">
            <!-- Email -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Email</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $staff->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Number -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Contact</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $staff->user->contact_number ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Employment Date -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Employment Date</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ \Carbon\Carbon::parse($staff->employment_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- User ID -->
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-cyan-100 dark:bg-cyan-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">User ID</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1 font-mono">{{ $staff->user_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($staff->transactions->count() > 0)
    <!-- Recent Transactions -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3 text-right">Amount</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($staff->transactions->take(5) as $transaction)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $transaction->description ?? 'Transaction' }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-900 dark:text-white">₱{{ number_format($transaction->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($transaction->status === 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Completed
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-1.5"></span>
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-800">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    Failed
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

