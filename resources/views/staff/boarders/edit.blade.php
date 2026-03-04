@extends('staff.layouts.app')

@section('title', 'Edit Boarder')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('staff.boarders.update', $boarder) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $boarder->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Field -->
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact', $boarder->contact) }}" placeholder="+63..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('contact') border-red-500 @enderror">
                @error('contact')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Documents Path Field -->
            <div class="mb-4">
                <label for="documents_path" class="block text-sm font-medium text-gray-700 mb-1">Documents Path</label>
                <input type="text" id="documents_path" name="documents_path" value="{{ old('documents_path', $boarder->documents_path) }}" placeholder="/documents/boarder_001" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('documents_path') border-red-500 @enderror">
                @error('documents_path')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Field -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror" required>
                    <option value="active" @selected(old('status', $boarder->status) === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $boarder->status) === 'inactive')>Inactive</option>
                    <option value="suspended" @selected(old('status', $boarder->status) === 'suspended')>Suspended</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('staff.boarders.show', $boarder) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Update Boarder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
