@extends('layouts.app')

@section('title', 'Create Account | Efarmer')
@section('description', 'Join Efarmer to buy goats, sell your herd and get delivery across Kenya.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
@endphp

@section('content')

<section class="min-h-[calc(100vh-77px)] grid lg:grid-cols-2">

    <!-- VISUAL PANEL -->

    <div class="relative hidden lg:block overflow-hidden">

        <img
            src="{{ $img('WhatsApp Image 2026-08-27 at 13.12.15.jpeg') }}"
            alt="Farmers herding goats to market"
            class="absolute inset-0 w-full h-full object-cover"
        >

        <div class="absolute inset-0 hero-overlay"></div>

        <div class="absolute inset-x-0 bottom-0 p-14 text-white">

            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-clay-300">
                <i class="fa-solid fa-handshake"></i>
                Free to join
            </span>

            <h2 class="font-display text-4xl font-extrabold mt-5 leading-tight">
                Buy goats. Sell goats.<br>Grow your farm.
            </h2>

            <div class="mt-6 space-y-3 text-white/80 text-sm">

                <p class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-clay-400"></i>
                    Verified listings with photos and records
                </p>

                <p class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-clay-400"></i>
                    Secure M-Pesa payments and instant receipts
                </p>

                <p class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-clay-400"></i>
                    Delivery arranged across all 47 counties
                </p>

            </div>

        </div>

    </div>

    <!-- FORM PANEL -->

    <div class="flex items-center justify-center px-5 py-14">

        <div class="w-full max-w-lg">

            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="Efarmer" class="h-14 w-auto object-contain">
            </a>

            <h1 class="font-display text-3xl font-extrabold text-efarmer-900 mt-7">
                Create your account
            </h1>

            <p class="text-gray-500 mt-2">
                Takes less than a minute — no fees to join.
            </p>

            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 space-y-1.5">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST" class="mt-8 grid sm:grid-cols-2 gap-5">
                @csrf

                <label class="block">
                    <span class="field-label">First name</span>
                    <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required autofocus placeholder="Jane">
                </label>

                <label class="block">
                    <span class="field-label">Last name</span>
                    <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required placeholder="Wanjiku">
                </label>

                <label class="block sm:col-span-2">
                    <span class="field-label">Email address</span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="you@example.com">
                </label>

                <label class="block">
                    <span class="field-label">Phone number</span>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required placeholder="0712 000 000">
                </label>

                <label class="block">
                    <span class="field-label">National ID <span class="text-gray-400 font-medium">(optional)</span></span>
                    <input id="national_id" name="national_id" type="text" value="{{ old('national_id') }}" placeholder="12345678">
                </label>

                <label class="block">
                    <span class="field-label">Password</span>
                    <input id="password" name="password" type="password" required placeholder="Min 8 characters">
                </label>

                <label class="block">
                    <span class="field-label">Confirm password</span>
                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Repeat password">
                </label>

                <div class="sm:col-span-2">
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        <i class="fa-solid fa-user-plus"></i>
                        Create account
                    </button>
                </div>

            </form>

            <p class="text-center text-gray-500 mt-8">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-efarmer-700 hover:text-clay-600">
                    Login
                </a>
            </p>

        </div>

    </div>

</section>

@endsection
