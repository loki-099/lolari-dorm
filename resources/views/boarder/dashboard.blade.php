@extends('layouts.boarder')

@section('content')
    <div class="p-4 border-1 border-default border-dashed rounded-base min-h-screen">
        <h1 class="text-heading text-2xl font-bold mb-4">Upcoming Payment</h1>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <div class="bg-neutral-primary-soft block p-6 border border-default rounded-base shadow-xs md:col-span-3">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-body text-sm">Rent Amount</h2>
                        <h1 class="text-heading font-bold text-4xl md:text-5xl">P{{ (int) $rent_data['amount'] }}</h1>
                    </div>
                    <div class="flex-row items-start gap-x-2">
                        <h2 class="text-body text-sm text-right mb-1 md:mb-2" text>Status</h2>
                        @if($rent_data['status'] == 'Overdue')
                            <div class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 dark:focus:ring-red-800 font-medium rounded-base text-sm px-4 py-2 text-center">Overdue</div>
                        @endif
                        @if($rent_data['status'] == 'Paid')
                            <div class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 dark:focus:ring-green-800 font-medium rounded-base text-sm px-4 py-2 text-center">Paid</div>
                        @endif
                        @if($rent_data['status'] == 'Upcoming')
                            <div class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2 text-center">Upcoming</div>
                        @endif
                    </div>
                </div>
                <hr class="h-px my-4 bg-neutral-quaternary border-0">
                <div class="flex items-center gap-x-4">
                    <span class="flex items-center gap-x-1">
                        <svg class="inline w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-body text-xs">Billing Period: <span class="font-bold text-heading">{{ $rent_data['billing_period_start'] }} - {{ $rent_data['billing_period_end'] }}</span></p>
                    </span>
                    <span class="flex items-center gap-x-1">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                        </svg>

                        <p class="text-body text-xs">Due Date: <span class="font-bold text-heading">{{ $rent_data['due_date'] }}</span></p>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-center min-h-24 rounded-base bg-neutral-secondary-soft md:col-span-2">
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
