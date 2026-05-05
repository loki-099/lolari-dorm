@extends('layouts.staff')

@section('title', 'Activity Scan')

@section('content')
    <div class="mt-2 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Scan Activity</h2>
        <div>
            <div class="p-6 space-y-6 text-center">
                <div
                    class="w-full max-w-xs sm:max-w-sm aspect-square mx-auto rounded-xl overflow-hidden shadow-lg bg-gray-900">
                    <div id="reader" class="w-full h-full"></div>
                </div>
                <p id="status" class="text-green-400 text-xl font-bold">Initializing camera...</p>

                <!-- Error Message Display -->
                <div id="errorMessage" class="hidden p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <strong>Error:</strong> <span id="errorText"></span>
                </div>

                <!-- Success Message Display -->
                <div id="successMessage" class="hidden p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <strong>Success:</strong> <span id="successText"></span>
                </div>

                <!-- Activity Type Selection (hidden by default) -->
                <div id="activityButtons" class="hidden space-y-3">
                    <p class="text-gray-700 dark:text-gray-300 font-semibold">Select Activity Type:</p>
                    <div class="flex gap-4 justify-center">
                        <button onclick="recordActivity('entry')"
                            class="focus:outline-none text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Entry
                        </button>
                        <button onclick="recordActivity('exit')"
                            class="focus:outline-none text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                            Exit
                        </button>
                    </div>
                </div>

                <a href="{{ route('staff.dashboard') }}"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                    onclick="stopScanner(); return true;">Back</a>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let html5QrCode = null;
        let isScanning = false;
        let scannedData = null;
        const activityRoute = "{{ route('staff.activity.record') }}";

        function setStatus(message, color = 'green') {
            const el = document.getElementById('status');
            el.textContent = message;
            el.className = `text-${color}-400 text-xl font-bold`;
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            errorText.textContent = message;
            errorDiv.classList.remove('hidden');
            
            setTimeout(() => {
                errorDiv.classList.add('hidden');
            }, 5000);
        }

        function showSuccess(message) {
            const successDiv = document.getElementById('successMessage');
            const successText = document.getElementById('successText');
            successText.textContent = message;
            successDiv.classList.remove('hidden');
            
            setTimeout(() => {
                successDiv.classList.add('hidden');
            }, 3000);
        }

        async function startScanner() {
            if (isScanning) return;

            setStatus('Requesting camera access...', 'yellow');

            // Step 1: Test if browser supports getUserMedia
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                const errorMsg = 'Error: Browser does not support camera access.';
                setStatus(errorMsg, 'red');
                showError(errorMsg);
                return;
            }

            // Step 2: Explicitly request permission first
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                stream.getTracks().forEach(track => track.stop()); // release immediately
                setStatus('Permission granted. Starting scanner...', 'yellow');
            } catch (err) {
                console.log('Permission error:', err);
                const errorMsg = 'Camera permission denied: ' + err.message;
                setStatus(errorMsg, 'red');
                showError(errorMsg);
                return;
            }

            // Step 3: Start html5-qrcode
            try {
                if (html5QrCode) html5QrCode.clear();
                html5QrCode = new Html5Qrcode("reader");

                await html5QrCode.start({
                        facingMode: "user"
                    }, // try "user" (front cam) if "environment" fails on PC
                    {
                        fps: 10,
                        qrbox: {
                            width: 200,
                            height: 200
                        },
                    },
                    (decodedText) => {
                        scannedData = decodedText;
                        stopScanner().then(() => {
                            setStatus('Scan successful! Select activity type:', 'blue');
                            showSuccess('QR Code scanned successfully: ' + decodedText);
                            document.getElementById('activityButtons').classList.remove('hidden');
                        });
                    },
                    () => {} // suppress per-frame scan errors
                );

                isScanning = true;
                setStatus('Scanning...', 'green');
                console.log('Scanner started successfully');

            } catch (err) {
                console.log('Scanner start error:', err);
                isScanning = false;
                const errorMsg = 'Scanner error: ' + err.message;
                setStatus(errorMsg, 'red');
                showError(errorMsg);
            }
        }

        function stopScanner() {
            if (!isScanning || !html5QrCode) return Promise.resolve();
            return html5QrCode.stop().then(() => {
                html5QrCode.clear();
                isScanning = false;
            }).catch(err => {
                console.log('Stop error:', err);
                isScanning = false;
            });
        }

        function recordActivity(activityType) {
            if (!scannedData) {
                showError('No scanned data available.');
                return;
            }

            fetch(activityRoute, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        qr_code: scannedData,
                        activity_type: activityType
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        showSuccess(data.message);
                        document.getElementById('activityButtons').classList.add('hidden');
                        scannedData = null;
                        setTimeout(startScanner, 1000);
                    } else {
                        showError(data.message);
                        setTimeout(startScanner, 1000);
                    }
                })
                .catch(err => {
                    console.log('Fetch error:', err);
                    showError('Failed to record activity: ' + err.message);
                    setTimeout(startScanner, 1000);
                });
        }

        window.addEventListener('load', () => setTimeout(startScanner, 500));
        window.addEventListener('beforeunload', stopScanner);
    </script>
@endsection
