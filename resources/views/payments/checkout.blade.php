@extends('layouts.app')

@section('title', 'Checkout | Efarmer')
@section('description', 'Confirm your order and pay securely with M-Pesa.')

@section('content')

<section class="py-10 lg:py-14">

    <div class="max-w-6xl mx-auto px-5 lg:px-8">

        <!-- STEPS -->

        <div class="flex items-center justify-center gap-2 sm:gap-4 text-xs font-bold mb-10">

            <span class="flex items-center gap-2 text-efarmer-700">
                <span class="w-7 h-7 rounded-full bg-efarmer-600 text-white flex items-center justify-center">1</span>
                Review
            </span>

            <span class="w-8 sm:w-16 h-0.5 bg-efarmer-200"></span>

            <span class="flex items-center gap-2 text-efarmer-700">
                <span class="w-7 h-7 rounded-full bg-clay-500 text-white flex items-center justify-center">2</span>
                Pay
            </span>

            <span class="w-8 sm:w-16 h-0.5 bg-efarmer-100"></span>

            <span class="flex items-center gap-2 text-gray-400">
                <span class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center">3</span>
                Delivery
            </span>

        </div>

        <form action="{{ route('payment.initiate') }}" method="POST" class="grid lg:grid-cols-5 gap-6 items-start">

            @csrf
            <input type="hidden" name="goat_id" value="{{ $goat->id }}">

            <!-- ORDER SUMMARY -->

            <div class="lg:col-span-2 card-soft overflow-hidden lg:sticky lg:top-24">

                <div class="relative h-60 overflow-hidden">

                    @if($goat->primary_photo)
                        <img src="{{ asset('storage/'.$goat->primary_photo->path) }}" class="w-full h-full object-cover" alt="{{ $goat->name ?? $goat->tag_number }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="{{ $goat->name ?? $goat->tag_number }}">
                    @endif

                    <span class="absolute top-4 left-4 rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-efarmer-800">
                        {{ $goat->breed->name ?? 'Goat' }}
                    </span>

                </div>

                <div class="p-6">

                    <h2 class="font-display font-extrabold text-xl text-efarmer-900">
                        {{ $goat->name ?? $goat->tag_number }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1.5">
                        {{ $goat->breed->name ?? 'Unknown' }}
                        &middot; {{ ucfirst($goat->gender) }}
                        @if($goat->weight) &middot; {{ $goat->weight }}kg @endif
                    </p>

                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fa-solid fa-location-dot text-clay-500"></i>
                        {{ $goat->location ?? 'Kenya' }}
                    </p>

                    <label class="block mt-6">
                        <span class="field-label">Quantity</span>

                        <div class="flex items-center gap-3">

                            <button type="button" id="decreaseQty" aria-label="Decrease quantity" class="w-11 h-11 rounded-xl border border-efarmer-100 text-efarmer-700 hover:bg-efarmer-50 transition flex items-center justify-center">
                                <i class="fa-solid fa-minus"></i>
                            </button>

                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" readonly class="text-center font-display font-extrabold text-lg">

                            <button type="button" id="increaseQty" aria-label="Increase quantity" class="w-11 h-11 rounded-xl bg-efarmer-600 text-white hover:bg-efarmer-700 transition flex items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>
                    </label>

                    <div class="mt-6 rounded-2xl bg-efarmer-50/70 border border-efarmer-100 p-5 space-y-2.5 text-sm">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Goat price (each)</span>
                            <span class="font-bold text-efarmer-900">KSh {{ number_format($goat->selling_price) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Quantity</span>
                            <span class="font-bold text-efarmer-900" id="qtyDisplay">1</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-bold text-efarmer-900" id="subtotalDisplay">KSh {{ number_format($goat->selling_price) }}</span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-500">Transport (<span id="transportQty">1</span> × KSh {{ number_format(config('mpesa.transport_fee_per_goat', 300)) }})</span>
                            <span class="font-bold text-efarmer-900" id="transportDisplay">KSh {{ number_format(config('mpesa.transport_fee_per_goat', 300)) }}</span>
                        </div>

                        <div class="border-t border-efarmer-100 pt-3 flex justify-between items-center">
                            <span class="font-bold text-efarmer-900">Total</span>
                            <span class="font-display font-extrabold text-xl text-efarmer-800" id="totalDisplay">KSh {{ number_format($goat->selling_price + config('mpesa.transport_fee_per_goat', 300)) }}</span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- BUYER + PAYMENT -->

            <div class="lg:col-span-3 card-soft p-7 lg:p-9">

                <h2 class="font-display text-2xl font-extrabold text-efarmer-900">
                    Your details
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    We send the M-Pesa prompt to the number below and your receipt to your email.
                </p>

                <div class="grid sm:grid-cols-2 gap-5 mt-7">

                    <label class="block">
                        <span class="field-label">Full name <span class="text-red-500">*</span></span>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Jane Wanjiku">
                        @error('name')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                    <label class="block">
                        <span class="field-label">M-Pesa phone <span class="text-red-500">*</span></span>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="0712 000 000">
                        @error('phone')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                    <label class="block sm:col-span-2">
                        <span class="field-label">Email for your receipt <span class="text-red-500">*</span></span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="jane@example.com">
                        @error('email')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                    <label class="block">
                        <span class="field-label">Delivery address <span class="text-red-500">*</span></span>
                        <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" required placeholder="e.g. Nakuru">
                        @error('delivery_address')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                    <label class="block">
                        <span class="field-label">Delivery town <span class="text-red-500">*</span></span>
                        <input type="text" name="delivery_town" value="{{ old('delivery_town') }}" required placeholder="e.g. Nakuru Town">
                        @error('delivery_town')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                    <label class="block sm:col-span-2">
                        <span class="field-label">Delivery notes <span class="text-gray-400 font-medium">(optional)</span></span>
                        <input type="text" name="delivery_notes" value="{{ old('delivery_notes') }}" placeholder="Landmark, gate directions, best time to call…">
                        @error('delivery_notes')<p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>@enderror
                    </label>

                </div>

                <div class="mt-8 rounded-2xl bg-clay-50 border border-clay-200 p-5 flex items-start gap-4">

                    <span class="w-11 h-11 rounded-xl bg-white text-clay-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                        <i class="fa-solid fa-mobile-screen-button text-lg"></i>
                    </span>

                    <div class="text-sm">
                        <p class="font-bold text-clay-800">How M-Pesa checkout works</p>
                        <p class="text-clay-700/80 mt-1 leading-6">
                            Tap pay and approve the prompt on your phone with your M-Pesa PIN.
                            You get an instant receipt and our team schedules delivery.
                        </p>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary btn-lg w-full mt-8">
                    <i class="fa-solid fa-mobile-screen"></i>
                    <span id="payButtonText">Pay KSh {{ number_format($goat->selling_price + config('mpesa.transport_fee_per_goat', 300)) }} with M-Pesa</span>
                </button>


                <p class="text-center text-xs text-gray-400 mt-4">
                    <i class="fa-solid fa-lock"></i>
                    Secured checkout · Instant M-Pesa receipt · Delivery arranged after payment
                </p>

            </div>

        </form>

    </div>

</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var goatPrice = {{ $goat->selling_price }};
        var transportFeePerGoat = {{ config('mpesa.transport_fee_per_goat', 300) }};
        var maxQuantity = 10;

        var quantityInput = document.getElementById('quantity');
        var decreaseBtn = document.getElementById('decreaseQty');
        var increaseBtn = document.getElementById('increaseQty');
        var qtyDisplay = document.getElementById('qtyDisplay');
        var subtotalDisplay = document.getElementById('subtotalDisplay');
        var transportQty = document.getElementById('transportQty');
        var transportDisplay = document.getElementById('transportDisplay');
        var totalDisplay = document.getElementById('totalDisplay');
        var payButtonText = document.getElementById('payButtonText');

        function formatCurrency(amount) {
            return 'KSh ' + amount.toLocaleString('en-KE');
        }

        function updateDisplay() {
            var qty = parseInt(quantityInput.value);
            var subtotal = goatPrice * qty;
            var transportFee = transportFeePerGoat * qty;
            var total = subtotal + transportFee;

            qtyDisplay.textContent = qty;
            subtotalDisplay.textContent = formatCurrency(subtotal);
            transportQty.textContent = qty;
            transportDisplay.textContent = formatCurrency(transportFee);
            totalDisplay.textContent = formatCurrency(total);
            payButtonText.textContent = 'Pay ' + formatCurrency(total) + ' with M-Pesa';
        }

        decreaseBtn.addEventListener('click', function() {
            var qty = parseInt(quantityInput.value);
            if (qty > 1) { quantityInput.value = qty - 1; updateDisplay(); }
        });

        increaseBtn.addEventListener('click', function() {
            var qty = parseInt(quantityInput.value);
            if (qty < maxQuantity) { quantityInput.value = qty + 1; updateDisplay(); }
        });

        updateDisplay();
    });
</script>
@endpush

