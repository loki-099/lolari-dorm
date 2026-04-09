@extends('layouts.admin')

@section('title', 'Add Room')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-2">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Add New Room</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create a room with capacity, rent, and status.</p>
        </div>

        <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Room Number <span class="text-red-500">*</span></label>
                    <input type="text" id="number" name="number" value="{{ old('number') }}" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('number') border-red-500 @enderror">
                    @error('number')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="capacity" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Capacity <span class="text-red-500">*</span></label>
                    <input type="number" id="capacity" name="capacity" min="1" value="{{ old('capacity', 1) }}" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('capacity') border-red-500 @enderror">
                    @error('capacity')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="monthly_rent" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Monthly Rent <span class="text-red-500">*</span></label>
                    <input type="number" id="monthly_rent" name="monthly_rent" step="0.01" min="0" value="{{ old('monthly_rent') }}" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('monthly_rent') border-red-500 @enderror">
                    @error('monthly_rent')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white @error('status') border-red-500 @enderror">
                        <option value="available" @selected(old('status', 'available') === 'available')>Available</option>
                        <option value="occupied" @selected(old('status') === 'occupied')>Occupied</option>
                        <option value="maintenance" @selected(old('status') === 'maintenance')>Maintenance</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-200 pt-4 dark:border-gray-700">
                <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Room</button>
            </div>
        </form>
    </div>
</div>
@endsection

