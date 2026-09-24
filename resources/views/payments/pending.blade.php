@extends('layouts.app')

@section('title', 'Complete Payment | Efarmer')
@section('description', 'Check your phone and enter your M-Pesa PIN to complete your goat purchase.')

@section('content')

<section class="py-14 lg:py-20">

    <div class="max-w-lg mx-auto px-5">

        <div class="card-soft p-9 sm:p-10 text-center">

            <div class="relative w-24 h-24 mx-auto">

                <span class="absolute inset-0 rounded-full bg-efarmer-100 animate-ping opacity-40"></span>

                <span class="relative w-24 h-24 rounded-full bg-efarmer-600 text-white flex items-center justify-center text-4xl">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </span>

            </div>

            <h1 class="font-display text-2xl font-extrabold text-efarmer-900 mt-7">
                Check your phone
            </h1>

            <p class="text-gray-500 mt-3 leading-7">
                We sent an M-Pesa prompt to your phone. Enter your PIN to pay
            </p>

            <p class="font-display text-3xl font-extrabold text-efarmer-800 mt-3">
                KSh {{ number_format($goat->selling_price) }}
            </p>

            <div class="mt-7 grid sm:grid-cols-2 gap-3 text-left">

                <div class="rounded-2xl bg-efarmer-50/70 border border-efarmer-100 p-4">
                    <p class="text-[11px] uppercase tracking-wider font-bold text-gray-400">Goat</p>
                    <p class="font-bold text-efarmer-900 mt-1">{{ $goat->name ?? $goat->tag_number }}</p>
                </div>

                <div class="rounded-2xl bg-efarmer-50/70 border border-efarmer-100 p-4">
                    <p class="text-[11px] uppercase tracking-wider font-bold text-gray-400">Reference</p>
                    <p class="font-mono font-bold text-efarmer-900 mt-1 text-sm">{{ $reference }}</p>
                </div>

            </div>

            <div class="mt-8 rounded-2xl border border-clay-200 bg-clay-50 p-4" id="statusBox">

                <!-- Waiting -->
                <div id="statusWaiting">
                    <div class="flex items-center justify-center gap-2 text-sm font-bold text-clay-700">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                        Waiting for payment confirmation…
                    </div>

                    <p class="text-xs text-clay-600/80 mt-2 text-center">
                        This page updates automatically once M-Pesa confirms your payment.
                    </p>
                </div>

                <!-- Success -->
                <div id="statusSuccess" class="hidden">
                    <div class="flex items-center justify-center gap-2 text-sm font-bold text-green-700">
                        <i class="fa-solid fa-circle-check"></i>
                        Payment processed successfully
                    </div>

                    <p class="text-xs text-green-700/80 mt-2 text-center">
                        Your payment was confirmed by M-Pesa. Taking you to your receipt…
                    </p>

                    <a href="{{ route('payment.receipt', ['reference' => $reference]) }}" class="btn btn-primary w-full mt-4">
                        <i class="fa-solid fa-receipt"></i> View receipt
                    </a>
                </div>

                <!-- Cancelled -->
                <div id="statusCancelled" class="hidden">
                    <div class="flex items-center justify-center gap-2 text-sm font-bold text-amber-700">
                        <i class="fa-solid fa-ban"></i>
                        Transaction cancelled
                    </div>

                    <p class="text-xs text-amber-700/80 mt-2 text-center" id="cancelledReason">
                        The M-Pesa prompt was cancelled before completion. No money was deducted.
                    </p>

                    <a href="{{ route('checkout', ['goat' => $goat]) }}" class="btn btn-primary w-full mt-4">
                        <i class="fa-solid fa-rotate-right"></i> Try again
                    </a>
                </div>

                <!-- Failed -->
                <div id="statusFailed" class="hidden">
                    <div class="flex items-center justify-center gap-2 text-sm font-bold text-red-700">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Payment not completed
                    </div>

                    <p class="text-xs text-red-700/80 mt-2 text-center" id="failedReason">
                        Your payment could not be confirmed.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-3 mt-4">
                        <a href="{{ route('checkout', ['goat' => $goat]) }}" class="btn btn-primary">
                            <i class="fa-solid fa-rotate-right"></i> Try again
                        </a>
                        <a href="{{ route('goats.index') }}" class="btn btn-outline">
                            Back to goats
                        </a>
                    </div>
                </div>

            </div>

            <p class="text-xs text-gray-400 mt-7">
                Stuck? Call <a href="tel:+254712345678" class="font-bold text-efarmer-700">+254 712 345 678</a>
                with your reference above.
            </p>

        </div>

    </div>

</section>

@endsection

@push('scripts')
<script>
    var reference = '{{ $reference }}';
    var pollTimer = null;

    function stopPolling() {
        if (pollTimer) {
            clearInterval(pollTimer);
            pollTimer = null;
        }
    }

    function showStatus(state) {
        ['statusWaiting', 'statusSuccess', 'statusCancelled', 'statusFailed'].forEach(function (id) {
            document.getElementById(id).classList.add('hidden');
        });
        document.getElementById('status' + state.charAt(0).toUpperCase() + state.slice(1)).classList.remove('hidden');

        var box = document.getElementById('statusBox');
        box.classList.remove('border-clay-200', 'bg-clay-50', 'border-green-200', 'bg-green-50', 'border-amber-200', 'bg-amber-50', 'border-red-200', 'bg-red-50');

        if (state === 'waiting') {
            box.classList.add('border-clay-200', 'bg-clay-50');
        } else if (state === 'success') {
            box.classList.add('border-green-200', 'bg-green-50');
        } else if (state === 'cancelled') {
            box.classList.add('border-amber-200', 'bg-amber-50');
        } else {
            box.classList.add('border-red-200', 'bg-red-50');
        }
    }

    function checkPaymentStatus() {
        fetch('{{ route("payment.status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ reference: reference }),
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data.status === 'completed') {
                stopPolling();
                showStatus('success');
                setTimeout(function () {
                    window.location.href = data.redirect || '/payment/receipt/' + encodeURIComponent(reference);
                }, 2500);
            } else if (data.status === 'cancelled') {
                stopPolling();
                if (data.reason) {
                    document.getElementById('cancelledReason').textContent =
                        data.reason + '. No money was deducted.';
                }
                showStatus('cancelled');
            } else if (data.status === 'failed' || data.status === 'not_found') {
                stopPolling();
                if (data.reason) {
                    document.getElementById('failedReason').textContent = data.reason;
                }
                showStatus('failed');
            }
        })
        .catch(function (err) { console.error('Status check failed:', err); });
    }

    pollTimer = setInterval(checkPaymentStatus, 5000);
</script>
@endpush
