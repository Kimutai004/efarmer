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

            <div class="mt-8 rounded-2xl border border-clay-200 bg-clay-50 p-4">

                <div class="flex items-center justify-center gap-2 text-sm font-bold text-clay-700">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Waiting for payment confirmation…
                </div>

                <p class="text-xs text-clay-600/80 mt-2">
                    This page moves automatically once M-Pesa confirms your payment.
                </p>

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
                window.location.href = data.redirect || '/payment/receipt/' + encodeURIComponent(reference);
            } else if (data.status === 'failed') {
                clearInterval(pollTimer);
                alert('Your payment could not be confirmed. Please try again or contact support with reference ' + reference);
            }
        })
        .catch(function (err) { console.error('Status check failed:', err); });
    }

    var pollTimer = setInterval(checkPaymentStatus, 5000);
</script>
@endpush
