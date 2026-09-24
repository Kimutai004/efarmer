@extends('layouts.app')

@section('title', 'Efarmer Blog | Goat Farming Tips & Guides for Kenyan Farmers')
@section('description', 'Practical guides on goat farming, breeds, nutrition, animal health and livestock markets in Kenya.')

@php
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));

    $posts = collect(config('blog.posts'));
    $featuredSlug = $posts->keys()->first();
    $featured = $posts->first();
    $rest = $posts->skip(1);

    $categories = $posts->pluck('category')->unique()->values();
@endphp

@section('content')

<!-- ========================================================= -->
<!-- BLOG HERO -->
<!-- ========================================================= -->

<section class="relative bg-efarmer-950 text-white overflow-hidden">

    <img
        src="{{ $img($featured['image']) }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover opacity-25"
    >

    <div class="absolute inset-0 bg-gradient-to-r from-efarmer-950 via-efarmer-950/90 to-efarmer-900/40"></div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 py-16 lg:py-20">

        <nav class="flex items-center gap-2 text-xs text-white/50 font-semibold">

            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">Blog</span>

        </nav>

        <span class="eyebrow !text-clay-300 inline-flex mt-6">Efarmer blog</span>

        <h1 class="font-display text-4xl md:text-5xl font-extrabold mt-3 max-w-2xl leading-tight">
            Farming tips &amp; livestock insights
        </h1>

        <p class="text-white/70 mt-5 max-w-2xl leading-8">
            Learn how to raise healthier goats, cut feed costs, manage animal
            health and sell at better prices — written for Kenyan farmers.
        </p>

        @if($categories->count())

            <div class="flex flex-wrap gap-2 mt-8" id="postFilters">

                <button type="button" data-filter="all" class="filter-chip filter-chip-active">
                    All topics
                </button>

                @foreach($categories as $category)

                    <button type="button" data-filter="{{ $category }}" class="filter-chip">
                        {{ $category }}
                    </button>

                @endforeach

            </div>

        @endif

    </div>

</section>


<!-- ========================================================= -->
<!-- FEATURED ARTICLE -->
<!-- ========================================================= -->

<section class="py-14">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <a
            href="{{ route('blog.show', $featuredSlug) }}"
            class="group card-soft zoom lift overflow-hidden grid lg:grid-cols-2"
            data-post
            data-category="{{ $featured['category'] }}"
        >

            <div class="relative h-64 lg:h-full min-h-[300px] overflow-hidden">

                <img
                    src="{{ $img($featured['image']) }}"
                    alt="{{ $featured['title'] }}"
                    class="w-full h-full object-cover"
                >

                <span class="absolute top-5 left-5 rounded-full bg-clay-500/95 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wider text-white">
                    Editor's pick
                </span>

            </div>

            <div class="p-8 lg:p-12 flex flex-col justify-center">

                <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-wider text-clay-600">

                    <span>{{ $featured['category'] }}</span>
                    <span class="w-1 h-1 rounded-full bg-clay-400"></span>
                    <span class="text-gray-400">{{ $featured['read_time'] }}</span>

                </div>

                <h2 class="font-display text-2xl lg:text-3xl font-extrabold text-efarmer-900 mt-4 leading-tight group-hover:text-efarmer-600 transition">
                    {{ $featured['title'] }}
                </h2>

                <p class="text-gray-500 mt-4 leading-8">
                    {{ $featured['excerpt'] }}
                </p>

                <div class="flex items-center gap-4 mt-7">

                    <span class="w-11 h-11 rounded-full bg-efarmer-100 text-efarmer-700 flex items-center justify-center font-extrabold">
                        {{ Str::substr($featured['author'], 0, 1) }}
                    </span>

                    <div class="text-sm">
                        <p class="font-bold text-efarmer-900">{{ $featured['author'] }}</p>
                        <p class="text-gray-400 text-xs">{{ $featured['date'] }}</p>
                    </div>

                    <span class="ml-auto btn btn-primary">
                        Read guide
                        <i class="fa-solid fa-arrow-right"></i>
                    </span>

                </div>

            </div>

        </a>

    </div>

</section>
<!-- ========================================================= -->
<!-- MORE ARTICLES -->
<!-- ========================================================= -->

<section class="pb-16">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex items-end justify-between gap-5 mb-8">

            <div>
                <span class="eyebrow">Latest articles</span>

                <h2 class="font-display text-3xl font-extrabold text-efarmer-900 mt-3">
                    More from the blog
                </h2>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="postGrid">

            @foreach($rest as $slug => $post)

                <a
                    href="{{ route('blog.show', $slug) }}"
                    class="group card-soft zoom lift overflow-hidden flex flex-col"
                    data-post
                    data-category="{{ $post['category'] }}"
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
                            {{ Str::limit($post['excerpt'], 120) }}
                        </p>

                        <span class="mt-auto pt-5 flex items-center gap-2 text-sm font-bold text-clay-600">
                            Read article
                            <i class="fa-solid fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

        <div id="noPosts" class="hidden text-center py-14">

            <p class="text-gray-500">No articles in this topic yet. Try another category.</p>

        </div>

    </div>

</section>
<!-- ========================================================= -->
<!-- CTA -->
<!-- ========================================================= -->

<section class="pb-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="relative overflow-hidden rounded-4xl bg-efarmer-900 text-white p-10 sm:p-14">

            <div class="absolute inset-0 noise-dots opacity-25"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center gap-8">

                <div class="flex-1">

                    <h2 class="font-display text-3xl font-extrabold leading-tight">
                        Ready to buy or sell a goat?
                    </h2>

                    <p class="text-white/70 mt-4 max-w-xl leading-7">
                        Put these guides to work. Browse healthy goats with full
                        health records on the Efarmer marketplace.
                    </p>

                </div>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('goats.index') }}" class="btn btn-lg btn-accent">
                        <i class="fa-solid fa-cow"></i>
                        Browse goats
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@push('styles')
<style>
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .25);
        padding: .5rem 1rem;
        font-size: .8rem;
        font-weight: 700;
        color: rgba(255, 255, 255, .8);
        transition: background .2s ease, color .2s ease, border-color .2s ease;
    }

    .filter-chip:hover { background: rgba(255, 255, 255, .12); color: #fff; }

    .filter-chip-active { background: #d27c37; border-color: #d27c37; color: #fff; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chips = document.querySelectorAll('#postFilters .filter-chip');
        var posts = document.querySelectorAll('[data-post]');
        var empty = document.getElementById('noPosts');

        if (! chips.length) return;

        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                var filter = chip.dataset.filter;

                chips.forEach(function (item) { item.classList.remove('filter-chip-active'); });
                chip.classList.add('filter-chip-active');

                var visible = 0;

                posts.forEach(function (post) {
                    var matches = filter === 'all' || post.dataset.category === filter;

                    post.classList.toggle('hidden', ! matches);

                    if (matches) visible++;
                });

                if (empty) empty.classList.toggle('hidden', visible > 0);
            });
        });
    });
</script>
@endpush


@endsection
