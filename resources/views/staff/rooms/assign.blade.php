@extends('staff.layouts.app')

@section('title', 'Assign Room')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('staff.rooms.assign') }}" method="POST" id="assignForm">
            @csrf

            <!-- Boarder Selection -->
            <div class="mb-4">
                <label for="boarder_id" class="block text-sm font-medium text-gray-700 mb-1">Select Boarder *</label>
                <select name="boarder_id" id="boarder_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('boarder_id') border-red-500 @enderror" required>
                    <option value="">-- Choose a Boarder --</option>
                    @if($boarder)
                        <option value="{{ $boarder->id }}" selected>{{ $boarder->name }}</option>
                    @else
                        @foreach(\App\Models\Boarder::where('status', 'active')->get() as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('boarder_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room Selection -->
            <div class="mb-4">
                <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Select Available Room *</label>
                <select name="room_id" id="room_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('room_id') border-red-500 @enderror" required>
                    <option value="">-- Choose a Room --</option>
                    @foreach($availableRooms as $room)
                        <option value="{{ $room->id }}">Room {{ $room->number }} ({{ ucfirst($room->type) }} - ₱{{ number_format($room->price, 2) }}/month)</option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Start Date (Occupy Date) -->
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Occupy Date *</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('start_date') border-red-500 @enderror" required>
                @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('end_date') border-red-500 @enderror" required>
                <p class="text-gray-500 text-xs mt-1">When the assignment will end</p>
                @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Due Day (Payment Due Date) -->
            <div class="mb-6">
                <label for="due_day" class="block text-sm font-medium text-gray-700 mb-1">Monthly Payment Due Day *</label>
                <input type="number" id="due_day" name="due_day" min="1" max="31" value="{{ old('due_day', 1) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('due_day') border-red-500 @enderror" required>
                <p class="text-gray-500 text-xs mt-1">Day of the month when rent is due (1-31)</p>
                @error('due_day')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('staff.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" id="submitBtn" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">
                    Assign Room
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Update min date for end_date when start_date changes
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    function updateEndDateMin() {
        if (startDateInput.value) {
            endDateInput.min = startDateInput.value;
        }
    }
    
    startDateInput.addEventListener('change', updateEndDateMin);
    updateEndDateMin(); // Set initial min value
    
    document.getElementById('assignForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
    });
</script>
@endsection
