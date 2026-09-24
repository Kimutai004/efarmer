@extends('layouts.app')

@section('title', 'Shipping & Delivery | How Your Goat Gets to You')
@section('description', 'How Efarmer delivers goats safely across Kenya — confirmation, transport and handover.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'All 47 counties',
    'title' => 'Shipping & Delivery',
    'subtitle' => 'Safe, scheduled livestock transport — confirmed with you at every step.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg',
    'crumb' => 'Delivery',
])

<section class="py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid md:grid-cols-3 gap-6">

            @foreach([
                ['icon' => 'fa-location-dot', 'title' => 'Delivery location', 'text' => 'After payment we agree a delivery point with you — your farm, market or the nearest accessible town.'],
                ['icon' => 'fa-truck-fast', 'title' => 'Suitable transport', 'text' => 'Goats travel in proper livestock vehicles with water and rest stops on long routes.'],
                ['icon' => 'fa-heart-pulse', 'title' => 'Safe handover', 'text' => 'Animals are checked on arrival before handover. Report any issue immediately for support.'],
            ] as $card)

                <div class="card-soft lift p-8" data-reveal>

                    <span class="w-12 h-12 rounded-2xl bg-efarmer-100 text-efarmer-700 flex items-center justify-center text-xl">
                        <i class="fa-solid {{ $card['icon'] }}"></i>
                    </span>

                    <h2 class="font-display text-xl font-extrabold text-efarmer-900 mt-5">
                        {{ $card['title'] }}
                    </h2>

                    <p class="text-gray-500 mt-3 leading-7 text-sm">
                        {{ $card['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

        <div class="card-soft p-8 lg:p-10 mt-10">

            <h2 class="font-display text-2xl font-extrabold text-efarmer-900">
                Your delivery timeline
            </h2>

            @foreach([
                ['day' => 'Day 0', 'title' => 'Payment confirmed', 'text' => 'Your order and M-Pesa receipt are recorded. The goat is reserved for you.'],
                ['day' => 'Day 1', 'title' => 'Delivery scheduled', 'text' => 'Our team confirms the route, date and drop-off point with you and the seller.'],
                ['day' => 'Day 2–4', 'title' => 'Transport & handover', 'text' => 'The goat travels safely and is handed over after an arrival check.'],
            ] as $step)

                <div class="flex gap-5 mt-7">

                    <div class="flex flex-col items-center">

                        <span class="w-11 h-11 rounded-full bg-clay-500 text-white flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        @if(!$loop->last)
                            <span class="w-0.5 flex-1 bg-clay-200 my-1"></span>
                        @endif

                    </div>

                    <div class="pb-2">

                        <p class="text-xs font-bold uppercase tracking-wider text-clay-600">{{ $step['day'] }}</p>

                        <h3 class="font-bold text-efarmer-900 mt-1">{{ $step['title'] }}</h3>

                        <p class="text-sm text-gray-500 mt-1 leading-7">{{ $step['text'] }}</p>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="mt-10 flex flex-wrap gap-4">

            <a href="{{ route('goats.index') }}" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-cow"></i>
                Order a goat
            </a>

            <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">
                <i class="fa-solid fa-headset"></i>
                Ask about your delivery
            </a>

        </div>

    </div>

</section>

@endsection
