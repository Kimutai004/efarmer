@extends('layouts.app')

@section('title', 'About Efarmer')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <span class="text-green-300 font-semibold">
            ABOUT EFARMER
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold mt-3">
            Empowering Farmers Through Technology
        </h1>

    </div>

</section>


<section class="py-20">

    <div class="max-w-6xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <img
                src="https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=1000&q=80"
                class="rounded-2xl h-[450px] w-full object-cover"
                alt="Farmer"
            >

            <div>

                <h2 class="text-3xl font-extrabold text-efarmer-900">
                    Connecting Farmers and Buyers
                </h2>

                <p class="text-gray-600 leading-8 mt-5">
                    Efarmer is a digital marketplace designed to
                    make it easier for farmers to sell livestock
                    and for buyers to find quality goats.
                </p>

                <p class="text-gray-600 leading-8 mt-4">
                    Our platform brings together farmers,
                    breeders and buyers while promoting
                    transparency, convenience and better
                    market access.
                </p>

                <div class="grid grid-cols-2 gap-5 mt-8">

                    <div class="bg-efarmer-50 p-5 rounded-xl">
                        <div class="text-3xl font-extrabold text-efarmer-600">
                            1,000+
                        </div>
                        <p class="text-gray-600 mt-1">
                            Farmers
                        </p>
                    </div>

                    <div class="bg-efarmer-50 p-5 rounded-xl">
                        <div class="text-3xl font-extrabold text-efarmer-600">
                            5,000+
                        </div>
                        <p class="text-gray-600 mt-1">
                            Listings
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection