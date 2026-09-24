@extends('layouts.app')

@section('title', 'Goats for Sale in Kenya | Efarmer Marketplace')
@section('description', 'Browse healthy goats for sale across Kenya. Filter by breed, county, gender, weight and price.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));
    $placeholder = $img('WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg');

    $counties = ['Nairobi', 'Nakuru', 'Kiambu', 'Machakos', 'Kajiado', 'Nyeri', 'Meru', 'Laikipia'];

    $activeFilters = collect([
        'search' => request('search'),
        'breed_id' => request('breed_id'),
        'location' => request('location'),
        'gender' => request('gender'),
        'max_price' => request('max_price'),
    ])->filter()->count();
@endphp

@section('content')

<!-- ========================================================= -->
<!-- PAGE HEADER -->
<!-- ========================================================= -->

<section class="relative bg-efarmer-950 text-white overflow-hidden">

    <img
        src="{{ $img('WhatsApp Image 2026-08-27 at 13.11.41.jpeg') }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover opacity-25"
    >

    <div class="absolute inset-0 bg-gradient-to-r from-efarmer-950 via-efarmer-950/85 to-efarmer-900/50"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 py-14 lg:py-16">

        <nav class="flex items-center gap-2 text-xs text-white/50 font-semibold">

            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Goats for Sale</span>

        </nav>

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mt-6">

            <div>

                <span class="eyebrow !text-clay-300">Efarmer marketplace</span>

                <h1 class="font-display text-4xl md:text-5xl font-extrabold mt-3">
                    Goats for Sale
                </h1>

                <p class="text-white/70 mt-4 max-w-xl leading-7">
                    Healthy, vet-checked goats from the Efarmer farm.
                    Tap any goat to see its full details, health records and photos.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <span class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-3 text-sm font-semibold">
                    <i class="fa-solid fa-cow text-clay-400"></i>
                    {{ number_format($goats->total()) }} goats available
                </span>

                <a href="{{ route('how-it-works') }}" class="btn btn-accent">
                    <i class="fa-solid fa-circle-question"></i>
                    How it works
                </a>

            </div>

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- MARKETPLACE -->
<!-- ========================================================= -->

<section class="py-12">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <!-- MOBILE TOOLBAR -->

        <div class="lg:hidden flex gap-3 mb-6">

            <button
                type="button"
                id="filterToggle"
                class="btn btn-outline flex-1"
                aria-expanded="false"
            >
                <i class="fa-solid fa-sliders"></i>
                Filters
                @if($activeFilters)
                    <span class="w-5 h-5 rounded-full bg-clay-500 text-white text-[11px] flex items-center justify-center">
                        {{ $activeFilters }}
                    </span>
                @endif
            </button>

            <select name="sort" form="filterForm" onchange="this.form.submit()" class="!w-auto">
                <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                <option value="price_low" @selected(request('sort') === 'price_low')>Price: low to high</option>
                <option value="price_high" @selected(request('sort') === 'price_high')>Price: high to low</option>
            </select>

        </div>

        <div class="grid lg:grid-cols-4 gap-8">

            <!-- FILTERS -->

            <aside id="filterPanel" class="hidden lg:block lg:col-span-1">

                <form
                    id="filterForm"
                    action="{{ route('goats.index') }}"
                    method="GET"
                    class="card-soft p-6 lg:sticky lg:top-24 space-y-6"
                >

                    <div class="flex items-center justify-between">

                        <h2 class="font-display font-extrabold text-lg text-efarmer-900">
                            <i class="fa-solid fa-sliders text-clay-500"></i>
                            Filter goats
                        </h2>

                        @if($activeFilters)
                            <a href="{{ route('goats.index') }}" class="text-xs font-bold text-clay-600 hover:text-clay-700">
                                Clear all
                            </a>
                        @endif

                    </div>

                    <label class="block">
                        <span class="field-label">Search</span>

                        <input
                            type="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Name, tag number or colour"
                        >
                    </label>

                    <label class="block">
                        <span class="field-label">Breed</span>

                        <select name="breed_id">
                            <option value="">All breeds</option>

                            @foreach($breeds as $breed)
                                <option value="{{ $breed->id }}" @selected(request('breed_id') == $breed->id)>
                                    {{ $breed->name }}
                                </option>
                            @endforeach

                        </select>
                    </label>
                    <label class="block">
                        <span class="field-label">County</span>

                        <select name="location">
                            <option value="">All counties</option>

                            @foreach($counties as $county)
                                <option value="{{ $county }}" @selected(request('location') === $county)>
                                    {{ $county }}
                                </option>
                            @endforeach

                        </select>
                    </label>

                    <div>
                        <span class="field-label">Gender</span>

                        <div class="grid grid-cols-2 gap-2">

                            @foreach(['male' => 'Male', 'female' => 'Female'] as $value => $label)

                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="{{ $value }}"
                                        class="peer sr-only"
                                        @checked(request('gender') === $value)
                                    >

                                    <span class="flex items-center justify-center gap-2 rounded-xl border border-efarmer-100 px-3 py-2.5 text-sm font-semibold text-gray-500 transition peer-checked:border-efarmer-500 peer-checked:bg-efarmer-50 peer-checked:text-efarmer-800">
                                        <i class="fa-solid {{ $value === 'male' ? 'fa-mars' : 'fa-venus' }}"></i>
                                        {{ $label }}
                                    </span>
                                </label>

                            @endforeach

                        </div>
                    </div>

                    <label class="block">
                        <span class="field-label">Maximum price</span>

                        <select name="max_price">
                            <option value="">Any price</option>

                            @foreach([10000, 15000, 20000, 30000, 50000, 100000] as $price)
                                <option value="{{ $price }}" @selected(request('max_price') == $price)>
                                    Up to KSh {{ number_format($price) }}
                                </option>
                            @endforeach

                        </select>
                    </label>

                    <div class="space-y-3 pt-2">

                        <button type="submit" class="btn btn-primary w-full">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Apply filters
                        </button>

                        <a href="{{ route('goats.index') }}" class="btn btn-ghost w-full">
                            Reset
                        </a>

                    </div>

                </form>

            </aside>
            <!-- RESULTS -->

            <div class="lg:col-span-3">

                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

                    <div>

                        <h2 class="font-display text-2xl font-extrabold text-efarmer-900">
                            Available goats
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Showing {{ $goats->firstItem() ?? 0 }}–{{ $goats->lastItem() ?? 0 }} of {{ $goats->total() }} listings
                        </p>

                    </div>

                    <label class="hidden lg:flex items-center gap-3 text-sm text-gray-500 font-semibold">
                        Sort by

                        <select name="sort" form="filterForm" onchange="this.form.submit()" class="!w-auto !py-2.5">
                            <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                            <option value="price_low" @selected(request('sort') === 'price_low')>Price: low to high</option>
                            <option value="price_high" @selected(request('sort') === 'price_high')>Price: high to low</option>
                        </select>
                    </label>

                </div>

                @if($activeFilters)

                    <div class="flex flex-wrap items-center gap-2 mb-6">

                        @if(request('search'))
                            <a href="{{ route('goats.index', request()->except('search')) }}" class="chip">
                                "{{ request('search') }}" <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                        @if(request('breed_id'))
                            <a href="{{ route('goats.index', request()->except('breed_id')) }}" class="chip">
                                {{ optional($breeds->firstWhere('id', request('breed_id')))->name ?? 'Breed' }}
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                        @if(request('location'))
                            <a href="{{ route('goats.index', request()->except('location')) }}" class="chip">
                                {{ request('location') }} <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                        @if(request('gender'))
                            <a href="{{ route('goats.index', request()->except('gender')) }}" class="chip">
                                {{ ucfirst(request('gender')) }} <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                        @if(request('max_price'))
                            <a href="{{ route('goats.index', request()->except('max_price')) }}" class="chip chip-accent">
                                Up to KSh {{ number_format(request('max_price')) }}
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                    </div>

                @endif

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($goats as $goat)

                        {{-- Whole card is clickable – tapping the photo opens the details --}}
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
                                        src="{{ $placeholder }}"
                                        alt="{{ $goat->name ?? $goat->tag_number }}"
                                        class="w-full h-full object-cover"
                                    >
                                @endif

                                <span class="absolute top-3 left-3 rounded-full bg-efarmer-600/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                                    {{ ucfirst($goat->status) }}
                                </span>

                                @if($goat->featured)
                                    <span class="absolute top-3 right-3 rounded-full bg-clay-500/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                @endif

                                <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent px-4 pb-3 pt-8 text-xs font-semibold text-white opacity-0 transition group-hover:opacity-100">
                                    <i class="fa-solid fa-expand"></i> Tap to view details
                                </span>

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

                                    @if($goat->category)
                                        <span class="rounded-full bg-gray-50 border border-efarmer-100 px-2.5 py-1">
                                            <i class="fa-solid fa-tag"></i> {{ $goat->category }}
                                        </span>
                                    @endif

                                </div>

                                <div class="mt-auto pt-5 flex items-center justify-between border-t border-efarmer-50">

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

                        <div class="col-span-full card-soft p-14 text-center">

                            <span class="w-16 h-16 mx-auto rounded-2xl bg-efarmer-50 text-efarmer-500 flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>

                            <h3 class="font-display font-extrabold text-xl text-efarmer-900 mt-5">
                                No goats match your filters
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Try a wider price range, another breed or a different county.
                            </p>

                            <a href="{{ route('goats.index') }}" class="btn btn-primary mt-6">
                                <i class="fa-solid fa-rotate-left"></i>
                                Clear filters
                            </a>

                        </div>

                    @endforelse

                </div>
            </div>

        </div>

        @if($goats->hasPages())

            <div class="mt-10">
                {{ $goats->links() }}
            </div>

        @endif

    </div>

</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.getElementById('filterToggle');
        var panel = document.getElementById('filterPanel');

        if (toggle && panel) {
            toggle.addEventListener('click', function () {
                var isOpen = ! panel.classList.contains('hidden');

                panel.classList.toggle('hidden', isOpen);
                toggle.setAttribute('aria-expanded', String(! isOpen));
            });
        }
    });
</script>
@endpush


@endsection
