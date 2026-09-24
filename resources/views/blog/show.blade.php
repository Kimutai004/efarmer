@extends('layouts.app')

@php
    /* Image helper – all photos live in /public/images */
    $img = fn (string $file) => asset('images/' . str_replace(' ', '%20', $file));

    $posts = config('blog.posts');

    /* Resolve the requested article, falling back to the first post */
    $currentSlug = array_key_exists($slug ?? '', $posts) ? $slug : array_key_first($posts);
    $post = $posts[$currentSlug];

    $sections = $post['sections'] ?? [];
    $highlights = $post['highlights'] ?? [];
    $tags = $post['tags'] ?? [];

    $related = collect($posts)->except($currentSlug)->take(3);

    $previous = null;
    $next = null;

    $keys = array_keys($posts);
    $position = array_search($currentSlug, $keys, true);

    if ($position !== false) {
        $previous = $position > 0 ? [$keys[$position - 1], $posts[$keys[$position - 1]]] : null;
        $next = $position < count($keys) - 1 ? [$keys[$position + 1], $posts[$keys[$position + 1]]] : null;
    }
@endphp

@section('title', $post['title'] . ' | Efarmer Blog')
@section('description', $post['excerpt'])

@section('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post['title'] }}">
    <meta property="og:description" content="{{ $post['excerpt'] }}">
    <meta property="og:image" content="{{ $img($post['image']) }}">
    <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')

<!-- READING PROGRESS -->

<div class="fixed top-0 left-0 right-0 z-[60] h-1 bg-transparent pointer-events-none">
    <div id="readingProgress" class="h-full w-0 bg-gradient-to-r from-clay-500 to-efarmer-500 transition-[width] duration-150"></div>
</div>


<!-- ========================================================= -->
<!-- ARTICLE HERO -->
<!-- ========================================================= -->

<article>

<header class="relative bg-efarmer-950 text-white overflow-hidden">

    <img
        src="{{ $img($post['image']) }}"
        alt="{{ $post['title'] }}"
        class="absolute inset-0 w-full h-full object-cover opacity-40"
    >

    <div class="absolute inset-0 bg-gradient-to-t from-efarmer-950 via-efarmer-950/85 to-efarmer-950/45"></div>

    <div class="relative max-w-4xl mx-auto px-5 lg:px-8 pt-12 pb-16 text-center">

        <nav class="flex items-center justify-center gap-2 text-xs text-white/50 font-semibold">

            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-white/80">{{ $post['category'] }}</span>

        </nav>

        <span class="inline-flex items-center gap-2 rounded-full bg-clay-500/95 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.18em] text-white mt-8">
            <i class="fa-solid fa-book-open"></i>
            {{ $post['category'] }}
        </span>

        <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mt-6">
            {{ $post['title'] }}
        </h1>

        <p class="text-white/70 mt-6 text-lg leading-8 max-w-2xl mx-auto">
            {{ $post['excerpt'] }}
        </p>

        <div class="flex flex-wrap items-center justify-center gap-5 mt-9 text-sm text-white/60">

            <span class="flex items-center gap-3">

                <span class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center font-extrabold text-white">
                    {{ Str::substr($post['author'], 0, 1) }}
                </span>

                <span class="text-left">
                    <span class="block font-bold text-white">{{ $post['author'] }}</span>
                    <span class="block text-xs">{{ $post['role'] ?? 'Efarmer' }}</span>
                </span>

            </span>

            <span class="flex items-center gap-2">
                <i class="fa-regular fa-calendar"></i>
                {{ $post['date'] }}
            </span>

            <span class="flex items-center gap-2">
                <i class="fa-regular fa-clock"></i>
                {{ $post['read_time'] }}
            </span>

        </div>

    </div>

</header>

<!-- ========================================================= -->
<!-- ARTICLE BODY -->
<!-- ========================================================= -->

<div class="max-w-7xl mx-auto px-5 lg:px-8 py-14 lg:py-16">

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_300px] gap-10 xl:gap-14">

        <!-- MAIN COLUMN -->

        <div class="min-w-0">

            <!-- FEATURED IMAGE -->

            <figure class="rounded-3xl overflow-hidden shadow-card -mt-24 lg:-mt-28 relative z-10">
                <img
                    src="{{ $img($post['image']) }}"
                    alt="{{ $post['title'] }}"
                    class="w-full h-[260px] sm:h-[380px] lg:h-[460px] object-cover"
                >
            </figure>

            <!-- SHARE ROW -->

            <div class="flex flex-wrap items-center justify-between gap-4 mt-8 pb-8 border-b border-efarmer-100">

                <div class="flex flex-wrap items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
                    <i class="fa-solid fa-tags"></i>

                    @foreach($tags as $tag)
                        <span class="rounded-full bg-efarmer-50 text-efarmer-700 px-3 py-1.5">{{ $tag }}</span>
                    @endforeach
                </div>

                <div class="flex items-center gap-2" id="shareRow">

                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mr-1">Share</span>

                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        target="_blank" rel="noopener" aria-label="Share on Facebook"
                        class="w-9 h-9 rounded-xl bg-gray-100 text-gray-600 hover:bg-efarmer-600 hover:text-white transition flex items-center justify-center"
                    >
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a
                        href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post['title']) }}"
                        target="_blank" rel="noopener" aria-label="Share on X"
                        class="w-9 h-9 rounded-xl bg-gray-100 text-gray-600 hover:bg-efarmer-600 hover:text-white transition flex items-center justify-center"
                    >
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                    <a
                        href="https://wa.me/?text={{ urlencode($post['title'] . ' ' . url()->current()) }}"
                        target="_blank" rel="noopener" aria-label="Share on WhatsApp"
                        class="w-9 h-9 rounded-xl bg-gray-100 text-gray-600 hover:bg-efarmer-600 hover:text-white transition flex items-center justify-center"
                    >
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>

                    <button
                        type="button"
                        id="copyLink"
                        data-url="{{ url()->current() }}"
                        aria-label="Copy link"
                        class="w-9 h-9 rounded-xl bg-gray-100 text-gray-600 hover:bg-clay-500 hover:text-white transition flex items-center justify-center"
                    >
                        <i class="fa-solid fa-link"></i>
                    </button>

                </div>

            </div>

            <!-- MOBILE TABLE OF CONTENTS -->

            @if(count($sections) > 1)

                <details class="lg:hidden card-soft p-5 mt-8">

                    <summary class="font-bold text-efarmer-900 cursor-pointer flex items-center gap-2">
                        <i class="fa-solid fa-list-ul text-clay-500"></i>
                        What's in this guide
                    </summary>

                    <ol class="mt-4 space-y-2 text-sm">

                        @foreach($sections as $index => $section)

                            <li>
                                <a href="#{{ $section['id'] }}" class="flex items-start gap-3 text-gray-600 hover:text-efarmer-700 transition">
                                    <span class="font-bold text-clay-500">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    {{ $section['title'] }}
                                </a>
                            </li>

                        @endforeach

                    </ol>

                </details>

            @endif

            <!-- KEY TAKEAWAYS -->

            @if(count($highlights))

                <div class="card-soft p-6 sm:p-7 mt-8 border-l-4 !border-l-clay-500">

                    <h2 class="font-display font-extrabold text-lg text-efarmer-900 flex items-center gap-3">
                        <i class="fa-solid fa-lightbulb text-clay-500"></i>
                        Key takeaways
                    </h2>

                    <ul class="mt-4 space-y-3">

                        @foreach($highlights as $highlight)

                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fa-solid fa-circle-check text-efarmer-500 mt-1"></i>
                                {{ $highlight }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <!-- SECTIONS -->

            <div class="mt-10 space-y-16">

                @foreach($sections as $index => $section)

                    <section id="{{ $section['id'] }}" class="scroll-mt-28">

                        <div class="flex items-start gap-4">

                            <span class="flex-shrink-0 w-12 h-12 rounded-2xl bg-efarmer-600 text-white flex items-center justify-center font-display font-extrabold text-lg">
                                {{ $index + 1 }}
                            </span>

                            <div>
                                <h2 class="font-display text-2xl md:text-[1.7rem] font-extrabold text-efarmer-900 leading-tight">
                                    {{ $section['title'] }}
                                </h2>

                                @if(!empty($section['kicker']))
                                    <p class="text-sm font-semibold text-clay-600 mt-1.5">
                                        {{ $section['kicker'] }}
                                    </p>
                                @endif
                            </div>

                        </div>

                        <div class="article-prose mt-6 {{ $index === 0 ? 'drop-cap' : '' }}">

                            @foreach($section['paragraphs'] ?? [] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach

                            @if(!empty($section['checklist']))

                                <div class="not-prose grid sm:grid-cols-2 gap-3 rounded-3xl bg-efarmer-50 border border-efarmer-100 p-6 my-8">

                                    <h3 class="sm:col-span-2 flex items-center gap-3 font-display font-bold text-efarmer-900 text-lg">
                                        <span class="w-9 h-9 rounded-xl bg-white text-efarmer-700 flex items-center justify-center shadow-sm">
                                            <i class="fa-solid {{ $section['checklist']['icon'] ?? 'fa-circle-check' }}"></i>
                                        </span>
                                        {{ $section['checklist']['title'] ?? 'Checklist' }}
                                    </h3>

                                    @foreach($section['checklist']['items'] as $item)

                                        <div class="flex items-start gap-3 text-gray-600 text-sm">
                                            <i class="fa-solid fa-circle-check text-efarmer-600 mt-1"></i>
                                            {{ $item }}
                                        </div>

                                    @endforeach

                                </div>

                            @endif

                            @if(!empty($section['tiles']))

                                <div class="not-prose grid grid-cols-2 md:grid-cols-4 gap-3 my-8">

                                    @foreach($section['tiles'] as $tile)

                                        <div class="rounded-2xl border border-efarmer-100 bg-white p-5 text-center shadow-sm">

                                            <span class="w-11 h-11 mx-auto rounded-xl bg-clay-50 text-clay-600 flex items-center justify-center mb-3">
                                                <i class="fa-solid {{ $tile['icon'] }}"></i>
                                            </span>

                                            <p class="font-semibold text-efarmer-900 text-sm">{{ $tile['label'] }}</p>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                            @if(!empty($section['table']))

                                <div class="not-prose my-8 overflow-x-auto rounded-3xl border border-efarmer-100">

                                    <table class="w-full text-sm">

                                        <thead class="bg-efarmer-50">
                                            <tr>
                                                @foreach($section['table']['head'] as $heading)
                                                    <th class="text-left px-5 py-4 font-bold text-efarmer-900 uppercase text-xs tracking-wider">
                                                        {{ $heading }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>

                                        <tbody class="divide-y divide-efarmer-100">

                                            @foreach($section['table']['rows'] as $row)

                                                <tr class="hover:bg-efarmer-50/40 transition">
                                                    @foreach($row as $cellIndex => $cell)
                                                        <td class="px-5 py-4 {{ $cellIndex === 0 ? 'font-bold text-efarmer-900' : 'text-gray-600' }}">
                                                            {{ $cell }}
                                                        </td>
                                                    @endforeach
                                                </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            @endif

                            @if(!empty($section['figure']))

                                <figure class="not-prose my-8">

                                    <div class="rounded-3xl overflow-hidden shadow-soft">
                                        <img
                                            src="{{ $img($section['figure']['image']) }}"
                                            alt="{{ $section['figure']['caption'] ?? $section['title'] }}"
                                            class="w-full h-[280px] sm:h-[400px] object-cover"
                                        >
                                    </div>

                                    @if(!empty($section['figure']['caption']))
                                        <figcaption>{{ $section['figure']['caption'] }}</figcaption>
                                    @endif

                                </figure>

                            @endif

                            @if(!empty($section['quote']))
                                <blockquote class="not-prose">{{ $section['quote'] }}</blockquote>
                            @endif

                        </div>

                    </section>

                @endforeach

            </div>

            <!-- AUTHOR -->

            <div class="card-soft p-7 mt-14 flex flex-col sm:flex-row items-start gap-5">

                <span class="w-16 h-16 rounded-2xl bg-efarmer-600 text-white flex items-center justify-center font-display font-extrabold text-2xl flex-shrink-0">
                    {{ Str::substr($post['author'], 0, 1) }}
                </span>

                <div class="flex-1">

                    <p class="text-xs font-bold uppercase tracking-wider text-clay-600">Written by</p>

                    <h3 class="font-display font-extrabold text-lg text-efarmer-900 mt-1">
                        {{ $post['author'] }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-2 leading-7">
                        The Efarmer farm advisory desk shares practical, field-tested
                        guidance on goat breeding, feeding, animal health and getting
                        the best price for your livestock.
                    </p>

                    <a href="{{ route('contact') }}" class="btn btn-outline mt-5">
                        <i class="fa-solid fa-headset"></i>
                        Ask our team a question
                    </a>

                </div>

            </div>

            <!-- PREV / NEXT -->

            @if($previous || $next)

                <div class="grid sm:grid-cols-2 gap-4 mt-6">

                    @if($previous)

                        <a href="{{ route('blog.show', $previous[0]) }}" class="group card-soft lift p-6">

                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                <i class="fa-solid fa-arrow-left"></i> Previous
                            </p>

                            <p class="font-bold text-efarmer-900 mt-2 leading-snug group-hover:text-efarmer-600 transition">
                                {{ $previous[1]['title'] }}
                            </p>

                        </a>

                    @endif

                    @if($next)

                        <a href="{{ route('blog.show', $next[0]) }}" class="group card-soft lift p-6 sm:text-right">

                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                Next <i class="fa-solid fa-arrow-right"></i>
                            </p>

                            <p class="font-bold text-efarmer-900 mt-2 leading-snug group-hover:text-efarmer-600 transition">
                                {{ $next[1]['title'] }}
                            </p>

                        </a>

                    @endif

                </div>

            @endif

        </div>


        <!-- ============================================= -->
        <!-- SIDEBAR -->
        <!-- ============================================= -->

        <aside class="hidden lg:block space-y-6">

            @if(count($sections))

                <nav class="card-soft p-6 lg:sticky lg:top-24">

                    <h2 class="font-display font-extrabold text-efarmer-900 text-sm uppercase tracking-wider">
                        In this guide
                    </h2>

                    <ol class="mt-4 space-y-1" id="articleToc">

                        @foreach($sections as $index => $section)

                            <li>
                                <a
                                    href="#{{ $section['id'] }}"
                                    class="toc-link flex items-start gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-500"
                                >
                                    <span class="font-bold text-clay-500">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    {{ $section['title'] }}
                                </a>
                            </li>

                        @endforeach

                    </ol>

                    <div class="mt-6 pt-6 border-t border-efarmer-100 space-y-3">

                        <a href="{{ route('goats.index') }}" class="btn btn-primary w-full">
                            <i class="fa-solid fa-cow"></i>
                            Browse goats
                        </a>

                    </div>

                </nav>

            @endif

            <div class="relative overflow-hidden rounded-3xl bg-efarmer-950 p-7 text-white">

                <div class="absolute inset-0 noise-dots opacity-25"></div>

                <div class="relative">

                    <span class="w-11 h-11 rounded-2xl bg-white/10 flex items-center justify-center text-clay-300">
                        <i class="fa-solid fa-seedling"></i>
                    </span>

                    <h3 class="font-display font-extrabold text-lg mt-4">
                        Need healthy stock?
                    </h3>

                    <p class="text-sm text-white/60 mt-2 leading-6">
                        Every Efarmer listing shows breed, weight, health records and
                        the farmer's county — so you can buy with confidence.
                    </p>

                    <a href="{{ route('goats.index') }}" class="btn btn-accent w-full mt-5">
                        View listings
                    </a>

                </div>

            </div>

        </aside>

    </div>

</div>

</article>

<!-- ========================================================= -->
<!-- CONTINUE READING -->
<!-- ========================================================= -->

<section class="pb-16">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-8">

            <div>
                <span class="eyebrow">Keep learning</span>

                <h2 class="font-display text-2xl md:text-3xl font-extrabold text-efarmer-900 mt-3">
                    Continue reading
                </h2>
            </div>

            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                All articles
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($related as $relatedSlug => $relatedPost)

                <a
                    href="{{ route('blog.show', $relatedSlug) }}"
                    class="group card-soft zoom lift overflow-hidden flex flex-col"
                    data-reveal
                >

                    <div class="relative h-48 overflow-hidden">

                        <img
                            src="{{ $img($relatedPost['image']) }}"
                            alt="{{ $relatedPost['title'] }}"
                            class="w-full h-full object-cover"
                        >

                        <span class="absolute top-4 left-4 rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider text-efarmer-800">
                            {{ $relatedPost['category'] }}
                        </span>

                    </div>

                    <div class="p-6 flex flex-col flex-1">

                        <h3 class="font-bold text-efarmer-900 leading-snug group-hover:text-efarmer-600 transition">
                            {{ $relatedPost['title'] }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-3 leading-7">
                            {{ Str::limit($relatedPost['excerpt'], 100) }}
                        </p>

                        <span class="mt-auto pt-4 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            {{ $relatedPost['read_time'] }}
                        </span>

                    </div>

                </a>

            @endforeach

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
                        Ready to find your next goat?
                    </h2>

                    <p class="text-white/70 mt-4 max-w-xl leading-7">
                        Browse healthy goats with full health and weight records —
                        delivered safely to your farm anywhere in Kenya.
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        /* Reading progress bar */
        var progress = document.getElementById('readingProgress');

        if (progress) {
            var updateProgress = function () {
                var scrollable = document.documentElement.scrollHeight - window.innerHeight;
                var percent = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;

                progress.style.width = Math.min(100, Math.max(0, percent)) + '%';
            };

            updateProgress();
            window.addEventListener('scroll', updateProgress, { passive: true });
            window.addEventListener('resize', updateProgress);
        }

        /* Highlight the section being read in the table of contents */
        var tocLinks = document.querySelectorAll('#articleToc .toc-link');

        if (tocLinks.length && 'IntersectionObserver' in window) {
            var headings = [];

            tocLinks.forEach(function (link) {
                var section = document.querySelector(link.getAttribute('href'));

                if (section) headings.push(section);
            });

            var spy = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (! entry.isIntersecting) return;

                    tocLinks.forEach(function (link) {
                        link.classList.toggle('active', link.getAttribute('href') === '#' + entry.target.id);
                    });
                });
            }, { rootMargin: '-120px 0px -70% 0px', threshold: 0 });

            headings.forEach(function (heading) { spy.observe(heading); });
        }

        /* Copy article link */
        var copyButton = document.getElementById('copyLink');

        if (copyButton) {
            copyButton.addEventListener('click', function () {
                var url = copyButton.dataset.url;

                var done = function () {
                    copyButton.innerHTML = '<i class="fa-solid fa-check"></i>';

                    setTimeout(function () {
                        copyButton.innerHTML = '<i class="fa-solid fa-link"></i>';
                    }, 2000);
                };

                if (navigator.clipboard) {
                    navigator.clipboard.writeText(url).then(done);
                } else {
                    var input = document.createElement('input');
                    input.value = url;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    done();
                }
            });
        }
    });
</script>
@endpush

@endsection
