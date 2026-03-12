@extends('layouts.boarder')

@section('content')
    <div class="p-4 border-1 border-default border-dashed rounded-base min-h-screen">
        <h1 class="text-heading text-2xl font-bold mb-4">Upcoming Payment</h1>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            {{-- Rent Details --}}
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-xs md:col-span-3">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-body text-sm">Rent Amount</h2>
                        <h1 class="text-heading font-bold text-4xl md:text-5xl">₱{{ (int) $rent_data['amount'] }}</h1>
                    </div>
                    <div class="flex-row items-start gap-x-2">
                        <h2 class="text-body text-sm text-right mb-1 md:mb-2" text>Status</h2>
                        @if ($rent_data['status'] == 'Overdue')
                            <div
                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 dark:focus:ring-red-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                                Overdue</div>
                        @endif
                        @if ($rent_data['status'] == 'Paid')
                            <div
                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 dark:focus:ring-green-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                                Paid</div>
                        @endif
                        @if ($rent_data['status'] == 'Upcoming')
                            <div
                                class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                                Upcoming</div>
                        @endif
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-x-4 gap-y-4">
                    <span class="flex items-center gap-x-2">
                        <svg class="inline w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-body text-xs">Billing Period</p>
                            <span class="font-bold text-heading">{{ $rent_data['billing_period_start'] ?? 'N/A' }} -
                                {{ $rent_data['billing_period_end'] }}</span>
                        </div>
                    </span>
                    <span class="flex items-center gap-x-2">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                        </svg>
                        <div>
                            <p class="text-body text-xs">Due Date:</p>
                            <span class="font-bold text-heading">{{ $rent_data['due_date'] }}</span>
                        </div>
                    </span>
                </div>
            </div>
            {{-- Room Details --}}
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-xs md:col-span-2">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-body text-sm">Room Number</h2>
                        <h1 class="text-heading font-bold text-3xl md:text-4xl">Room {{ $room->number }}</h1>
                    </div>
                    <div
                        class="inline-flex items-center justify-center w-14 h-14 bg-amber-100 dark:bg-amber-900/30 rounded-full">
                        <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M384 128L448 128L448 544C448 561.7 462.3 576 480 576L512 576C529.7 576 544 561.7 544 544C544 526.3 529.7 512 512 512L512 128C512 92.7 483.3 64 448 64L352 64L352 64L192 64C156.7 64 128 92.7 128 128L128 512C110.3 512 96 526.3 96 544C96 561.7 110.3 576 128 576L352 576C369.7 576 384 561.7 384 544L384 128zM256 320C256 302.3 270.3 288 288 288C305.7 288 320 302.3 320 320C320 337.7 305.7 352 288 352C270.3 352 256 337.7 256 320z" />
                        </svg>
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <p class="text-body">Capacity: 1/{{ $room->capacity }}</p>
                <p class="text-body">Started Date: {{ $assignment->start_date->format('F d, Y') }}</p>
            </div>
        </div>
        <h1 class="text-heading text-2xl font-bold mt-8 mb-4">Utility Bills</h1>
        <div class="grid md:grid-cols-3 gap-4 mb-4">
            {{-- Electric Bill --}}
            <div class="bg-neutral-primary-soft p-6 border border-default rounded-base shadow-xs min-h-24">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-body text-sm">Electricity Bill</h2>
                        <h1 class="text-heading font-bold text-2xl md:text-3xl">₱952</h1>

                    </div>
                    <div
                        class="inline-flex items-center justify-center w-14 h-14 bg-amber-100 dark:bg-amber-900/30 rounded-full">
                        <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M434.8 54.1C446.7 62.7 451.1 78.3 445.7 91.9L367.3 288L512 288C525.5 288 537.5 296.4 542.1 309.1C546.7 321.8 542.8 336 532.5 344.6L244.5 584.6C233.2 594 217.1 594.5 205.2 585.9C193.3 577.3 188.9 561.7 194.3 548.1L272.7 352L128 352C114.5 352 102.5 343.6 97.9 330.9C93.3 318.2 97.2 304 107.5 295.4L395.5 55.4C406.8 46 422.9 45.5 434.8 54.1z" />
                        </svg>
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <div class="flex items-center justify-between gap-x-4">
                    <span class="flex items-center gap-x">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                        </svg>
                        <p class="text-body text-xs">Due Date: <span
                                class="font-bold text-heading">{{ $rent_data['due_date'] }}</span></p>
                    </span>
                    <div
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 dark:focus:ring-green-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                        Paid</div>
                </div>
            </div>
            {{-- Water Bill --}}
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-xs min-h-24">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-body text-sm">Water Bill</h2>
                        <h1 class="text-heading font-bold text-2xl md:text-3xl">₱165</h1>

                    </div>
                    <div
                        class="inline-flex items-center justify-center w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M320 576C214 576 128 490 128 384C128 292.8 258.2 109.9 294.6 60.5C300.5 52.5 309.8 48 319.8 48L320.2 48C330.2 48 339.5 52.5 345.4 60.5C381.8 109.9 512 292.8 512 384C512 490 426 576 320 576zM240 376C240 362.7 229.3 352 216 352C202.7 352 192 362.7 192 376C192 451.1 252.9 512 328 512C341.3 512 352 501.3 352 488C352 474.7 341.3 464 328 464C279.4 464 240 424.6 240 376z" />
                        </svg>
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <div class="flex items-center justify-between gap-x-4">
                    <span class="flex items-center gap-x">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                        </svg>
                        <p class="text-body text-xs">Due Date: <span
                                class="font-bold text-heading">{{ $rent_data['due_date'] }}</span></p>
                    </span>
                    <div
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 dark:focus:ring-green-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                        Paid</div>
                </div>
            </div>
            {{-- Internet Bill --}}
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-xs min-h-24">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-body text-sm">Internet Bill</h2>
                        <h1 class="text-heading font-bold text-2xl md:text-3xl">₱200</h1>

                    </div>
                    <div
                        class="inline-flex items-center justify-center w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-full">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 640 640">
                            <path
                                d="M320 160C229.1 160 146.8 196 86.3 254.6C73.6 266.9 53.3 266.6 41.1 253.9C28.9 241.2 29.1 220.9 41.8 208.7C113.7 138.9 211.9 96 320 96C428.1 96 526.3 138.9 598.3 208.7C611 221 611.3 241.3 599 253.9C586.7 266.5 566.4 266.9 553.8 254.6C493.2 196 410.9 160 320 160zM272 496C272 469.5 293.5 448 320 448C346.5 448 368 469.5 368 496C368 522.5 346.5 544 320 544C293.5 544 272 522.5 272 496zM200 390.2C188.3 403.5 168.1 404.7 154.8 393C141.5 381.3 140.3 361.1 152 347.8C193 301.4 253.1 272 320 272C386.9 272 447 301.4 488 347.8C499.7 361.1 498.4 381.3 485.2 393C472 404.7 451.7 403.4 440 390.2C410.6 356.9 367.8 336 320 336C272.2 336 229.4 356.9 200 390.2z" />
                        </svg>
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <div class="flex items-center justify-between gap-x-4">
                    <span class="flex items-center gap-x">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                        </svg>
                        <p class="text-body text-xs">Due Date: <span
                                class="font-bold text-heading">{{ $rent_data['due_date'] }}</span></p>
                    </span>
                    <div
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 dark:focus:ring-red-800 font-medium rounded-base text-sm px-4 py-2 text-center">
                        Not Paid</div>
                </div>
            </div>
        </div>

        {{-- <div class="flex items-center justify-center h-48 rounded-base bg-neutral-secondary-soft mb-4">
            <p class="text-fg-disabled">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
        </div>
        <div class="flex items-center justify-center h-48 rounded-base bg-neutral-secondary-soft mb-4">
            <p class="text-fg-disabled">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
            <div class="flex items-center justify-center h-24 rounded-base bg-neutral-secondary-soft">
                <p class="text-fg-disabled">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>
                </p>
            </div>
        </div> --}}
    </div>
@endsection
