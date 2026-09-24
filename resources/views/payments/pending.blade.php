@extends('layouts.app')

@section('title', 'Payment Pending | Efarmer')
@section('description', 'Complete your M-Pesa payment')

@section('content')

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto px-5">

        <div class="bg-white rounded-2xl border shadow-sm p-8 text-center">

            <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                <i class="fa-solid fa-mobile-screen-button text-4xl text-green-600"></i>
            </div>

            <h1 class="text-2xl font-extrabold text-gray-900">Check Your Phone</h1>

            <p class="text-gray-500 mt-3">
                We've sent an M-Pesa STK push to your phone. Enter your PIN to complete the payment of
            </p>

            <p class="text-3xl font-extrabold text-green-700 mt-3">
                KSh {{ number_format($goat->selling_price) }}
            </p>

            <div class="mt-6 bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-500">Payment Reference:</p>
                <p class="font-mono font-bold text-lg">{{ $reference }}</p>
            </div>

            <div class="mt-6">
                <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    Waiting for payment confirmation...
                </div>
            </div>

            <p class="text-xs text-gray-400 mt-6">
                Having trouble? Contact us at +254 712 345 678
            </p>

        </div>

    </div>
</section>

@push('scripts')
<script>
    const reference = '{{ $reference }}';

    function checkPaymentStatus() {
        fetch('{{ route("payment.status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ reference: reference }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'completed') {
                window.location.href = '/payment/success?ref=' + reference;
            } else if (data.status === 'failed') {
                window.location.href = '/payment/failed?ref=' + reference;
            }
        })
        .catch(err => console.error('Status check failed:', err));
    }

    setInterval(checkPaymentStatus, 5000);
</script>
@endpush

@endsection