@extends('staff.layouts.app')

@section('title', 'Edit Boarder')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Edit Boarder Information</h3>
        
        <form action="{{ route('staff.boarders.update', $boarder) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $boarder->name) }}" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Contact Field -->
            <div>
                <label for="contact" class="block text-sm font-medium text-gray-900 mb-2">Contact Number</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact', $boarder->contact) }}" placeholder="+63 9XX XXX XXXX" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('contact') border-red-500 @enderror">
                @error('contact')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Documents Path Field -->
            <div>
                <label for="documents_path" class="block text-sm font-medium text-gray-900 mb-2">Documents Path</label>
                <input type="text" id="documents_path" name="documents_path" value="{{ old('documents_path', $boarder->documents_path) }}" placeholder="/documents/boarder_001" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('documents_path') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Path where documents are stored</p>
                @error('documents_path')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status Field -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-900 mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('status') border-red-500 @enderror" required>
                    <option value="active" @selected(old('status', $boarder->status) === 'active')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Active
                        </span>
                    </option>
                    <option value="inactive" @selected(old('status', $boarder->status) === 'inactive')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-gray-500 rounded-full"></span>
                            Inactive
                        </span>
                    </option>
                    <option value="suspended" @selected(old('status', $boarder->status) === 'suspended')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            Suspended
                        </span>
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('staff.boarders.show', $boarder) }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Boarder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
