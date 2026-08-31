@extends('layouts.app')

@section('title', 'Checkout | Efarmer')
@section('description', 'Complete your purchase')

@section('content')

<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-5">

        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

            <form action="{{ route('payment.initiate') }}" method="POST" class="grid md:grid-cols-2">
                @csrf
                <input type="hidden" name="goat_id" value="{{ $goat->id }}">

                <!-- Left: Goat Image & Summary -->
                <div class="bg-green-50 p-6 flex flex-col">
                    <h2 class="text-xl font-extrabold text-green-900 mb-4">Complete Your Purchase</h2>

                    <div class="flex-1 flex flex-col justify-center">
                        @if($goat->primary_photo)
                            <img src="{{ asset('storage/'.$goat->primary_photo->path) }}" class="w-full h-64 object-cover rounded-xl shadow-md mb-4" alt="{{ $goat->name ?? $goat->tag_number }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=800&q=80" class="w-full h-64 object-cover rounded-xl shadow-md mb-4" alt="{{ $goat->name ?? $goat->tag_number }}">
                        @endif

                        <h3 class="font-bold text-xl text-gray-900">{{ $goat->name ?? $goat->tag_number }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $goat->breed->name ?? 'Unknown' }} &middot; {{ ucfirst($goat->gender) }} &middot; {{ $goat->weight ? $goat->weight . 'kg' : '' }}</p>
                        <p class="text-gray-500 text-sm"><i class="fa-solid fa-location-dot text-efarmer-600"></i> {{ $goat->location ?? 'Kenya' }}</p>

                        <div class="mt-4 bg-white rounded-xl p-4 border">
                            <div class="flex justify-between text-sm">
                                <span>Goat Price:</span>
                                <span class="font-semibold">KSh {{ number_format($goat->selling_price) }}</span>
                            </div>
                            <div class="flex justify-between text-sm mt-1">
                                <span>Transport Fee:</span>
                                <span class="font-semibold">KSh 1</span>
                            </div>
                            <div class="border-t mt-2 pt-2 flex justify-between">
                                <span class="font-bold">Total:</span>
                                <span class="text-xl font-extrabold text-green-700">KSh {{ number_format($goat->selling_price + 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Payment & Delivery Form -->
                <div class="p-6 space-y-4">

                    <div>
                        <label class="block font-semibold mb-1">Your Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full border rounded-lg px-4 py-2.5" placeholder="John Doe">
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Phone Number (M-Pesa) <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" required class="w-full border rounded-lg px-4 py-2.5" placeholder="0712345678">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Email (Optional)</label>
                        <input type="email" name="email" class="w-full border rounded-lg px-4 py-2.5" placeholder="john@example.com">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Delivery Address -->
                    <div class="border-t pt-4">
                        <h3 class="font-bold text-base mb-3">
                            <i class="fa-solid fa-truck text-efarmer-600 mr-1"></i>Delivery Details
                        </h3>

                        <div class="space-y-3">
                            <div>
                                <label class="block font-semibold mb-1">Delivery Address <span class="text-red-500">*</span></label>
                                <textarea name="delivery_address" required rows="2" class="w-full border rounded-lg px-4 py-2.5 text-sm" placeholder="Farm name, street, landmark"></textarea>
                                @error('delivery_address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block font-semibold mb-1">County/Town <span class="text-red-500">*</span></label>
                                    <input type="text" name="delivery_town" required class="w-full border rounded-lg px-4 py-2.5 text-sm" placeholder="e.g. Nakuru">
                                    @error('delivery_town')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block font-semibold mb-1">Notes</label>
                                    <input type="text" name="delivery_notes" class="w-full border rounded-lg px-4 py-2.5 text-sm" placeholder="Optional">
                                    @error('delivery_notes')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-xl font-bold text-lg transition">
                        <i class="fa-solid fa-mobile-screen mr-2"></i>
                        Pay KSh {{ number_format($goat->selling_price + 1) }} with M-Pesa
                    </button>

                    <p class="text-center text-xs text-gray-500">
                        You will receive an STK push on your phone to complete payment.
                    </p>

                </div>
            </form>

        </div>

    </div>
</section>

@endsection