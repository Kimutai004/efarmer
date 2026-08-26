@extends('layouts.app')

@section('title', 'Contact Efarmer')

@section('content')

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-16">

        <h1 class="text-4xl md:text-5xl font-extrabold">
            Contact Us
        </h1>

        <p class="text-green-100 mt-4">
            We are here to help buyers and farmers.
        </p>

    </div>

</section>


<section class="py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-3 gap-8">


            <div class="space-y-5">

                <div class="bg-white border rounded-xl p-6">

                    <i class="fa-solid fa-phone text-efarmer-600 text-2xl"></i>

                    <h3 class="font-bold mt-4">
                        Call Us
                    </h3>

                    <p class="text-gray-500 mt-2">
                        +254 712 345 678
                    </p>

                </div>


                <div class="bg-white border rounded-xl p-6">

                    <i class="fa-solid fa-envelope text-efarmer-600 text-2xl"></i>

                    <h3 class="font-bold mt-4">
                        Email
                    </h3>

                    <p class="text-gray-500 mt-2">
                        support@efarmer.co.ke
                    </p>

                </div>


                <div class="bg-white border rounded-xl p-6">

                    <i class="fa-solid fa-location-dot text-efarmer-600 text-2xl"></i>

                    <h3 class="font-bold mt-4">
                        Location
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Nairobi, Kenya
                    </p>

                </div>

            </div>


            <div class="lg:col-span-2 bg-white border rounded-xl p-8">

                <h2 class="text-2xl font-bold">
                    Send us a message
                </h2>

                <form class="mt-7 space-y-5">

                    <div class="grid md:grid-cols-2 gap-5">

                        <input
                            type="text"
                            placeholder="Your name"
                            class="border rounded-lg px-4 py-3"
                        >

                        <input
                            type="email"
                            placeholder="Email address"
                            class="border rounded-lg px-4 py-3"
                        >

                    </div>


                    <input
                        type="text"
                        placeholder="Subject"
                        class="w-full border rounded-lg px-4 py-3"
                    >


                    <textarea
                        rows="6"
                        placeholder="Your message"
                        class="w-full border rounded-lg px-4 py-3"
                    ></textarea>


                    <button
                        class="bg-efarmer-600 hover:bg-efarmer-700 text-white px-8 py-3 rounded-lg font-bold"
                    >
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection