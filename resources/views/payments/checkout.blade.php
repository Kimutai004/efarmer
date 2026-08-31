@extends('layouts.app')

@section('title', 'Checkout | Efarmer')
@section('description', 'Complete your purchase')

@section('content')

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-5">

        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">

            <!-- Goat Summary -->
            <div class="p-6 bg-green-50 border-b">
                <h1 class="text-2xl font-extrabold text-green-900">Complete Your Purchase</h1>
                <p class="text-green-700 mt-1">You're about to buy this goat.</p>
            </div>

            <div class="p-6 border-b">
                <div class="flex gap-4">
                    @if($goat->primary_photo)
                        <img src="{{ asset('storage/'.$goat->primary_photo->path) }}" class="w-24 h-24 rounded-xl object-cover">
                    @else
                        <div class="w-24 h-24 rounded-xl bg-gray-100 flex items-center justify-center">
                            <i class="fa-solid fa-cow text-2xl text-gray-400"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-lg">{{ $goat->name ?? $goat->tag_number }}</h3>
                        <p class="text-gray-500 text-sm">{{ $goat->breed->name ?? 'Unknown' }} &middot; {{ ucfirst($goat->gender) }}</p>
                        <p class="text-2xl font-extrabold text-green-700 mt-2">KSh {{ number_format($goat->selling_price) }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('payment.initiate') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="goat_id" value="{{ $goat->id }}">

                <div>
                    <label class="block font-semibold mb-2">Your Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required class="w-full border rounded-lg px-4 py-3" placeholder="John Doe">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Phone Number (M-Pesa) <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" required class="w-full border rounded-lg px-4 py-3" placeholder="0712345678">
                    <p class="text-xs text-gray-500 mt-1">Enter the M-Pesa number to pay from.</p>
                    @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block font-semibold mb-2">Email (Optional)</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-4 py-3" placeholder="john@example.com">
                    @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="bg-green-50 rounded-xl p-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Total Amount:</span>
                        <span class="text-2xl font-extrabold text-green-700">KSh {{ number_format($goat->selling_price) }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white py-4 rounded-xl font-bold text-lg transition">
                    <i class="fa-solid fa-mobile-screen mr-2"></i>
                    Pay with M-Pesa
                </button>

                <p class="text-center text-sm text-gray-500">
                    You will receive an STK push on your phone to complete payment.
                </p>
            </form>

        </div>

    </div>
</section>

@endsection