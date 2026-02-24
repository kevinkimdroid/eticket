@extends('layouts.admin')
@section('title', 'Scan Ticket')
@section('content')
<h1 class="text-2xl font-bold mb-6">Scan Ticket</h1>

<div class="grid lg:grid-cols-2 gap-8">
    {{-- QR Scanner --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50">
            <h2 class="font-semibold text-slate-800">Scan QR Code</h2>
            <p class="text-sm text-slate-500 mt-1">Point your camera at the ticket QR code</p>
        </div>
        <div class="p-4">
            <div id="reader" class="rounded-xl overflow-hidden bg-slate-900 aspect-square max-w-sm mx-auto"></div>
            <div id="scannerStatus" class="mt-3 text-center text-sm text-slate-500"></div>
            <div class="flex gap-2 mt-4 justify-center">
                <button type="button" id="startScanner" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Start Camera</button>
                <button type="button" id="stopScanner" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-medium hidden">Stop Camera</button>
            </div>
        </div>
    </div>

    {{-- Manual entry --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-slate-50">
            <h2 class="font-semibold text-slate-800">Or Enter Code</h2>
            <p class="text-sm text-slate-500 mt-1">Type the booking code from the ticket</p>
        </div>
        <div class="p-6">
            <input type="text" id="codeInput" placeholder="e.g. ABC12XYZ" class="w-full border border-slate-300 rounded-xl px-4 py-3 text-lg font-mono mb-4" autocomplete="off">
            <button type="button" id="lookupBtn" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium">Lookup Ticket</button>
        </div>
    </div>
</div>

{{-- Result --}}
<div id="result" class="mt-8 hidden"></div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
const resultDiv = document.getElementById('result');
const codeInput = document.getElementById('codeInput');
const startBtn = document.getElementById('startScanner');
const stopBtn = document.getElementById('stopScanner');
const statusEl = document.getElementById('scannerStatus');

let html5QrCode = null;
let lastScannedCode = '';
let scanCooldown = false;

function extractCodeFromScan(decodedText) {
    const text = (decodedText || '').trim();
    const match = text.match(/\/ticket\/([A-Za-z0-9]+)/i) || text.match(/ticket\/([A-Za-z0-9]+)/i);
    if (match) return match[1].toUpperCase();
    if (/^[A-Za-z0-9]{6,12}$/.test(text)) return text.toUpperCase();
    return text.toUpperCase();
}

let lastLookedUpCode = '';
function lookup(code) {
    code = (code || codeInput.value.trim()).toUpperCase();
    lastLookedUpCode = code;
    if (!code) return;
    resultDiv.classList.remove('hidden');
    resultDiv.innerHTML = '<div class="p-6 bg-slate-50 rounded-xl animate-pulse"><p class="text-slate-500">Looking up...</p></div>';
    fetch('{{ route("admin.bookings.lookup") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ code })
    })
    .then(r => r.json())
    .then(data => {
        if (data.found) {
            showTicketResult(data.booking);
        } else {
            resultDiv.innerHTML = `<div class="p-6 bg-red-50 border border-red-200 rounded-xl"><p class="text-red-700 font-medium">${data.message || 'Ticket not found'}</p></div>`;
        }
    })
    .catch(() => {
        resultDiv.innerHTML = '<div class="p-6 bg-red-50 rounded-xl"><p class="text-red-700">Error looking up ticket</p></div>';
    });
}

function showTicketResult(b) {
    const checkedIn = !!b.checked_in_at;
    const canCheckIn = ['paid','pay_at_venue'].includes(b.status) && !checkedIn;
    resultDiv.innerHTML = `
        <div class="bg-white rounded-2xl shadow-lg border-2 ${canCheckIn ? 'border-indigo-200' : checkedIn ? 'border-emerald-200' : 'border-amber-200'} overflow-hidden">
            <div class="p-6 ${canCheckIn ? 'bg-indigo-50' : checkedIn ? 'bg-emerald-50' : 'bg-amber-50'} border-b">
                <p class="text-3xl font-mono font-bold ${canCheckIn ? 'text-indigo-600' : checkedIn ? 'text-emerald-600' : 'text-amber-600'}">${b.code}</p>
                <p class="text-lg font-semibold text-slate-800 mt-2">${b.customer_name}</p>
                <p class="text-slate-600">${b.event}</p>
                <p class="text-slate-500 text-sm">${b.ticket_type} × ${b.quantity}</p>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <span class="px-3 py-1.5 rounded-full text-sm font-medium ${checkedIn ? 'bg-emerald-100 text-emerald-700' : ['paid','pay_at_venue'].includes(b.status) ? 'bg-indigo-100 text-indigo-700' : 'bg-amber-100 text-amber-700'}">
                        ${checkedIn ? '✓ Checked in' : b.status === 'pay_at_venue' ? 'Pay at venue' : b.status === 'paid' ? 'Paid' : 'Pending'}
                    </span>
                    ${canCheckIn ? `<button onclick="checkIn(${b.id})" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700">Check In</button>` : ''}
                </div>
                ${checkedIn ? '<p class="text-emerald-600 font-medium mt-4">This ticket has already been checked in.</p>' : ''}
                ${!['paid','pay_at_venue'].includes(b.status) ? '<p class="text-amber-600 mt-4">Payment is pending. Cannot check in.</p>' : ''}
                <button type="button" id="scanNextBtn" class="mt-4 text-indigo-600 font-medium hover:underline">Scan next ticket</button>
            </div>
        </div>
    `;
}

function checkIn(id) {
    fetch(`{{ url('admin/bookings') }}/${id}/check-in`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            lookup(lastLookedUpCode);
        } else {
            resultDiv.querySelector('button')?.insertAdjacentHTML('afterend', `<p class="text-red-600 text-sm mt-2">${data.message}</p>`);
        }
    });
}

document.getElementById('lookupBtn').addEventListener('click', () => lookup());
codeInput.addEventListener('keypress', e => e.key === 'Enter' && lookup());

startBtn.addEventListener('click', async function() {
    try {
        statusEl.textContent = 'Requesting camera...';
        html5QrCode = new Html5Qrcode('reader');
        await html5QrCode.start(
            { facingMode: 'environment' },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            (decodedText) => {
                const code = extractCodeFromScan(decodedText);
                if (scanCooldown || !code) return;
                scanCooldown = true;
                setTimeout(() => scanCooldown = false, 2000);
                html5QrCode.stop();
                codeInput.value = code;
                lookup(code);
                startBtn.classList.remove('hidden');
                stopBtn.classList.add('hidden');
                statusEl.textContent = 'Scanned! Looking up...';
            },
            () => {}
        );
        startBtn.classList.add('hidden');
        stopBtn.classList.remove('hidden');
        statusEl.textContent = 'Point camera at QR code';
    } catch (err) {
        statusEl.textContent = 'Camera error: ' + (err.message || 'Permission denied');
    }
});

document.addEventListener('click', function(e) {
    if (e.target.id === 'scanNextBtn') {
        codeInput.value = '';
        resultDiv.classList.add('hidden');
        codeInput.focus();
    }
});

stopBtn.addEventListener('click', function() {
    if (html5QrCode && html5QrCode.isScanning) {
        html5QrCode.stop();
        html5QrCode.clear();
    }
    startBtn.classList.remove('hidden');
    stopBtn.classList.add('hidden');
    statusEl.textContent = '';
});
</script>
@endpush
@endsection
