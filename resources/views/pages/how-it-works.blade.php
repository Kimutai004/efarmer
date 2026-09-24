@extends('layouts.app')

@section('title', 'How Efarmer Works | Buy & Sell Goats in 4 Simple Steps')
@section('description', 'See how Efarmer connects goat farmers and buyers across Kenya — search, confirm, pay with M-Pesa and get delivery.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
@endphp

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'Simple & transparent',
    'title' => 'How Efarmer Works',
    'subtitle' => 'Four straightforward steps take you from browsing goats to receiving healthy livestock at your farm.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg',
    'crumb' => 'How it works',
])

<!-- STEPS -->

<section class="py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach([
                ['icon' => 'fa-magnifying-glass', 'title' => 'Search listings', 'text' => 'Browse goats by breed, county, gender, weight and price. Every listing shows photos, records and the farmer behind it.'],
                ['icon' => 'fa-comments', 'title' => 'Confirm your choice', 'text' => 'Review the health and weight records, then talk to our team about the goat, delivery and timing.'],
                ['icon' => 'fa-mobile-screen-button', 'title' => 'Pay with M-Pesa', 'text' => 'Checkout sends a secure M-Pesa prompt to your phone. You get an instant digital receipt.'],
                ['icon' => 'fa-truck-fast', 'title' => 'Receive delivery', 'text' => 'We arrange safe livestock transport to your farm or the nearest town and keep you updated.'],
            ] as $index => $step)

                <div class="card-soft lift p-7 relative" data-reveal>

                    <span class="absolute -top-4 right-6 font-display text-5xl font-extrabold text-efarmer-100">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <span class="w-14 h-14 rounded-2xl bg-efarmer-600 text-white flex items-center justify-center text-xl relative">
                        <i class="fa-solid {{ $step['icon'] }}"></i>
                    </span>

                    <h2 class="font-display font-bold text-lg text-efarmer-900 mt-6">
                        {{ $step['title'] }}
                    </h2>

                    <p class="text-gray-500 mt-3 leading-7 text-sm">
                        {{ $step['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>
<!-- WHAT YOU GET / WHY BUY FROM EFARMER -->

<section class="pb-16">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-6">

            <div class="card-soft p-8 lg:p-10">

                <span class="w-12 h-12 rounded-2xl bg-efarmer-100 text-efarmer-700 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-people-group"></i>
                </span>

                <h2 class="font-display text-2xl font-extrabold text-efarmer-900 mt-5">
                    For buyers
                </h2>

                <ul class="mt-5 space-y-3 text-gray-600">

                    @foreach([
                        'Verified goat listings with photos and health records',
                        'Filter by breed, county, gender, weight and budget',
                        'Secure M-Pesa checkout and instant receipts',
                        'Delivery arranged after every confirmed order',
                    ] as $item)

                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-circle-check text-efarmer-500 mt-1"></i>
                            {{ $item }}
                        </li>

                    @endforeach

                </ul>

                <a href="{{ route('goats.index') }}" class="btn btn-primary mt-7">
                    <i class="fa-solid fa-cow"></i>
                    Browse goats
                </a>

            </div>

            <div class="relative overflow-hidden rounded-3xl bg-efarmer-900 text-white p-8 lg:p-10">

                <div class="absolute inset-0 noise-dots opacity-25"></div>

                <div class="relative">

                    <span class="w-12 h-12 rounded-2xl bg-white/10 text-clay-300 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-medal"></i>
                    </span>

                    <h2 class="font-display text-2xl font-extrabold mt-5">
                        Why buy from Efarmer
                    </h2>

                    <ul class="mt-5 space-y-3 text-white/75">

                        @foreach([
                            'Every goat is vet-checked, weighed and photographed by our team',
                            'Health and vaccination records attached to every goat',
                            'Fair fixed prices — no auction bidding and no middlemen',
                            'Get delivered to your farm after every confirmed order',
                        ] as $item)

                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-clay-400 mt-1"></i>
                                {{ $item }}
                            </li>

                        @endforeach

                    </ul>

                    <a href="{{ route('contact') }}" class="btn btn-accent mt-7">
                        <i class="fa-solid fa-headset"></i>
                        Talk to our team
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- IMAGE BAND -->

<section class="pb-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid md:grid-cols-3 gap-4">

            @foreach([
                'WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg',
                'WhatsApp Image 2026-08-27 at 13.11.41.jpeg',
                'WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg',
            ] as $photo)

                <div class="zoom rounded-3xl overflow-hidden h-56">
                    <img src="{{ $img($photo) }}" alt="Goats listed on Efarmer" class="w-full h-full object-cover">
                </div>

            @endforeach

        </div>

    </div>

</section>


@endsection
