@extends('layouts.app')

@section('title', 'Efarmer Blog')

@section('content')

<section class="bg-green-900 text-white pt-20">

    <div class="max-w-5xl mx-auto px-6 py-20">

        <a
            href="{{ url('/blog') }}"
            class="inline-flex items-center gap-2 text-green-200 hover:text-white mb-8"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Back to Blog
        </a>

        <p class="text-green-300 font-bold uppercase tracking-wider text-sm">
            Goat Farming
        </p>

        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mt-3">
            Complete Guide to Goat Farming
        </h1>

        <p class="mt-6 text-green-100 text-lg">
            Everything you need to know about starting and managing
            a successful goat farming business.
        </p>

        <div class="mt-8 flex items-center gap-6 text-sm text-green-200">

            <span>
                <i class="fa-regular fa-calendar mr-2"></i>
                {{ date('F d, Y') }}
            </span>

            <span>
                <i class="fa-regular fa-clock mr-2"></i>
                8 min read
            </span>

        </div>

    </div>

</section>

<!-- CONTENT -->

<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">

    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_280px] gap-8 lg:gap-10">

        <!-- ARTICLE -->
        <article class="min-w-0">

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

                <!-- Article Header -->
                <div class="px-6 sm:px-8 md:px-12 pt-8 md:pt-10 pb-6 border-b border-gray-100">

                    <div class="flex items-center gap-2 text-sm font-semibold text-green-700 mb-4">
                        <span class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                            <i class="fa-solid fa-book-open"></i>
                        </span>
                        Goat Farming Guide
                    </div>

                    <p class="text-xl md:text-2xl leading-relaxed font-medium text-gray-700">
                        Goat farming can be a profitable agricultural business when farmers
                        select the right breeds, provide proper nutrition and maintain good
                        animal health.
                    </p>

                </div>

                <!-- Article Body -->
                <div class="px-6 sm:px-8 md:px-12 py-8 md:py-10">

                    <div class="article-content max-w-none">

                        <!-- Section 1 -->
                        <section class="mb-12">

                            <div class="flex items-start gap-4 mb-5">

                                <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-extrabold text-lg">
                                    1
                                </span>

                                <div>
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                                        Choose the Right Goat Breed
                                    </h2>

                                    <p class="mt-1 text-sm text-green-700 font-medium">
                                        Start with the right foundation
                                    </p>
                                </div>

                            </div>

                            <div class="space-y-4 text-gray-600 leading-8 text-base md:text-lg">

                                <p>
                                    The first step is choosing goats suitable for your
                                    farming goals and local environment.
                                </p>

                                <p>
                                    Farmers should consider whether they are interested
                                    in meat production, milk production, breeding or a
                                    combination of these activities.
                                </p>

                            </div>

                            <div class="mt-6 grid sm:grid-cols-2 gap-3">

                                <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <i class="fa-solid fa-cloud-sun text-green-600 mt-1"></i>
                                    <span class="text-gray-700">Choose breeds adapted to your local climate.</span>
                                </div>

                                <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <i class="fa-solid fa-user-check text-green-600 mt-1"></i>
                                    <span class="text-gray-700">Buy animals from reliable farmers.</span>
                                </div>

                                <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <i class="fa-solid fa-heart-pulse text-green-600 mt-1"></i>
                                    <span class="text-gray-700">Check the health and physical condition of the goat.</span>
                                </div>

                                <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <i class="fa-solid fa-syringe text-green-600 mt-1"></i>
                                    <span class="text-gray-700">Ask about vaccination and breeding history.</span>
                                </div>

                            </div>

                        </section>


                        <!-- Section 2 -->
                        <section class="mb-12">

                            <div class="flex items-start gap-4 mb-5">

                                <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-extrabold text-lg">
                                    2
                                </span>

                                <div>
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                                        Build Proper Housing
                                    </h2>

                                    <p class="mt-1 text-sm text-green-700 font-medium">
                                        Give your goats a safe and healthy environment
                                    </p>
                                </div>

                            </div>

                            <p class="text-gray-600 leading-8 text-base md:text-lg">
                                Goats require clean, dry and well-ventilated housing.
                                Good housing protects animals from excessive rain,
                                cold weather and predators.
                            </p>

                            <div class="mt-7 rounded-2xl bg-green-50 border border-green-100 p-6">

                                <h3 class="flex items-center gap-3 text-lg font-bold text-green-900 mb-5">
                                    <span class="w-9 h-9 rounded-lg bg-white text-green-700 flex items-center justify-center shadow-sm">
                                        <i class="fa-solid fa-house"></i>
                                    </span>
                                    Important housing features
                                </h3>

                                <div class="grid sm:grid-cols-2 gap-4">

                                    <div class="flex items-center gap-3 text-gray-700">
                                        <i class="fa-solid fa-circle-check text-green-600"></i>
                                        Good ventilation
                                    </div>

                                    <div class="flex items-center gap-3 text-gray-700">
                                        <i class="fa-solid fa-circle-check text-green-600"></i>
                                        Dry flooring
                                    </div>

                                    <div class="flex items-center gap-3 text-gray-700">
                                        <i class="fa-solid fa-circle-check text-green-600"></i>
                                        Enough space for every animal
                                    </div>

                                    <div class="flex items-center gap-3 text-gray-700">
                                        <i class="fa-solid fa-circle-check text-green-600"></i>
                                        Clean drinking water
                                    </div>

                                    <div class="flex items-center gap-3 text-gray-700 sm:col-span-2">
                                        <i class="fa-solid fa-circle-check text-green-600"></i>
                                        Protection from predators
                                    </div>

                                </div>

                            </div>

                        </section>


                        <!-- Section 3 -->
                        <section class="mb-12">

                            <div class="flex items-start gap-4 mb-5">

                                <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-extrabold text-lg">
                                    3
                                </span>

                                <div>
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                                        Feeding Your Goats
                                    </h2>

                                    <p class="mt-1 text-sm text-green-700 font-medium">
                                        Build a balanced feeding routine
                                    </p>
                                </div>

                            </div>

                            <div class="space-y-4 text-gray-600 leading-8 text-base md:text-lg">

                                <p>
                                    Nutrition is one of the most important parts of goat
                                    farming. Goats need a balanced diet containing
                                    forage, minerals and adequate clean water.
                                </p>

                                <p>
                                    Farmers can use pasture, browse, hay and appropriate
                                    supplementary feeds depending on availability and
                                    production goals.
                                </p>

                            </div>

                            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-3">

                                <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm">
                                    <div class="w-11 h-11 mx-auto rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-leaf"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm">Pasture</p>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm">
                                    <div class="w-11 h-11 mx-auto rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-seedling"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm">Browse</p>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm">
                                    <div class="w-11 h-11 mx-auto rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-wheat-awn"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm">Hay</p>
                                </div>

                                <div class="rounded-2xl border border-gray-100 bg-white p-5 text-center shadow-sm">
                                    <div class="w-11 h-11 mx-auto rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-3">
                                        <i class="fa-solid fa-droplet"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800 text-sm">Clean Water</p>
                                </div>

                            </div>

                        </section>


                        <!-- Section 4 -->
                        <section class="mb-12">

                            <div class="flex items-start gap-4 mb-5">

                                <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-extrabold text-lg">
                                    4
                                </span>

                                <div>
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                                        Goat Health Management
                                    </h2>

                                    <p class="mt-1 text-sm text-green-700 font-medium">
                                        Keep your herd healthy and productive
                                    </p>
                                </div>

                            </div>

                            <p class="text-gray-600 leading-8 text-base md:text-lg">
                                Healthy animals grow faster and perform better.
                                Farmers should monitor their goats regularly and
                                work with qualified veterinary professionals when
                                animals show signs of illness.
                            </p>

                            <div class="mt-6 space-y-3">

                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:bg-green-50/50 transition">
                                    <span class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-syringe"></i>
                                    </span>
                                    <span class="text-gray-700">Maintain a regular vaccination programme.</span>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:bg-green-50/50 transition">
                                    <span class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span class="text-gray-700">Monitor animals for unusual behaviour.</span>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:bg-green-50/50 transition">
                                    <span class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-broom"></i>
                                    </span>
                                    <span class="text-gray-700">Keep housing clean.</span>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:bg-green-50/50 transition">
                                    <span class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-bug-slash"></i>
                                    </span>
                                    <span class="text-gray-700">Control parasites appropriately.</span>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-green-200 hover:bg-green-50/50 transition">
                                    <span class="w-9 h-9 rounded-full bg-green-100 text-green-700 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-house-medical"></i>
                                    </span>
                                    <span class="text-gray-700">Isolate sick animals where necessary.</span>
                                </div>

                            </div>

                        </section>


                        <!-- Section 5 -->
                        <section class="mb-4">

                            <div class="flex items-start gap-4 mb-5">

                                <span class="flex-shrink-0 w-11 h-11 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-extrabold text-lg">
                                    5
                                </span>

                                <div>
                                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                                        Buying and Selling Goats
                                    </h2>

                                    <p class="mt-1 text-sm text-green-700 font-medium">
                                        Make informed decisions when trading
                                    </p>
                                </div>

                            </div>

                            <div class="space-y-4 text-gray-600 leading-8 text-base md:text-lg">

                                <p>
                                    When buying goats, inspect the animal carefully and
                                    ask the seller relevant questions about age, breed,
                                    health and ownership.
                                </p>

                                <p>
                                    Efarmer makes it easier for farmers and buyers to
                                    discover goats available for sale and connect with
                                    sellers.
                                </p>

                            </div>

                        </section>


                        <!-- Efarmer Tip -->
                        <div class="mt-10 relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100 p-6 md:p-7">

                            <div class="absolute -right-8 -top-8 w-28 h-28 rounded-full bg-green-100/60"></div>

                            <div class="relative flex flex-col sm:flex-row gap-5">

                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-green-700 text-white flex items-center justify-center text-xl shadow-sm">
                                    <i class="fa-solid fa-lightbulb"></i>
                                </div>

                                <div>

                                    <span class="inline-block text-xs font-bold uppercase tracking-wider text-green-700 mb-1">
                                        Efarmer Tip
                                    </span>

                                    <h3 class="text-xl font-extrabold text-green-950">
                                        Inspect before you buy
                                    </h3>

                                    <p class="mt-2 text-gray-600 leading-7">
                                        Always inspect an animal carefully before
                                        purchasing it and seek professional
                                        veterinary advice when necessary.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </article>


        <!-- ARTICLE SIDEBAR -->
        <aside class="hidden lg:block">

            <div class="sticky top-24 space-y-5">

                <!-- Quick Navigation -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                    <h3 class="font-extrabold text-gray-900 mb-4">
                        In this guide
                    </h3>

                    <nav class="space-y-1 text-sm">

                        <a href="#section-1"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-green-50 hover:text-green-700 transition">
                            <span class="text-xs font-bold text-green-600">01</span>
                            Choosing a Breed
                        </a>

                        <a href="#section-2"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-green-50 hover:text-green-700 transition">
                            <span class="text-xs font-bold text-green-600">02</span>
                            Proper Housing
                        </a>

                        <a href="#section-3"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-green-50 hover:text-green-700 transition">
                            <span class="text-xs font-bold text-green-600">03</span>
                            Feeding
                        </a>

                        <a href="#section-4"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-green-50 hover:text-green-700 transition">
                            <span class="text-xs font-bold text-green-600">04</span>
                            Health Management
                        </a>

                        <a href="#section-5"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-green-50 hover:text-green-700 transition">
                            <span class="text-xs font-bold text-green-600">05</span>
                            Buying & Selling
                        </a>

                    </nav>

                </div>


                <!-- Marketplace CTA -->
                <div class="rounded-2xl bg-green-900 p-6 text-white overflow-hidden relative">

                    <div class="absolute -right-10 -bottom-10 w-32 h-32 rounded-full bg-green-800"></div>

                    <div class="relative">

                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-goat text-green-200"></i>
                        </div>

                        <h3 class="text-lg font-extrabold">
                            Ready to find goats?
                        </h3>

                        <p class="mt-2 text-sm text-green-100 leading-6">
                            Browse goats listed by farmers on Efarmer.
                        </p>

                        <a
                            href="{{ url('/goats') }}"
                            class="inline-flex items-center gap-2 mt-5 bg-white text-green-900 px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-green-50 transition"
                        >
                            Browse Goats
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                    </div>

                </div>

            </div>

        </aside>

    </div>


    <!-- MOBILE CTA -->
    <div class="mt-8 lg:hidden rounded-3xl bg-green-800 p-7 sm:p-9 text-white">

        <div class="flex items-start gap-4">

            <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-white/10 flex items-center justify-center">
                <i class="fa-solid fa-goat text-green-100 text-xl"></i>
            </div>

            <div>

                <h2 class="text-2xl font-extrabold">
                    Looking for goats?
                </h2>

                <p class="mt-2 text-green-100 leading-6">
                    Browse goats listed by farmers on Efarmer.
                </p>

            </div>

        </div>

        <a
            href="{{ url('/goats') }}"
            class="inline-flex items-center justify-center gap-2 w-full mt-6 bg-white text-green-800 px-6 py-3 rounded-xl font-bold hover:bg-gray-100 transition"
        >
            Browse Available Goats
            <i class="fa-solid fa-arrow-right text-sm"></i>
        </a>

    </div>

</main>
@endsection