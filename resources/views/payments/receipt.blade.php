@extends('layouts.app')

@section('title', 'Payment Receipt | Efarmer')
@section('description', 'Your payment receipt')

@section('content')

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-5">

        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden" id="receipt">

            <!-- Header -->
            <div class="p-8 bg-green-800 text-white text-center">
                <div class="w-16 h-16 mx-auto bg-white/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-check text-3xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold">Payment Successful!</h1>
                <p class="text-green-200 mt-2">Your digital receipt is ready.</p>
            </div>

            <!-- Receipt Details -->
            <div class="p-8">

                <div class="text-center mb-6">
                    <div class="text-3xl font-extrabold text-efarmer-800">
                        E<span class="text-efarmer-500">f</span>armer
                    </div>
                    <p class="text-sm text-gray-500">Official Receipt</p>
                </div>

                <div class="border-t border-b py-4 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Receipt No:</span>
                        <span class="font-mono font-bold">{{ $payment->payment_reference }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Date:</span>
                        <span class="font-semibold">{{ $payment->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">M-Pesa Receipt:</span>
                        <span class="font-mono font-bold">{{ $payment->transaction_id ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Payment Method:</span>
                        <span class="font-semibold">M-Pesa</span>
                    </div>
                </div>

                <!-- Buyer & Delivery Info -->
                <div class="mt-6 space-y-3">
                    <h3 class="font-bold text-gray-900">Buyer & Delivery Details</h3>
                    @if(preg_match('/Buyer:\s*([^|]+)/', $payment->notes, $buyerMatch))
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Buyer Name:</span>
                            <span class="font-semibold">{{ trim($buyerMatch[1]) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Phone:</span>
                        <span class="font-semibold">{{ $payment->phone_number }}</span>
                    </div>
                    @if(preg_match('/Delivery:\s*([^|]+)/', $payment->notes, $deliveryMatch))
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Delivery Address:</span>
                            <span class="font-semibold text-right max-w-[200px]">{{ trim($deliveryMatch[1]) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Item Details -->
                <div class="mt-6 space-y-3">
                    <h3 class="font-bold text-gray-900">Item Details</h3>
                    @if(preg_match('/Goat:\s*([^|]+)/', $payment->notes, $goatMatch))
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Goat Tag:</span>
                            <span class="font-semibold">{{ trim($goatMatch[1]) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Amount Breakdown -->
                <div class="mt-6 bg-gray-50 rounded-xl p-4">
                    <h3 class="font-bold text-gray-900 mb-3">Amount Breakdown</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Goat Price:</span>
                            <span class="font-semibold">KSh {{ number_format($payment->amount - 300) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Transport Fee:</span>
                            <span class="font-semibold">KSh 300</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between">
                            <span class="font-bold text-lg">Total Paid:</span>
                            <span class="text-xl font-extrabold text-green-700">KSh {{ number_format($payment->amount) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center text-sm text-gray-500">
                    <p>Thank you for your purchase! Our delivery team will contact you shortly.</p>
                    <p class="mt-1">For support: +254 712 345 678 | support@efarmer.co.ke</p>
                </div>

            </div>

            <!-- Footer Actions -->
            <div class="p-6 bg-gray-50 border-t flex flex-col sm:flex-row gap-3 justify-center">
                <button onclick="window.print()" class="px-6 py-3 bg-efarmer-600 text-white rounded-lg font-bold hover:bg-efarmer-700">
                    <i class="fa-solid fa-print mr-2"></i>Print Receipt
                </button>
                <a href="{{ route('goats.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 text-center">
                    <i class="fa-solid fa-arrow-left mr-2"></i>Back to Goats
                </a>
            </div>

        </div>

    </div>
</section>

@push('styles')
<style>
    @media print {
        body * { visibility: hidden; }
        #receipt, #receipt * { visibility: visible; }
        #receipt { position: absolute; left: 0; top: 0; width: 100%; }
        .bg-green-800 { background: #155415 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>
@endpush

@endsection