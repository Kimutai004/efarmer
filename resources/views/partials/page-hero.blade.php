@php
    /*
    |--------------------------------------------------------------------------
    | Shared inner-page hero
    |--------------------------------------------------------------------------
    | Usage:
    |   @include('partials.page-hero', [
    |       'eyebrow'  => 'About Efarmer',
    |       'title'    => 'Empowering farmers through technology',
    |       'subtitle' => 'Optional supporting line.',
    |       'image'    => 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg',
    |       'crumb'    => 'About',
    |   ])
    */
    $heroImage = isset($image)
        ? asset('images/' . str_replace(' ', '%20', $image))
        : asset('images/' . str_replace(' ', '%20', 'WhatsApp Image 2026-08-27 at 13.12.15.jpeg'));
@endphp

<section class="relative bg-efarmer-950 text-white overflow-hidden">

    <img
        src="{{ $heroImage }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover opacity-25"
    >

    <div class="absolute inset-0 bg-gradient-to-r from-efarmer-950 via-efarmer-950/90 to-efarmer-900/40"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 py-14 lg:py-20">

        <nav class="flex items-center gap-2 text-xs text-white/50 font-semibold">

            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>

            <i class="fa-solid fa-chevron-right text-[9px]"></i>

            <span class="text-white/80">{{ $crumb ?? ($title ?? 'Page') }}</span>

        </nav>

        <div class="max-w-3xl mt-7">

            @isset($eyebrow)
                <span class="eyebrow !text-clay-300">{{ $eyebrow }}</span>
            @endisset

            <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold mt-3 leading-tight">
                {{ $title ?? '' }}
            </h1>

            @isset($subtitle)
                <p class="text-white/70 mt-5 leading-8 text-lg">
                    {{ $subtitle }}
                </p>
            @endisset

        </div>

    </div>

</section>
