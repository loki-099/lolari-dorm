@extends('staff.layouts.app')

@section('title', 'Add New Room')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Add New Room</h3>
        
        <form action="{{ route('staff.rooms.store') }}" method="POST" class="space-y-5" id="roomForm">
            @csrf

            <!-- Room Number Field -->
            <div>
                <label for="number" class="block text-sm font-medium text-gray-900 mb-2">Room Number <span class="text-red-500">*</span></label>
                <input type="text" id="number" name="number" value="{{ old('number') }}" placeholder="101, 102, A-01" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('number') border-red-500 @enderror" required>
                <p class="text-gray-500 text-xs mt-1">Must be unique - e.g., 101, 102, or A-01</p>
                @error('number')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Room Type Field -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-900 mb-2">Room Type <span class="text-red-500">*</span></label>
                <select name="type" id="type" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('type') border-red-500 @enderror" required>
                    <option value="">-- Select Room Type --</option>
                    <option value="single" @selected(old('type') === 'single')>Single Room (1 person)</option>
                    <option value="double" @selected(old('type') === 'double')>Double Room (2 people)</option>
                    <option value="triple" @selected(old('type') === 'triple')>Triple Room (3 people)</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Monthly Price Field -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-900 mb-2">Monthly Rate (₱) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-600 text-sm font-semibold">₱</span>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00" class="w-full pl-7 pr-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('price') border-red-500 @enderror" required>
                </div>
                @error('price')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM10 9a1 1 0 100-2 1 1 0 000 2zm3 1a1 1 0 110-2 1 1 0 010 2z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status Field -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-900 mb-2">Initial Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" class="w-full px-4 py-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('status') border-red-500 @enderror" required>
                    <option value="">-- Select Status --</option>
                    <option value="available" @selected(old('status') === 'available')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            Available
                        </span>
                    </option>
                    <option value="occupied" @selected(old('status') === 'occupied')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            Occupied
                        </span>
                    </option>
                    <option value="maintenance" @selected(old('status') === 'maintenance')>
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            Maintenance
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
                <a href="{{ route('staff.rooms.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" id="submitBtn" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Room
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('roomForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
    });
</script>
@endsection
