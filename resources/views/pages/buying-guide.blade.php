@extends('layouts.app')

@section('title', 'Goat Buying Guide | What to Check Before You Buy')
@section('description', 'Five things to check before buying a goat in Kenya — health, breed, age and weight, vaccination records and seller trust.')

@section('content')

@include('partials.page-hero', [
    'eyebrow' => 'Buy with confidence',
    'title' => 'Goat Buying Guide',
    'subtitle' => 'Five checks that separate a good goat from a costly mistake.',
    'image' => 'WhatsApp Image 2026-08-27 at 13.12.18 (1).jpeg',
    'crumb' => 'Buying guide',
])

<section class="py-16 lg:py-20">

    <div class="max-w-4xl mx-auto px-5 lg:px-8">

        <div class="space-y-6">

            @foreach([
                ['icon' => 'fa-stethoscope', 'title' => 'Check the goat’s health', 'text' => 'Look for a bright, alert animal with clear eyes, a smooth coat and steady movement. Avoid dull animals with discharge, limping or a rough patchy coat.'],
                ['icon' => 'fa-dna', 'title' => 'Pick the breed for your goal', 'text' => 'Choose dairy breeds like Saanen or Alpine for milk, Boer and Galla for meat, and hardy local breeds for dry areas. The right breed keeps feed and vet costs in check.'],
                ['icon' => 'fa-weight-scale', 'title' => 'Check age and weight', 'text' => 'Age and live weight tell you whether the price is fair. Compare the price per kilogram with similar listings on Efarmer before you commit.'],
                ['icon' => 'fa-syringe', 'title' => 'Ask about vaccination', 'text' => 'Ask for vaccination and deworming records — ideally CCPP and enterotoxaemia for the area. Recorded animals are worth more because they are safer.'],
                ['icon' => 'fa-shield-halved', 'title' => 'Buy with confidence', 'text' => 'Every goat is checked by the Efarmer team before it goes live, and payments settle through M-Pesa with an instant receipt.'],
            ] as $index => $item)

                <div class="card-soft lift p-7 sm:p-8 flex flex-col sm:flex-row gap-6" data-reveal>

                    <div class="flex sm:flex-col items-center gap-4 sm:gap-3 flex-shrink-0">

                        <span class="w-14 h-14 rounded-2xl bg-efarmer-600 text-white flex items-center justify-center text-xl">
                            <i class="fa-solid {{ $item['icon'] }}"></i>
                        </span>

                        <span class="font-display text-sm font-extrabold text-clay-500">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                    </div>

                    <div>
                        <h2 class="font-display text-xl font-extrabold text-efarmer-900">
                            {{ $item['title'] }}
                        </h2>

                        <p class="text-gray-600 mt-3 leading-8">
                            {{ $item['text'] }}
                        </p>
                    </div>

                </div>

            @endforeach

        </div>

        <div class="relative overflow-hidden rounded-4xl bg-efarmer-900 text-white p-10 mt-12 text-center">

            <div class="absolute inset-0 noise-dots opacity-25"></div>

            <div class="relative">

                <h2 class="font-display text-2xl font-extrabold">
                    Ready to find a verified goat?
                </h2>

                <p class="text-white/70 mt-3">
                    Every Efarmer goat already passes these checks.
                </p>

                <a href="{{ route('goats.index') }}" class="btn btn-lg btn-accent mt-7">
                    <i class="fa-solid fa-cow"></i>
                    Browse verified goats
                </a>

            </div>

        </div>

    </div>

</section>

@endsection
