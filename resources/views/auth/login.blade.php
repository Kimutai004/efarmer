@extends('layouts.app')

@section('title', 'Login | Efarmer')
@section('description', 'Login to your Efarmer account to manage orders, listings and payments.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
@endphp

@section('content')

<section class="min-h-[calc(100vh-77px)] grid lg:grid-cols-2">

    <!-- VISUAL PANEL -->

    <div class="relative hidden lg:block overflow-hidden">

        <img
            src="{{ $img('WhatsApp Image 2026-08-27 at 13.11.41.jpeg') }}"
            alt="Goats on an Efarmer partner farm"
            class="absolute inset-0 w-full h-full object-cover"
        >

        <div class="absolute inset-0 hero-overlay"></div>

        <div class="absolute inset-x-0 bottom-0 p-14 text-white">

            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-clay-300">
                <i class="fa-solid fa-cow"></i>
                Welcome back
            </span>

            <h2 class="font-display text-4xl font-extrabold mt-5 leading-tight">
                Your herd, your orders,<br>all in one place.
            </h2>

            <p class="text-white/70 mt-4 max-w-md leading-7">
                Track deliveries, manage listings and check receipts without leaving home.
            </p>

        </div>

    </div>

    <!-- FORM PANEL -->

    <div class="flex items-center justify-center px-5 py-14">

        <div class="w-full max-w-md">

            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('images/logo.png') }}" alt="Efarmer" class="h-14 w-auto object-contain">
            </a>

            <h1 class="font-display text-3xl font-extrabold text-efarmer-900 mt-7">
                Welcome back
            </h1>

            <p class="text-gray-500 mt-2">
                Login to continue to Efarmer.
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

            <form action="{{ route('login.submit') }}" method="POST" class="mt-8 space-y-5">
                @csrf

                <label class="block">
                    <span class="field-label">Email address</span>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                </label>

                <label class="block">
                    <span class="field-label">Password</span>
                    <input id="password" name="password" type="password" required placeholder="Your password">
                </label>

                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-gray-500">
                        <input type="checkbox" name="remember" value="1" class="!w-4 !h-4 accent-[#2c8748]">
                        Remember me
                    </label>

                    <a href="#" class="font-semibold text-efarmer-700 hover:text-efarmer-600">
                        Forgot password?
                    </a>

                </div>

                <button type="submit" class="btn btn-primary btn-lg w-full">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login
                </button>

            </form>

            <p class="text-center text-gray-500 mt-8">
                New to Efarmer?
                <a href="{{ route('register') }}" class="font-bold text-efarmer-700 hover:text-clay-600">
                    Create an account
                </a>
            </p>

            <a href="{{ route('home') }}" class="mt-8 flex items-center justify-center gap-2 text-sm font-semibold text-gray-400 hover:text-efarmer-700">
                <i class="fa-solid fa-arrow-left"></i>
                Back to the marketplace
            </a>

        </div>

    </div>

</section>

@endsection
