@extends('layouts.app')

@section('title', 'Payment Receipt | Efarmer')
@section('description', 'Your Efarmer payment receipt.')

@section('content')

<section class="py-12 lg:py-16">

    <div class="max-w-2xl mx-auto px-5">

        <div class="card-soft overflow-hidden" id="receipt">

            <!-- HEADER -->

            <div class="relative bg-efarmer-900 text-white text-center p-10 overflow-hidden">

                <div class="absolute inset-0 noise-dots opacity-25"></div>

                <div class="relative">

                    <span class="w-16 h-16 mx-auto rounded-full bg-clay-500 flex items-center justify-center text-2xl shadow-card">
                        <i class="fa-solid fa-check"></i>
                    </span>

                    <h1 class="font-display text-2xl font-extrabold mt-5">
                        Payment successful
                    </h1>

                    <p class="text-white/60 mt-2 text-sm">
                        Your digital receipt is ready below.
                    </p>

                </div>

            </div>

            <!-- RECEIPT DETAILS -->

            <div class="p-8 lg:p-10">

                <div class="text-center">

                    <img src="{{ asset('images/logo.png') }}" alt="Efarmer" class="h-12 w-auto object-contain mx-auto">

                    <p class="text-xs uppercase tracking-[0.2em] font-bold text-gray-400 mt-3">
                        Official receipt
                    </p>

                </div>

                <div class="mt-8 border-y border-dashed border-efarmer-200 py-5 space-y-3">

                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-400">Receipt no</span>
                        <span class="font-mono font-bold text-efarmer-900">{{ $payment->payment_reference }}</span>
                    </div>

                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-400">Date</span>
                        <span class="font-semibold text-efarmer-900">{{ $payment->updated_at->format('d M Y, H:i') }}</span>
                    </div>

                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-400">M-Pesa receipt</span>
                        <span class="font-mono font-bold text-efarmer-900">{{ $payment->transaction_id ?? 'N/A' }}</span>
                    </div>

                    <div class="flex justify-between gap-4 text-sm">
                        <span class="text-gray-400">Method</span>
                        <span class="inline-flex items-center gap-1.5 font-bold text-efarmer-900">
                            <i class="fa-solid fa-mobile-screen text-clay-500"></i> M-Pesa
                        </span>
                    </div>

                </div>


                <!-- BUYER & DELIVERY -->

                <div class="mt-7">

                    <h3 class="font-display font-bold text-efarmer-900">Buyer &amp; delivery</h3>

                    <div class="mt-4 space-y-3 text-sm">

                        @if(preg_match('/Buyer:\\s*([^|]+)/', $payment->notes, $buyerMatch))
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">Buyer</span>
                                <span class="font-semibold text-efarmer-900 text-right">{{ trim($buyerMatch[1]) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between gap-4">
                            <span class="text-gray-400">Phone</span>
                            <span class="font-semibold text-efarmer-900">{{ $payment->phone_number }}</span>
                        </div>

                        @if(preg_match('/Delivery:\\s*([^|]+)/', $payment->notes, $deliveryMatch))
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">Deliver to</span>
                                <span class="font-semibold text-efarmer-900 text-right max-w-[220px]">{{ trim($deliveryMatch[1]) }}</span>
                            </div>
                        @endif

                        @if(preg_match('/Goat:\\s*([^|]+)/', $payment->notes, $goatMatch))
                            <div class="flex justify-between gap-4">
                                <span class="text-gray-400">Goat</span>
                                <span class="font-semibold text-efarmer-900 text-right">{{ trim($goatMatch[1]) }}</span>
                            </div>
                        @endif

                    </div>

                </div>

                <!-- AMOUNT BREAKDOWN -->

                <div class="mt-7 rounded-2xl bg-efarmer-50/70 border border-efarmer-100 p-5">

                    <h3 class="font-display font-bold text-efarmer-900">Amount</h3>

                    <div class="mt-3 space-y-2 text-sm">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Goat price</span>
                            <span class="font-semibold text-efarmer-900">KSh {{ number_format($payment->amount - 300) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Transport fee</span>
                            <span class="font-semibold text-efarmer-900">KSh 300</span>
                        </div>

                        <div class="border-t border-efarmer-100 pt-3 flex justify-between items-center">
                            <span class="font-bold text-efarmer-900">Total paid</span>
                            <span class="font-display text-xl font-extrabold text-efarmer-800">KSh {{ number_format($payment->amount) }}</span>
                        </div>

                    </div>

                </div>

                <div class="mt-7 text-center text-sm text-gray-500">
                    <p>Asante for your purchase. Our delivery team will call you shortly.</p>
                    <p class="mt-1 text-xs">Support: +254 712 345 678 · support@efarmer.co.ke</p>
                </div>

            </div>

            <!-- FOOTER ACTIONS -->

            <div class="p-6 bg-efarmer-50/50 border-t border-efarmer-100 flex flex-col sm:flex-row gap-3 justify-center print:hidden">

                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fa-solid fa-print"></i> Print receipt
                </button>

                <a href="{{ route('goats.index') }}" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Back to goats
                </a>

            </div>

        </div>

    </div>

</section>

@endsection

@push('styles')
<style>
    @media print {
        header, footer, #toTop, .print\:hidden { display: none !important; }

        body { background: #fff; }

        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
    }
</style>
@endpush

