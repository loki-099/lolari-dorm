@extends('layouts.boarder')

@section('content')
    <div class="p-4 border border-default border-dashed rounded-base min-h-screen">
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-heading text-2xl font-bold">Your Activities</h1>
                <p class="text-body text-sm mt-1">Review your entry and exit history, and display your QR code when needed.</p>
            </div>
            <button id="toggleQrCode" type="button" class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-base focus:outline-none focus:ring-2 focus:ring-blue-400">
                Show QR Code
            </button>
        </div>

        <div class="grid gap-4 mb-6 grid-cols-1 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="bg-neutral-primary-soft p-6 border border-default rounded-base shadow-md order-2 lg:order-1">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-heading">Activity History</h2>
                    <p class="text-body text-sm">All activity records for your profile are listed here.</p>
                </div>

                @if ($activities->isNotEmpty())
                    <div class="overflow-x-auto bg-neutral-primary-soft shadow-sm rounded-base border border-default">
                        <table class="min-w-full text-sm text-left text-body table-fixed">
                            <thead class="text-sm text-body bg-neutral-tertiary border-b border-default">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Activity</th>
                                    <th class="px-4 py-3 font-medium">Reason</th>
                                    <th class="px-4 py-3 font-medium">Date</th>
                                    <th class="px-4 py-3 font-medium">Recorded</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr class="bg-neutral-secondary-soft border-b border-default">
                                        <td class="px-4 py-4 font-medium text-heading">
                                            @if ($activity->activity_name === 'entry')
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">Entry</span>
                                            @else
                                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Exit</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-body">{{ $activity->activity_reason ?? '-' }}</td>
                                        <td class="px-4 py-4 text-body">{{ $activity->activity_date ? \Carbon\Carbon::parse($activity->activity_date)->format('F d, Y') : $activity->created_at->format('F d, Y') }}</td>
                                        <td class="px-4 py-4 text-body">{{ $activity->created_at->format('h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="rounded-base bg-neutral-secondary-soft p-6 text-body">
                        <p class="text-body">No activity records found yet.</p>
                    </div>
                @endif
            </div>

            <div class="bg-neutral-primary-soft p-6 border border-default rounded-base shadow-md order-1 lg:order-2">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-heading">Boarder QR Code</h2>
                    <p class="text-body text-sm">Use this QR code for scanning or identification when asked.</p>
                </div>

                <div id="qrCodePanel" class="hidden bg-white p-6 rounded-base border border-default text-center flex flex-col items-center">
                    @if ($boarder->qrcode_value)
                        <div class="mx-auto mb-4 w-full max-w-xs">
                            {!! QrCode::size(200)->generate($boarder->qrcode_value) !!}
                        </div>
                        <p class="text-body text-xs break-all">{{ $boarder->qrcode_value }}</p>
                    @else
                        <div class="rounded-base bg-amber-100 p-4 text-body">
                            <p>No QR code is assigned to your profile yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleQrCode');
            const qrPanel = document.getElementById('qrCodePanel');

            toggleBtn.addEventListener('click', function () {
                const shown = !qrPanel.classList.contains('hidden');
                qrPanel.classList.toggle('hidden');
                toggleBtn.textContent = shown ? 'Show QR Code' : 'Hide QR Code';
            });
        });
    </script>
@endsection
