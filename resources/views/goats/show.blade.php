@extends('layouts.app')

@section('title', ($goat->name ?? $goat->tag_number) . ' | Goat for sale on Efarmer')
@section('description', $goat->description ?? 'View photos, health records and price for this goat on Efarmer.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
    $placeholder = $img('WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg');

    $mainPhoto = $goat->primary_photo
        ? asset('storage/' . $goat->primary_photo->path)
        : $placeholder;

    $title = $goat->name ?? $goat->tag_number;
@endphp

@section('meta')
    <meta property="og:title" content="{{ $title }} | Efarmer">
    <meta property="og:description" content="KSh {{ number_format($goat->selling_price) }} — {{ $goat->breed->name ?? 'Goat' }} in {{ $goat->location ?? 'Kenya' }}.">
    <meta property="og:image" content="{{ $mainPhoto }}">
@endsection

@section('content')

<section class="py-8 lg:py-12">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <!-- BREADCRUMB -->

        <nav class="flex flex-wrap items-center gap-2 text-xs text-gray-400 font-semibold mb-6">

            <a href="{{ route('home') }}" class="hover:text-efarmer-700 transition">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <a href="{{ route('goats.index') }}" class="hover:text-efarmer-700 transition">Goats for sale</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-gray-600">{{ $title }}</span>

        </nav>

        <div class="grid lg:grid-cols-12 gap-8 lg:gap-10">

            <!-- GALLERY -->

            <div class="lg:col-span-7">

                <div class="card-soft overflow-hidden">

                    <div class="relative">
                        <img
                            id="mainPhoto"
                            src="{{ $mainPhoto }}"
                            alt="{{ $title }}"
                            class="w-full h-[320px] sm:h-[440px] lg:h-[520px] object-cover"
                        >

                        <span class="absolute top-4 left-4 rounded-full bg-efarmer-600/95 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                            {{ ucfirst($goat->status) }}
                        </span>

                        @if($goat->featured)
                            <span class="absolute top-4 right-4 rounded-full bg-clay-500/95 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                                <i class="fa-solid fa-star"></i> Featured
                            </span>
                        @endif
                    </div>

                </div>

                @if($goat->photos->count() > 1)

                    <div class="flex gap-3 mt-4 overflow-x-auto pb-1">

                        @foreach($goat->photos as $photo)

                            <button
                                type="button"
                                class="photo-thumb w-20 h-20 rounded-2xl overflow-hidden border-2 border-transparent hover:border-efarmer-500 transition flex-shrink-0"
                                data-src="{{ asset('storage/'.$photo->path) }}"
                                aria-label="View photo {{ $loop->iteration }}"
                            >
                                <img
                                    src="{{ asset('storage/'.$photo->path) }}"
                                    alt="{{ $title }} photo {{ $loop->iteration }}"
                                    class="w-full h-full object-cover"
                                >
                            </button>

                        @endforeach

                    </div>

                @endif


                <!-- DESCRIPTION -->

                <div class="card-soft p-7 mt-8">

                    <h2 class="font-display text-xl font-extrabold text-efarmer-900">
                        About this goat
                    </h2>

                    <p class="text-gray-600 mt-4 leading-8">
                        {{ $goat->description ?: 'This goat is listed on Efarmer with verified details. Contact us for more information about temperament, feeding history and delivery arrangements.' }}
                    </p>

                </div>

                @if($goat->healthRecords->count())

                    <div class="card-soft p-7 mt-6" data-reveal>

                        <h2 class="font-display text-xl font-extrabold text-efarmer-900 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-efarmer-100 text-efarmer-700 flex items-center justify-center">
                                <i class="fa-solid fa-notes-medical"></i>
                            </span>
                            Health records
                        </h2>

                        <div class="mt-5 space-y-4">

                            @foreach($goat->healthRecords as $record)

                                <div class="flex flex-wrap items-start justify-between gap-3 rounded-2xl bg-gray-50 p-4">

                                    <div>
                                        <p class="font-bold text-efarmer-900">
                                            {{ $record->title ?? ucfirst($record->record_type) }}
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $record->description }}
                                        </p>

                                        @if($record->veterinarian)
                                            <p class="text-xs text-gray-400 mt-1">
                                                <i class="fa-solid fa-user-doctor"></i> {{ $record->veterinarian }}
                                            </p>
                                        @endif
                                    </div>

                                    <span class="chip">
                                        {{ optional($record->record_date)->format('d M Y') }}
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

                @if($goat->weightRecords->count())

                    <div class="card-soft p-7 mt-6" data-reveal>

                        <h2 class="font-display text-xl font-extrabold text-efarmer-900 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-clay-100 text-clay-600 flex items-center justify-center">
                                <i class="fa-solid fa-weight-scale"></i>
                            </span>
                            Weight history
                        </h2>

                        <div class="flex flex-wrap gap-3 mt-5">

                            @foreach($goat->weightRecords as $record)

                                <div class="rounded-2xl border border-efarmer-100 px-4 py-3 text-center">
                                    <p class="font-display font-extrabold text-efarmer-800">
                                        {{ $record->weight }} kg
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ optional($record->recorded_at)->format('d M Y') }}
                                    </p>
                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            </div>
            <!-- ============================================= -->
            <!-- DETAILS -->
            <!-- ============================================= -->

            <div class="lg:col-span-5">

                <div class="card-soft p-7 lg:sticky lg:top-24">

                    <div class="flex flex-wrap items-center gap-2">

                        <span class="chip">
                            <i class="fa-solid fa-dna"></i>
                            {{ $goat->breed->name ?? 'Unknown breed' }}
                        </span>

                        <span class="chip chip-accent">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $goat->location ?? 'Kenya' }}
                        </span>

                        @if($goat->category)
                            <span class="chip">
                                <i class="fa-solid fa-tag"></i> {{ $goat->category }}
                            </span>
                        @endif

                    </div>

                    <h1 class="font-display text-3xl font-extrabold text-efarmer-900 mt-5 leading-tight">
                        {{ $title }}
                    </h1>

                    <div class="flex flex-wrap items-end gap-3 mt-5">

                        <span class="font-display text-4xl font-extrabold text-efarmer-800">
                            KSh {{ number_format($goat->selling_price) }}
                        </span>

                        <span class="text-sm text-gray-400 mb-1.5">Tag: {{ $goat->tag_number }}</span>

                    </div>

                    <!-- SPECS -->

                    <div class="grid grid-cols-2 gap-3 mt-7">

                        @foreach([
                            ['label' => 'Gender', 'value' => ucfirst($goat->gender), 'icon' => 'fa-venus-mars'],
                            ['label' => 'Weight', 'value' => $goat->weight ? $goat->weight.' kg' : 'Not stated', 'icon' => 'fa-weight-hanging'],
                            ['label' => 'Colour', 'value' => $goat->color ?: 'Not stated', 'icon' => 'fa-palette'],
                            ['label' => 'Date of birth', 'value' => $goat->date_of_birth ? $goat->date_of_birth->format('M Y') : 'Not stated', 'icon' => 'fa-cake-candles'],
                        ] as $spec)

                            <div class="rounded-2xl border border-efarmer-100 p-4">

                                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-bold flex items-center gap-2">
                                    <i class="fa-solid {{ $spec['icon'] }} text-clay-500"></i>
                                    {{ $spec['label'] }}
                                </p>

                                <p class="font-bold text-efarmer-900 mt-1.5">
                                    {{ $spec['value'] }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                    <!-- CTA -->

                    @if($goat->status === 'available')

                        <a href="{{ route('checkout', $goat) }}" class="btn btn-primary btn-lg w-full mt-7">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Buy now — pay with M-Pesa
                        </a>

                    @else

                        <div class="mt-7 rounded-2xl bg-gray-100 text-gray-600 py-4 text-center font-bold">
                            <i class="fa-solid fa-circle-info"></i>
                            This goat is {{ $goat->status }}
                        </div>

                    @endif

                    <div class="grid grid-cols-2 gap-3 mt-3">

                        <a href="tel:+254712345678" class="btn btn-outline">
                            <i class="fa-solid fa-phone"></i>
                            Call us
                        </a>

                        <a href="https://wa.me/254712345678" class="btn btn-outline">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            WhatsApp
                        </a>

                    </div>

                    <!-- TRUST -->

                    <div class="mt-7 pt-6 border-t border-efarmer-50 space-y-3 text-sm text-gray-500">

                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-shield-halved text-efarmer-500"></i>
                            Verified goat with full health records
                        </p>

                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-mobile-screen text-efarmer-500"></i>
                            Secure M-Pesa payment on checkout
                        </p>

                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-truck-fast text-efarmer-500"></i>
                            Countrywide delivery arranged for you
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- ============================================= -->
        <!-- RELATED GOATS -->
        <!-- ============================================= -->

        @if($relatedGoats->count())

            <div class="mt-16">

                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-8">

                    <div>
                        <span class="eyebrow">You may also like</span>

                        <h2 class="font-display text-2xl md:text-3xl font-extrabold text-efarmer-900 mt-3">
                            Similar goats
                        </h2>
                    </div>

                    <a href="{{ route('goats.index') }}" class="btn btn-outline">
                        Browse marketplace
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach($relatedGoats as $related)

                        {{-- Entire card links to the listing --}}
                        <a
                            href="{{ route('goats.show', $related) }}"
                            class="group card-soft zoom lift overflow-hidden flex flex-col"
                            data-reveal
                        >

                            <div class="relative h-48 overflow-hidden">

                                @if($related->primary_photo)
                                    <img
                                        src="{{ asset('storage/'.$related->primary_photo->path) }}"
                                        alt="{{ $related->name ?? $related->tag_number }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <img
                                        src="{{ $placeholder }}"
                                        alt="{{ $related->name ?? $related->tag_number }}"
                                        class="w-full h-full object-cover"
                                    >
                                @endif

                                <span class="absolute top-3 left-3 rounded-full bg-efarmer-600/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                                    For sale
                                </span>

                            </div>

                            <div class="p-5 flex flex-col flex-1">

                                <h3 class="font-bold text-efarmer-900 leading-snug">
                                    {{ $related->name ?? $related->tag_number }}
                                </h3>

                                <p class="text-xs text-gray-500 mt-1.5">
                                    {{ $related->breed->name ?? 'Unknown breed' }}
                                    &middot;
                                    {{ $related->location ?? 'Kenya' }}
                                </p>

                                <div class="mt-auto pt-4 flex items-center justify-between">

                                    <span class="font-display font-extrabold text-efarmer-800">
                                        KSh {{ number_format($related->selling_price) }}
                                    </span>

                                    <span class="w-8 h-8 rounded-full bg-efarmer-50 text-efarmer-700 flex items-center justify-center transition group-hover:bg-efarmer-600 group-hover:text-white">
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </span>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</section>

<!-- ========================================================= -->
<!-- MOBILE STICKY BUY BAR -->
<!-- ========================================================= -->

@if($goat->status === 'available')

    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-efarmer-100 shadow-card px-5 py-3">

        <div class="flex items-center gap-4">

            <div class="flex-1">
                <p class="text-[11px] uppercase tracking-wider text-gray-400 font-bold">Price</p>
                <p class="font-display font-extrabold text-efarmer-800">KSh {{ number_format($goat->selling_price) }}</p>
            </div>

            <a href="{{ route('checkout', $goat) }}" class="btn btn-primary flex-1">
                <i class="fa-solid fa-cart-shopping"></i>
                Buy now
            </a>

        </div>

    </div>

@endif

@push('styles')
<style>
    /* Keep the back-to-top button clear of the mobile buy bar */
    @media (max-width: 1023px) {
        #toTop { bottom: 6rem; }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var main = document.getElementById('mainPhoto');
        var thumbs = document.querySelectorAll('.photo-thumb');

        if (! main || ! thumbs.length) return;

        thumbs.forEach(function (thumb) {
            thumb.addEventListener('click', function () {
                main.src = thumb.dataset.src;

                thumbs.forEach(function (item) {
                    item.classList.remove('border-efarmer-500');
                    item.classList.add('border-transparent');
                });

                thumb.classList.remove('border-transparent');
                thumb.classList.add('border-efarmer-500');
            });
        });
    });
</script>
@endpush

@endsection
