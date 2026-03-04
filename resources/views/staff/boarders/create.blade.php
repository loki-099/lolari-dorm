@extends('staff.layouts.app')

@section('title', 'New Boarder')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Register New Boarder</h3>
        
        <form action="{{ route('staff.boarders.store') }}" method="POST" class="space-y-5" id="boarderForm">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Juan Dela Cruz" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('name') border-red-500 @enderror" required>
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
                <input type="text" id="contact" name="contact" value="{{ old('contact') }}" placeholder="+63 9XX XXX XXXX" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('contact') border-red-500 @enderror">
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
                <input type="text" id="documents_path" name="documents_path" value="{{ old('documents_path') }}" placeholder="/documents/boarder_001" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('documents_path') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Optional: Path where boarder documents are stored</p>
                @error('documents_path')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('staff.boarders.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" id="submitBtn" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Boarder
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('boarderForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
    });
</script>
@endsection
