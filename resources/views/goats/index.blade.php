@extends('layouts.app')

@section('title', 'Goats for Sale | Efarmer')

@section('description', 'Find quality goats for sale from verified farmers across Kenya.')

@section('content')

<!-- PAGE HEADER -->

<section class="bg-efarmer-900 text-white">

    <div class="max-w-7xl mx-auto px-5 lg:px-8 py-16">

        <span class="text-green-300 font-semibold">
            EFARMER MARKETPLACE
        </span>

        <h1 class="text-4xl md:text-5xl font-extrabold mt-3">
            Goats for Sale
        </h1>

        <p class="text-green-100 mt-4 max-w-2xl">
            Find healthy, quality goats from verified farmers
            across Kenya.
        </p>

    </div>

</section>


<!-- MARKETPLACE -->

<section class="py-14 bg-gray-50">

    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="grid lg:grid-cols-4 gap-8">


            <!-- FILTERS -->

            <aside class="bg-white rounded-xl border p-6 h-fit">

                <h2 class="font-bold text-xl mb-6">
                    Filter Goats
                </h2>

                <form>

                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            placeholder="Search goats..."
                            class="w-full mt-2 border rounded-lg px-4 py-3"
                        >

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Breed
                        </label>

                        <select class="w-full mt-2 border rounded-lg px-4 py-3">

                            <option>All Breeds</option>
                            <option>Boer</option>
                            <option>Galla</option>
                            <option>Alpine</option>
                            <option>Saanen</option>
                            <option>Toggenburg</option>

                        </select>

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            County
                        </label>

                        <select class="w-full mt-2 border rounded-lg px-4 py-3">

                            <option>All Counties</option>
                            <option>Nairobi</option>
                            <option>Nakuru</option>
                            <option>Kiambu</option>
                            <option>Machakos</option>
                            <option>Kajiado</option>
                            <option>Nyeri</option>

                        </select>

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Gender
                        </label>

                        <div class="mt-3 space-y-2">

                            <label class="flex gap-2">
                                <input type="radio" name="gender">
                                Male
                            </label>

                            <label class="flex gap-2">
                                <input type="radio" name="gender">
                                Female
                            </label>

                        </div>

                    </div>


                    <div class="mb-6">

                        <label class="font-semibold text-sm">
                            Maximum Price
                        </label>

                        <input
                            type="number"
                            placeholder="KSh"
                            class="w-full mt-2 border rounded-lg px-4 py-3"
                        >

                    </div>


                    <button
                        class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-3 rounded-lg font-bold"
                    >
                        Apply Filters
                    </button>

                </form>

            </aside>


            <!-- RESULTS -->

            <div class="lg:col-span-3">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-2xl font-bold">
                            Available Goats
                        </h2>

                        <p class="text-gray-500 text-sm mt-1">
                            124 goats available
                        </p>

                    </div>


                    <select class="border rounded-lg px-4 py-2">

                        <option>Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>

                    </select>

                </div>


                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">


                    @php

                        $goats = [
                            [
                                'id' => 1,
                                'name' => 'Boer Male Goat',
                                'breed' => 'Boer',
                                'location' => 'Nakuru',
                                'gender' => 'Male',
                                'age' => '1 Year',
                                'weight' => '45kg',
                                'price' => 18000,
                                'image' => 'https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=700&q=80'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Alpine Female Goat',
                                'breed' => 'Alpine',
                                'location' => 'Kiambu',
                                'gender' => 'Female',
                                'age' => '1.5 Years',
                                'weight' => '40kg',
                                'price' => 15500,
                                'image' => 'https://images.unsplash.com/photo-1551884831-bbf3cdc6469e?auto=format&fit=crop&w=700&q=80'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Galla Buck',
                                'breed' => 'Galla',
                                'location' => 'Machakos',
                                'gender' => 'Male',
                                'age' => '1 Year',
                                'weight' => '50kg',
                                'price' => 20000,
                                'image' => 'https://images.unsplash.com/photo-1516467508483-a7212febe31a?auto=format&fit=crop&w=700&q=80'
                            ],
                            [
                                'id' => 4,
                                'name' => 'Saanen Female',
                                'breed' => 'Saanen',
                                'location' => 'Nyeri',
                                'gender' => 'Female',
                                'age' => '1 Year',
                                'weight' => '38kg',
                                'price' => 16500,
                                'image' => 'https://images.unsplash.com/photo-1548247416-ec66f4900b2e?auto=format&fit=crop&w=700&q=80'
                            ],
                            [
                                'id' => 5,
                                'name' => 'Premium Boer Buck',
                                'breed' => 'Boer',
                                'location' => 'Kajiado',
                                'gender' => 'Male',
                                'age' => '2 Years',
                                'weight' => '65kg',
                                'price' => 35000,
                                'image' => 'https://images.unsplash.com/photo-1533318087102-b3ad366ed041?auto=format&fit=crop&w=700&q=80'
                            ],
                            [
                                'id' => 6,
                                'name' => 'Healthy Dairy Goat',
                                'breed' => 'Alpine',
                                'location' => 'Nairobi',
                                'gender' => 'Female',
                                'age' => '2 Years',
                                'weight' => '42kg',
                                'price' => 22000,
                                'image' => 'https://images.unsplash.com/photo-1500595046743-cd271d694d30?auto=format&fit=crop&w=700&q=80'
                            ]
                        ];

                    @endphp


                    @foreach($goats as $goat)

                        <article class="card-hover bg-white rounded-xl overflow-hidden border">

                            <div class="relative h-52 overflow-hidden">

                                <img
                                    src="{{ $goat['image'] }}"
                                    alt="{{ $goat['name'] }}"
                                    class="goat-image w-full h-full object-cover"
                                >

                                <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                                    For Sale
                                </span>

                                <button class="absolute top-3 right-3 bg-white w-9 h-9 rounded-full">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                            </div>


                            <div class="p-5">

                                <h3 class="font-bold text-lg">
                                    {{ $goat['name'] }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-2">
                                    <i class="fa-solid fa-location-dot text-efarmer-600"></i>
                                    {{ $goat['location'] }}, Kenya
                                </p>


                                <div class="flex flex-wrap gap-2 mt-3">

                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                        {{ $goat['breed'] }}
                                    </span>

                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                        {{ $goat['gender'] }}
                                    </span>

                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                        {{ $goat['weight'] }}
                                    </span>

                                </div>


                                <div class="text-2xl font-extrabold text-efarmer-600 mt-4">
                                    KSh {{ number_format($goat['price']) }}
                                </div>


                                <a
                                    href="{{ route('goats.show', $goat['id']) }}"
                                    class="block text-center mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg font-semibold"
                                >
                                    View Details
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</section>

@endsection