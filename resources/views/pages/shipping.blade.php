@extends('layouts.app')

@section('title', 'Shipping & Delivery | Efarmer')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        <h1 class="text-4xl md:text-5xl font-extrabold">
            Shipping & Delivery
        </h1>

        <p class="text-green-100 mt-4">
            Safe and convenient livestock delivery across Kenya.
        </p>

    </div>

</section>


<section class="py-16">

    <div class="max-w-5xl mx-auto px-5">

        <div class="grid md:grid-cols-3 gap-7">

            <div class="border rounded-xl p-7">

                <i class="fa-solid fa-location-dot text-efarmer-600 text-3xl"></i>

                <h2 class="font-bold text-xl mt-5">
                    Delivery Location
                </h2>

                <p class="text-gray-600 mt-3 leading-7">
                    Buyers and sellers agree on the delivery
                    location before transportation.
                </p>

            </div>


            <div class="border rounded-xl p-7">

                <i class="fa-solid fa-truck text-efarmer-600 text-3xl"></i>

                <h2 class="font-bold text-xl mt-5">
                    Transportation
                </h2>

                <p class="text-gray-600 mt-3 leading-7">
                    Livestock should be transported using
                    suitable and safe transportation.
                </p>

            </div>


            <div class="border rounded-xl p-7">

                <i class="fa-solid fa-shield-heart text-efarmer-600 text-3xl"></i>

                <h2 class="font-bold text-xl mt-5">
                    Safe Delivery
                </h2>

                <p class="text-gray-600 mt-3 leading-7">
                    Delivery should prioritize the health
                    and welfare of the goat.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection