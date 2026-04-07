@extends('layouts.admin')

@section('content')
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 mt-2">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Assign Boarder to Room</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create a room assignment for an active boarder.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.assignments.store') }}" method="POST" class="space-y-6" id="assignForm">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="boarder_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Select Boarder <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="boarder_id"
                        name="boarder_id"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('boarder_id') border-red-500 @enderror"
                    >
                        <option value="">-- Choose a Boarder --</option>
                        @foreach ($boarders as $boarder)
                            <option value="{{ $boarder->id }}" @selected(old('boarder_id') == $boarder->id)>
                                {{ $boarder->user?->first_name }} {{ $boarder->user?->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('boarder_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="room_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Select Available Room <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="room_id"
                        name="room_id"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('room_id') border-red-500 @enderror"
                    >
                        <option value="">-- Choose a Room --</option>
                        @foreach ($availableRooms as $room)
                            <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                                Room {{ $room->number }}
                                @if($room->type || $room->monthly_rent)
                                    (
                                    @if($room->type)
                                        {{ ucfirst($room->type) }}
                                    @endif
                                    @if($room->monthly_rent)
                                        @if($room->type)
                                            -
                                        @endif
                                        ₱{{ number_format($room->monthly_rent, 2) }}/month
                                    @endif
                                    )
                                @endif
                                @if(isset($room->active_assignments_count))
                                    - {{ $room->active_assignments_count }}/{{ $room->capacity }} occupied
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="start_date" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        Occupy Date <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date', now()->format('Y-m-d')) }}"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('start_date') border-red-500 @enderror"
                    >
                    @error('start_date')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        End Date <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('end_date') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">When the assignment will end</p>
                    @error('end_date')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-gray-200 pt-4 dark:border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    Cancel
                </a>
                <button type="submit" id="submitBtn" class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Assign Room
                </button>
            </div>
        </form>
    </div>

    <script>
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        function updateEndDateMin() {
            if (startDateInput.value) {
                endDateInput.min = startDateInput.value;
            }
        }

        startDateInput.addEventListener('change', updateEndDateMin);
        updateEndDateMin();

        document.getElementById('assignForm').addEventListener('submit', function () {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
@endsection
