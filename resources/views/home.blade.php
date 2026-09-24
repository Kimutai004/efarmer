@extends('layouts.app')

@section('title', 'Efarmer | Buy Quality Goats in Kenya')
@section('description', 'Buy healthy goats in Kenya with full health and weight records. Fair prices, M-Pesa payments and countrywide delivery.')

@php
    /* Local image helper – the uploaded farm photos live in /public/images */
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));

    $heroGoats = $img('WhatsApp Image 2026-08-27 at 13.11.41.jpeg');
    $heroGoat = $img('WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg');
    $herdImage = $img('WhatsApp Image 2026-08-27 at 13.12.15.jpeg');
    $grazingImage = $img('WhatsApp Image 2026-08-27 at 13.12.19 (2).jpeg');

    $breeds = \App\Models\Breed::where('status', 'active')->orderBy('name')->get();
@endphp

@section('content')

<!-- ========================================================= -->
<!-- HERO -->
<!-- ========================================================= -->

<section class="relative bg-efarmer-950 text-white overflow-hidden">

    <img
        src="{{ $heroGoats }}"
        alt="Quality goats for sale in Kenya"
        class="absolute inset-0 w-full h-full object-cover opacity-60"
    >

    <div class="absolute inset-0 hero-overlay"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 pt-16 pb-32 lg:pt-24 lg:pb-40">

        <div class="grid lg:grid-cols-12 gap-14 items-center">

            <div class="lg:col-span-7">

                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur px-4 py-2 text-xs font-bold uppercase tracking-[0.18em] text-clay-300">
                    <i class="fa-solid fa-certificate"></i>
                    Kenya's goat marketplace
                </span>

                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] mt-6">
                    Buy healthy goats.<br>
                    <span class="text-clay-400">Delivered to you.</span>
                </h1>

                <p class="mt-6 text-lg text-white/75 max-w-xl leading-8">
                    Efarmer connects you directly with verified goat farmers across
                    Kenya. Browse by breed, weight and county, pay securely with
                    M-Pesa and get your livestock delivered.
                </p>

                <div class="flex flex-wrap gap-4 mt-9">

                    <a href="{{ route('goats.index') }}" class="btn btn-lg btn-accent">
                        <i class="fa-solid fa-cow"></i>
                        Browse Goats
                    </a>

                    <a href="{{ route('how-it-works') }}" class="btn btn-lg btn-white">
                        <i class="fa-solid fa-circle-question"></i>
                        How it works
                    </a>

                </div>

                <div class="grid grid-cols-3 gap-6 mt-12 max-w-lg">

                    <div>
                        <p class="font-display text-3xl font-extrabold text-white">1,000+</p>
                        <p class="text-xs uppercase tracking-wider text-white/50 mt-1">Farmers</p>
                    </div>

                    <div class="border-x border-white/10 px-6">
                        <p class="font-display text-3xl font-extrabold text-white">5,000+</p>
                        <p class="text-xs uppercase tracking-wider text-white/50 mt-1">Goats listed</p>
                    </div>

                    <div>
                        <p class="font-display text-3xl font-extrabold text-white">47</p>
                        <p class="text-xs uppercase tracking-wider text-white/50 mt-1">Counties</p>
                    </div>

                </div>

            </div>

            <div class="lg:col-span-5 hidden lg:block">

                <div class="relative">

                    <div class="rounded-4xl overflow-hidden border-4 border-white/10 shadow-card">
                        <img src="{{ $heroGoat }}" alt="A healthy goat listed on Efarmer" class="w-full h-[440px] object-cover">
                    </div>

                    <div class="absolute -left-8 bottom-10 card-soft p-4 w-56">
                        <div class="flex items-center gap-3">
                            <span class="w-11 h-11 rounded-2xl bg-efarmer-100 text-efarmer-700 flex items-center justify-center">
                                <i class="fa-solid fa-shield-heart text-lg"></i>
                            </span>

                            <div>
                                <p class="font-bold text-efarmer-900 text-sm">Health checked</p>
                                <p class="text-xs text-gray-500">Vet records included</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-6 top-8 card-soft px-5 py-3">
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">From</p>
                        <p class="font-display text-xl font-extrabold text-efarmer-800">KSh 8,500</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ========================================================= -->
<!-- SEARCH BAR -->
<!-- ========================================================= -->

<section class="relative -mt-20 z-10">

    <div class="max-w-6xl mx-auto px-5">

        <form
            action="{{ route('goats.index') }}"
            method="GET"
            class="card-soft p-4 lg:p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4"
        >

            <label>
                <span class="field-label">Breed</span>

                <select name="breed_id">
                    <option value="">All breeds</option>

                    @foreach($breeds as $breed)
                        <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                    @endforeach

                </select>
            </label>

            <label>
                <span class="field-label">County</span>

                <select name="location">
                    <option value="">All counties</option>
                    <option>Nairobi</option>
                    <option>Nakuru</option>
                    <option>Kiambu</option>
                    <option>Machakos</option>
                    <option>Nyeri</option>
                    <option>Kajiado</option>
                </select>
            </label>

            <label>
                <span class="field-label">Gender</span>

                <select name="gender">
                    <option value="">Any gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </label>

            <label>
                <span class="field-label">Budget</span>

                <select name="max_price">
                    <option value="">Any price</option>
                    <option value="10000">Up to KSh 10,000</option>
                    <option value="20000">Up to KSh 20,000</option>
                    <option value="50000">Up to KSh 50,000</option>
                    <option value="100000">Up to KSh 100,000</option>
                </select>
            </label>

            <div class="flex items-end">
                <button type="submit" class="btn btn-primary w-full h-[46px]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search Goats
                </button>
            </div>

        </form>

    </div>

</section>


<!-- ========================================================= -->
<!-- TRUST FEATURES -->
<!-- ========================================================= -->

<section class="pt-16 pb-8">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            @foreach([
                ['icon' => 'fa-shield-halved', 'title' => 'Verified goats', 'text' => 'Every goat is vetted before it goes live.'],
                ['icon' => 'fa-heart-pulse', 'title' => 'Healthy livestock', 'text' => 'Health and vaccination records on each goat.'],
                ['icon' => 'fa-mobile-screen', 'title' => 'M-Pesa payments', 'text' => 'Pay safely from your phone in seconds.'],
                ['icon' => 'fa-truck-fast', 'title' => 'Countrywide delivery', 'text' => 'Safe transport to any county in Kenya.'],
            ] as $feature)

                <div class="card-soft lift p-6 flex items-start gap-4" data-reveal>

                    <span class="w-12 h-12 rounded-2xl bg-efarmer-100 text-efarmer-700 flex items-center justify-center text-lg flex-shrink-0">
                        <i class="fa-solid {{ $feature['icon'] }}"></i>
                    </span>

                    <div>
                        <h3 class="font-bold text-efarmer-900">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-gray-500 mt-1.5 leading-6">{{ $feature['text'] }}</p>
                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- FEATURED GOATS -->
<!-- ========================================================= -->

<section class="py-16">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-10">

            <div>
                <span class="eyebrow">Handpicked listings</span>

                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-efarmer-900 mt-3">
                    Featured Goats
                </h2>

                <div class="divider-line mt-4"></div>
            </div>

            <a href="{{ route('goats.index') }}" class="btn btn-outline">
                View all goats
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse($featuredGoats as $goat)

                {{-- The whole card links to the goat details page --}}
                <a
                    href="{{ route('goats.show', $goat) }}"
                    class="group card-soft zoom lift overflow-hidden flex flex-col"
                    data-reveal
                >

                    <div class="relative h-56 overflow-hidden">

                        @if($goat->primary_photo)
                            <img
                                src="{{ asset('storage/'.$goat->primary_photo->path) }}"
                                alt="{{ $goat->name ?? $goat->tag_number }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <img
                                src="{{ $herdImage }}"
                                alt="{{ $goat->name ?? $goat->tag_number }}"
                                class="w-full h-full object-cover"
                            >
                        @endif

                        <span class="absolute top-3 left-3 rounded-full bg-efarmer-600/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                            For sale
                        </span>

                        @if($goat->featured)
                            <span class="absolute top-3 right-3 rounded-full bg-clay-500/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                                <i class="fa-solid fa-star"></i> Featured
                            </span>
                        @endif

                    </div>

                    <div class="p-5 flex flex-col flex-1">

                        <div class="flex items-start justify-between gap-3">

                            <h3 class="font-bold text-lg text-efarmer-900 leading-snug">
                                {{ $goat->name ?? $goat->tag_number }}
                            </h3>

                            @if($goat->breed)
                                <span class="chip whitespace-nowrap">{{ $goat->breed->name }}</span>
                            @endif

                        </div>

                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fa-solid fa-location-dot text-clay-500"></i>
                            {{ $goat->location ?? 'Kenya' }}
                        </p>

                        <div class="flex flex-wrap gap-2 mt-3 text-xs text-gray-500">

                            <span class="rounded-full bg-gray-50 border border-efarmer-100 px-2.5 py-1">
                                <i class="fa-solid fa-venus-mars"></i> {{ ucfirst($goat->gender) }}
                            </span>

                            @if($goat->weight)
                                <span class="rounded-full bg-gray-50 border border-efarmer-100 px-2.5 py-1">
                                    <i class="fa-solid fa-weight-hanging"></i> {{ $goat->weight }} kg
                                </span>
                            @endif

                        </div>

                        <div class="mt-auto pt-5 mt-5 flex items-center justify-between border-t border-efarmer-50">

                            <span class="font-display text-xl font-extrabold text-efarmer-800">
                                KSh {{ number_format($goat->selling_price) }}
                            </span>

                            <span class="w-9 h-9 rounded-full bg-efarmer-50 text-efarmer-700 flex items-center justify-center transition group-hover:bg-efarmer-600 group-hover:text-white">
                                <i class="fa-solid fa-arrow-right text-sm"></i>
                            </span>

                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-full card-soft p-12 text-center">
                    <i class="fa-solid fa-cow text-4xl text-efarmer-300"></i>
                    <p class="text-gray-500 mt-4">No goats are listed right now. Please check back shortly.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- HOW IT WORKS -->
<!-- ========================================================= -->

<section class="py-20 bg-efarmer-50/60">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">

            <span class="eyebrow justify-center">Simple &amp; transparent</span>

            <h2 class="font-display text-3xl md:text-4xl font-extrabold text-efarmer-900 mt-3">
                How Efarmer Works
            </h2>

            <p class="text-gray-500 mt-4">
                From browsing to delivery, buying a goat takes four simple steps.
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach([
                ['icon' => 'fa-magnifying-glass', 'title' => 'Search', 'text' => 'Browse goats by breed, county, gender, weight and price.'],
                ['icon' => 'fa-comments', 'title' => 'Ask questions', 'text' => 'Check health records and talk to the farmer about the goat.'],
                ['icon' => 'fa-mobile-screen-button', 'title' => 'Pay with M-Pesa', 'text' => 'Confirm your order and pay securely from your phone.'],
                ['icon' => 'fa-truck-fast', 'title' => 'Get delivery', 'text' => 'We arrange safe transport to your farm or nearest town.'],
            ] as $index => $step)

                <div class="relative card-soft lift p-7" data-reveal>

                    <span class="absolute -top-4 right-6 font-display text-5xl font-extrabold text-efarmer-100">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <span class="w-14 h-14 rounded-2xl bg-efarmer-600 text-white flex items-center justify-center text-xl relative">
                        <i class="fa-solid {{ $step['icon'] }}"></i>
                    </span>

                    <h3 class="font-bold text-lg text-efarmer-900 mt-6">
                        {{ $step['title'] }}
                    </h3>

                    <p class="text-gray-500 mt-3 leading-7 text-sm">
                        {{ $step['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

        <div class="text-center mt-12">

            <a href="{{ route('how-it-works') }}" class="btn btn-dark btn-lg">
                Learn more about the process
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- BROWSE BY BREED -->
<!-- ========================================================= -->

@if($breeds->count())

    <section class="py-16">

        <div class="max-w-7xl mx-auto px-5 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-8">

                <div>
                    <span class="eyebrow">Find your match</span>

                    <h2 class="font-display text-3xl font-extrabold text-efarmer-900 mt-3">
                        Browse by breed
                    </h2>
                </div>

                <p class="text-gray-500 text-sm sm:text-right max-w-xs">
                    Filter the marketplace by the breed that suits your farm and market.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                @foreach($breeds as $breed)

                    <a
                        href="{{ route('goats.index', ['breed_id' => $breed->id]) }}"
                        class="group inline-flex items-center gap-2 rounded-2xl border border-efarmer-100 bg-white px-5 py-3 font-semibold text-efarmer-800 hover:border-efarmer-400 hover:bg-efarmer-50 transition"
                    >
                        <i class="fa-solid fa-dna text-clay-500"></i>
                        {{ $breed->name }}
                        <i class="fa-solid fa-arrow-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                    </a>

                @endforeach

            </div>

        </div>

    </section>

@endif


<!-- ========================================================= -->
<!-- SELL CTA -->
<!-- ========================================================= -->

<section class="pb-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="relative overflow-hidden rounded-4xl bg-efarmer-900 text-white">

            <div class="grid lg:grid-cols-2 items-stretch">

                <div class="p-9 sm:p-12 lg:p-16 relative">

                    <div class="absolute inset-0 noise-dots opacity-30"></div>

                    <div class="relative">

                        <span class="eyebrow !text-clay-300">For buyers</span>

                        <h2 class="font-display text-3xl md:text-4xl font-extrabold mt-4 leading-tight">
                            Looking for your next goat?<br>
                            Delivered to all 47 counties.
                        </h2>

                        <p class="mt-5 text-white/70 leading-8">
                            Every goat is raised, vet-checked and listed by the Efarmer
                            team with real photos, weight and health records — so you
                            know exactly what you are paying for.
                        </p>

                        <ul class="mt-7 space-y-3 text-white/80 text-sm">

                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-clay-400"></i>
                                Full health, weight and breed records on every goat
                            </li>

                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-clay-400"></i>
                                Buyers pay securely through M-Pesa
                            </li>

                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-clay-400"></i>
                                Delivery arranged after every order
                            </li>

                        </ul>

                        <div class="flex flex-wrap gap-4 mt-9">

                            <a href="{{ route('goats.index') }}" class="btn btn-lg btn-accent">
                                <i class="fa-solid fa-cow"></i>
                                Browse Goats
                            </a>

                            <a href="{{ route('how-it-works') }}" class="btn btn-lg btn-white">
                                See how it works
                            </a>

                        </div>

                    </div>

                </div>

                <div class="relative min-h-[320px]">

                    <img
                        src="{{ $herdImage }}"
                        alt="Farmer herding goats in Kenya"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-r from-efarmer-900 via-efarmer-900/40 to-transparent"></div>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- FROM THE BLOG -->
<!-- ========================================================= -->

@php $homePosts = collect(config('blog.posts'))->take(3); @endphp

<section class="pb-24">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-10">

            <div>
                <span class="eyebrow">Farming knowledge</span>

                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-efarmer-900 mt-3">
                    Goat farming guides
                </h2>

                <div class="divider-line mt-4"></div>
            </div>

            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                Visit the blog
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($homePosts as $slug => $post)

                <a
                    href="{{ route('blog.show', $slug) }}"
                    class="group card-soft zoom lift overflow-hidden flex flex-col"
                    data-reveal
                >

                    <div class="relative h-52 overflow-hidden">

                        <img
                            src="{{ $img($post['image']) }}"
                            alt="{{ $post['title'] }}"
                            class="w-full h-full object-cover"
                        >

                        <span class="absolute top-4 left-4 rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-efarmer-800">
                            {{ $post['category'] }}
                        </span>

                    </div>

                    <div class="p-6 flex flex-col flex-1">

                        <div class="flex items-center gap-3 text-xs text-gray-400 font-semibold">

                            <span><i class="fa-regular fa-calendar"></i> {{ $post['date'] }}</span>

                            <span class="w-1 h-1 rounded-full bg-gray-300"></span>

                            <span><i class="fa-regular fa-clock"></i> {{ $post['read_time'] }}</span>

                        </div>

                        <h3 class="font-bold text-lg text-efarmer-900 mt-3 leading-snug group-hover:text-efarmer-600 transition">
                            {{ $post['title'] }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-3 leading-7">
                            {{ Str::limit($post['excerpt'], 110) }}
                        </p>

                        <span class="mt-auto pt-5 flex items-center gap-2 text-sm font-bold text-clay-600">
                            Read article
                            <i class="fa-solid fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>

@endsection
