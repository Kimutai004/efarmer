@extends('layouts.app')

@section('title', 'How Efarmer Works')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <span class="text-green-300 font-semibold">
            SIMPLE & TRANSPARENT
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold mt-3">
            How Efarmer Works
        </h1>

        <p class="text-green-100 mt-5 max-w-2xl text-lg">
            We make buying and selling goats simple,
            transparent and convenient.
        </p>

    </div>

</section>


<section class="py-20">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid md:grid-cols-4 gap-10">

            @foreach([
                ['icon' => 'fa-magnifying-glass', 'title' => 'Search', 'text' => 'Browse goats from verified farmers across Kenya.'],
                ['icon' => 'fa-comment-dots', 'title' => 'Contact Seller', 'text' => 'Contact the farmer and ask questions about the goat.'],
                ['icon' => 'fa-handshake', 'title' => 'Agree & Pay', 'text' => 'Agree on the price and payment arrangements.'],
                ['icon' => 'fa-truck', 'title' => 'Delivery', 'text' => 'Arrange safe delivery of your goat.']
            ] as $step)

                <div class="text-center">

                    <div class="w-20 h-20 mx-auto rounded-full bg-efarmer-50 border-2 border-efarmer-400 flex items-center justify-center text-efarmer-600 text-3xl">

                        <i class="fa-solid {{ $step['icon'] }}"></i>

                    </div>

                    <h2 class="font-bold text-xl mt-6">
                        {{ $step['title'] }}
                    </h2>

                    <p class="text-gray-500 mt-3 leading-7">
                        {{ $step['text'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>


<section class="bg-gray-50 py-20">

    <div class="max-w-4xl mx-auto px-5 text-center">

        <h2 class="text-3xl font-extrabold text-efarmer-900">
            Built for Kenyan Farmers
        </h2>

        <p class="text-gray-600 mt-5 leading-8">
            Efarmer helps farmers reach more customers while
            giving buyers a convenient way to find quality goats
            based on breed, location, gender and price.
        </p>

    </div>

</section>

@endsection