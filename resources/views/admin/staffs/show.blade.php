@extends('layouts.admin')

@section('title', 'Staff Details')

@section('content')
<div class="p-6 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Staff Details</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $staff->user->first_name }} {{ $staff->user->last_name }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.staffs.edit', $staff) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">Edit</a>
            <a href="{{ route('admin.staffs.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-lg font-medium">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Personal Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $staff->user->first_name }} {{ $staff->user->last_name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                    <p class="text-gray-900 dark:text-white">{{ $staff->user->email }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Number</label>
                    <p class="text-gray-900 dark:text-white">{{ $staff->user->contact_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</label>
                    <p class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium dark:bg-indigo-900 dark:text-indigo-200">Staff</p>
                </div>
            </div>
        </div>

        <!-- Employment Information -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Employment Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Employment Date</label>
{{ \Carbon\Carbon::parse($staff->employment_date)->format('F d, Y') }}
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $staff->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        {{ ucfirst($staff->status) }}
                    </span>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">User ID</label>
                    <p class="text-gray-900 dark:text-white font-mono bg-gray-100 px-3 py-1 rounded text-sm">{{ $staff->user_id }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($staff->transactions->count() > 0)
    <!-- Recent Transactions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff->transactions->take(5) as $transaction)
                    <tr class="border-t border-gray-200 dark:border-gray-600">
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $transaction->description ?? 'Transaction' }}</td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-gray-900 dark:text-white">₱{{ number_format($transaction->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
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

