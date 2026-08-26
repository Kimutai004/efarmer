@extends('layouts.app')

@section('title', 'Goat Details | Efarmer')

@section('content')

@php

    $goat = [
        'name' => 'Premium Boer Male Goat',
        'breed' => 'Boer',
        'location' => 'Nakuru, Kenya',
        'gender' => 'Male',
        'age' => '1 Year',
        'weight' => '45kg',
        'price' => 18000,
        'seller' => 'John Kamau',
        'phone' => '+254 712 345 678',
        'description' => 'Healthy Boer goat suitable for breeding and meat production. The goat is active, well-fed and kept under good farm management practices.',
        'image' => 'https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=1200&q=90'
    ];

@endphp


<section class="bg-gray-50 py-12">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-12 bg-white rounded-2xl overflow-hidden border">


            <!-- IMAGE -->

            <div>

                <img
                    src="{{ $goat['image'] }}"
                    alt="{{ $goat['name'] }}"
                    class="w-full h-[500px] object-cover"
                >

            </div>


            <!-- DETAILS -->

            <div class="p-8 lg:p-12">

                <span class="bg-efarmer-100 text-efarmer-700 px-3 py-1.5 rounded-md text-sm font-bold">
                    Verified Listing
                </span>


                <h1 class="text-4xl font-extrabold text-efarmer-900 mt-5">
                    {{ $goat['name'] }}
                </h1>


                <p class="text-gray-500 mt-3">
                    <i class="fa-solid fa-location-dot text-efarmer-600"></i>
                    {{ $goat['location'] }}
                </p>


                <div class="text-4xl font-extrabold text-efarmer-600 mt-7">
                    KSh {{ number_format($goat['price']) }}
                </div>


                <div class="grid grid-cols-2 gap-4 mt-8">

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="text-gray-500 text-sm">
                            Breed
                        </span>

                        <p class="font-bold mt-1">
                            {{ $goat['breed'] }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="text-gray-500 text-sm">
                            Gender
                        </span>

                        <p class="font-bold mt-1">
                            {{ $goat['gender'] }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="text-gray-500 text-sm">
                            Age
                        </span>

                        <p class="font-bold mt-1">
                            {{ $goat['age'] }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <span class="text-gray-500 text-sm">
                            Weight
                        </span>

                        <p class="font-bold mt-1">
                            {{ $goat['weight'] }}
                        </p>
                    </div>

                </div>


                <h2 class="font-bold text-xl mt-8">
                    About this goat
                </h2>

                <p class="text-gray-600 leading-7 mt-3">
                    {{ $goat['description'] }}
                </p>


                <div class="border-t mt-8 pt-7">

                    <p class="text-sm text-gray-500">
                        Seller
                    </p>

                    <p class="font-bold text-lg">
                        {{ $goat['seller'] }}
                    </p>


                    <div class="flex gap-3 mt-5">

                        <a
                            href="tel:{{ $goat['phone'] }}"
                            class="flex-1 bg-efarmer-600 text-white text-center py-3 rounded-lg font-bold"
                        >
                            <i class="fa-solid fa-phone mr-2"></i>
                            Call Seller
                        </a>

                        <a
                            href="https://wa.me/254712345678"
                            class="flex-1 bg-green-100 text-green-800 text-center py-3 rounded-lg font-bold"
                        >
                            <i class="fa-brands fa-whatsapp mr-2"></i>
                            WhatsApp
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection