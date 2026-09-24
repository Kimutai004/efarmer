@extends('layouts.app')

@section('title', 'About Efarmer | Kenya\'s Goat Marketplace')
@section('description', 'Efarmer connects Kenyan goat farmers directly with buyers — fair prices, verified livestock and reliable delivery.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
@endphp

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'About Efarmer',
    'title' => 'Empowering farmers through technology',
    'subtitle' => 'We are building the simplest way for Kenyan farmers to sell goats and for buyers to find healthy, fairly priced livestock.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg',
    'crumb' => 'About',
])

<!-- STORY -->

<section class="py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div class="zoom rounded-4xl overflow-hidden h-[420px] order-2 lg:order-1">
                <img
                    src="{{ $img('WhatsApp Image 2026-08-27 at 13.12.15.jpeg') }}"
                    alt="Goat herd in Kenya"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="order-1 lg:order-2">

                <span class="eyebrow">Our story</span>

                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-efarmer-900 mt-3 leading-tight">
                    Connecting farmers and buyers, county to county
                </h2>

                <div class="divider-line mt-5"></div>

                <p class="text-gray-600 leading-8 mt-6">
                    Selling livestock has always depended on market days, long journeys
                    and middlemen. Buyers, meanwhile, struggle to know whether an animal
                    is healthy, the right weight or the right price.
                </p>

                <p class="text-gray-600 leading-8 mt-4">
                    Efarmer changes that. Every goat we sell carries a real
                    record — breed, age, weight, photos and health documents — and every
                    transaction settles securely through M-Pesa, so buyers know exactly
                    what they are getting.
                </p>

                <div class="grid grid-cols-3 gap-4 mt-9">

                    @foreach([
                        ['value' => '1,000+', 'label' => 'Farmers'],
                        ['value' => '5,000+', 'label' => 'Goats listed'],
                        ['value' => '47', 'label' => 'Counties'],
                    ] as $stat)

                        <div class="rounded-2xl bg-efarmer-50 p-5 text-center">

                            <p class="font-display text-2xl font-extrabold text-efarmer-700">
                                {{ $stat['value'] }}
                            </p>

                            <p class="text-xs uppercase tracking-wider text-gray-500 mt-1 font-bold">
                                {{ $stat['label'] }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>

<!-- VALUES -->

<section class="pb-16">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-12">

            <span class="eyebrow justify-center">What we stand for</span>

            <h2 class="font-display text-3xl font-extrabold text-efarmer-900 mt-3">
                Built on trust and transparency
            </h2>

        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach([
                ['icon' => 'fa-shield-halved', 'title' => 'Verified goats', 'text' => 'Every goat is inspected and vet-checked before it goes live.'],
                ['icon' => 'fa-scale-balanced', 'title' => 'Fair pricing', 'text' => 'Fixed, fair prices with full weight and health records on every goat.'],
                ['icon' => 'fa-mobile-screen', 'title' => 'Secure payments', 'text' => 'Every order settles through M-Pesa with a digital receipt.'],
                ['icon' => 'fa-seedling', 'title' => 'Quality first', 'text' => 'Healthy, documented goats delivered safely to farms across Kenya.'],
            ] as $value)

                <div class="card-soft lift p-7" data-reveal>

                    <span class="w-12 h-12 rounded-2xl bg-clay-50 text-clay-600 flex items-center justify-center text-lg">
                        <i class="fa-solid {{ $value['icon'] }}"></i>
                    </span>

                    <h3 class="font-bold text-efarmer-900 mt-5">
                        {{ $value['title'] }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-7">
                        {{ $value['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- CTA -->

<section class="pb-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="relative overflow-hidden rounded-4xl bg-efarmer-900 text-white p-10 sm:p-14 text-center">

            <div class="absolute inset-0 noise-dots opacity-25"></div>

            <div class="relative max-w-2xl mx-auto">

                <h2 class="font-display text-3xl font-extrabold">
                    Join the marketplace
                </h2>

                <p class="text-white/70 mt-4 leading-7">
                    Whether you are buying your first goat or selling your tenth,
                    Efarmer makes the process simple.
                </p>

                <div class="flex flex-wrap justify-center gap-4 mt-8">

                    <a href="{{ route('goats.index') }}" class="btn btn-lg btn-accent">
                        <i class="fa-solid fa-cow"></i>
                        Browse goats
                    </a>

                    <a href="{{ route('contact') }}" class="btn btn-lg btn-white">
                        Talk to us
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection

