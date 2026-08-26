@extends('layouts.app')

@section('title', 'Goat Buying Guide | Efarmer')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <h1 class="text-4xl md:text-5xl font-extrabold">
            Goat Buying Guide
        </h1>

        <p class="text-green-100 mt-5 max-w-2xl text-lg">
            Important things to consider before buying a goat.
        </p>

    </div>

</section>


<section class="py-16">

    <div class="max-w-4xl mx-auto px-5">

        <div class="space-y-6">

            @foreach([
                ['title' => '1. Check the goat’s health', 'text' => 'Look for an active goat with clear eyes, a healthy coat and normal movement.'],
                ['title' => '2. Consider the breed', 'text' => 'Choose a breed based on whether you want meat, milk, breeding or other purposes.'],
                ['title' => '3. Check age and weight', 'text' => 'Age and weight can help you determine whether the asking price is reasonable.'],
                ['title' => '4. Ask about vaccination', 'text' => 'Ask the seller for available vaccination and health records.'],
                ['title' => '5. Verify the seller', 'text' => 'Whenever possible, buy from verified sellers and communicate through Efarmer.']
            ] as $item)

                <div class="border rounded-xl p-6">

                    <h2 class="text-xl font-bold text-efarmer-900">
                        {{ $item['title'] }}
                    </h2>

                    <p class="text-gray-600 mt-3 leading-7">
                        {{ $item['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection