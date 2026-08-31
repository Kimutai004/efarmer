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

                <form action="{{ route('goats.index') }}" method="GET">

                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search goats..."
                            class="w-full mt-2 border rounded-lg px-4 py-3"
                        >

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Breed
                        </label>

                        <select name="breed_id" class="w-full mt-2 border rounded-lg px-4 py-3">

                            <option value="">All Breeds</option>
                            @foreach($breeds as $breed)
                                <option value="{{ $breed->id }}" {{ request('breed_id') == $breed->id ? 'selected' : '' }}>{{ $breed->name }}</option>
                            @endforeach

                        </select>

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            County
                        </label>

                        <select name="location" class="w-full mt-2 border rounded-lg px-4 py-3">

                            <option value="">All Counties</option>
                            <option value="Nairobi" {{ request('location') == 'Nairobi' ? 'selected' : '' }}>Nairobi</option>
                            <option value="Nakuru" {{ request('location') == 'Nakuru' ? 'selected' : '' }}>Nakuru</option>
                            <option value="Kiambu" {{ request('location') == 'Kiambu' ? 'selected' : '' }}>Kiambu</option>
                            <option value="Machakos" {{ request('location') == 'Machakos' ? 'selected' : '' }}>Machakos</option>
                            <option value="Kajiado" {{ request('location') == 'Kajiado' ? 'selected' : '' }}>Kajiado</option>
                            <option value="Nyeri" {{ request('location') == 'Nyeri' ? 'selected' : '' }}>Nyeri</option>

                        </select>

                    </div>


                    <div class="mb-5">

                        <label class="font-semibold text-sm">
                            Gender
                        </label>

                        <div class="mt-3 space-y-2">

                            <label class="flex gap-2">
                                <input type="radio" name="gender" value="male" {{ request('gender') == 'male' ? 'checked' : '' }}>
                                Male
                            </label>

                            <label class="flex gap-2">
                                <input type="radio" name="gender" value="female" {{ request('gender') == 'female' ? 'checked' : '' }}>
                                Female
                            </label>

                        </div>

                    </div>


                    <div class="mb-6">

                        <label class="font-semibold text-sm">
                            Maximum Price
                        </label>

                        <select name="max_price" class="w-full mt-2 border rounded-lg px-4 py-3">
                            <option value="">Any Price</option>
                            <option value="10000" {{ request('max_price') == '10000' ? 'selected' : '' }}>KSh 10,000</option>
                            <option value="15000" {{ request('max_price') == '15000' ? 'selected' : '' }}>KSh 15,000</option>
                            <option value="20000" {{ request('max_price') == '20000' ? 'selected' : '' }}>KSh 20,000</option>
                            <option value="30000" {{ request('max_price') == '30000' ? 'selected' : '' }}>KSh 30,000</option>
                            <option value="50000" {{ request('max_price') == '50000' ? 'selected' : '' }}>KSh 50,000</option>
                            <option value="100000" {{ request('max_price') == '100000' ? 'selected' : '' }}>KSh 100,000</option>
                        </select>

                    </div>


                    <button
                        type="submit"
                        class="w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-3 rounded-lg font-bold"
                    >
                        Apply Filters
                    </button>

                    <a
                        href="{{ route('goats.index') }}"
                        class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700"
                    >
                        Clear Filters
                    </a>

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
                            {{ $goats->total() }} goats available
                        </p>

                    </div>


                    <select class="border rounded-lg px-4 py-2" onchange="window.location.href=this.value">
                        <option value="{{ route('goats.index', array_merge(request()->query(), ['sort' => 'newest'])) }}">Newest</option>
                        <option value="{{ route('goats.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}">Price: Low to High</option>
                        <option value="{{ route('goats.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}">Price: High to Low</option>
                    </select>

                </div>


                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">


                    @forelse($goats as $goat)

                        <article class="card-hover bg-white rounded-xl overflow-hidden border">

                            <div class="relative h-52 overflow-hidden">

                                @if($goat->primary_photo)
                                    <img src="{{ asset('storage/'.$goat->primary_photo->path) }}" alt="{{ $goat->name ?? $goat->tag_number }}" class="goat-image w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=700&q=80" alt="{{ $goat->name ?? $goat->tag_number }}" class="goat-image w-full h-full object-cover">
                                @endif

                                <span class="absolute top-3 left-3 bg-efarmer-600 text-white text-xs px-3 py-1.5 rounded-md font-bold">
                                    For Sale
                                </span>

                                <button class="absolute top-3 right-3 bg-white w-9 h-9 rounded-full">
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                            </div>


                            <div class="p-5">

                                <h3 class="font-bold text-lg">
                                    {{ $goat->name ?? $goat->tag_number }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-2">
                                    <i class="fa-solid fa-location-dot text-efarmer-600"></i>
                                    {{ $goat->location ?? 'Kenya' }}
                                </p>


                                <div class="flex flex-wrap gap-2 mt-3">

                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                        {{ $goat->breed->name ?? 'Unknown' }}
                                    </span>

                                    <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                        {{ ucfirst($goat->gender) }}
                                    </span>

                                    @if($goat->weight)
                                        <span class="bg-gray-100 px-2 py-1 text-xs rounded">
                                            {{ $goat->weight }}kg
                                        </span>
                                    @endif

                                </div>


                                <div class="text-2xl font-extrabold text-efarmer-600 mt-4">
                                    KSh {{ number_format($goat->selling_price) }}
                                </div>


                                <a
                                    href="{{ route('goats.show', $goat) }}"
                                    class="block text-center mt-4 bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-3 rounded-lg font-semibold"
                                >
                                    View Details
                                </a>

                            </div>

                        </article>

                    @empty

                        <div class="col-span-full text-center py-12">
                            <i class="fa-solid fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">No goats found matching your criteria.</p>
                            <a href="{{ route('goats.index') }}" class="text-efarmer-600 font-semibold mt-2 inline-block">Clear filters</a>
                        </div>

                    @endforelse

                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $goats->links() }}
                </div>

            </div>

        </div>

    </div>

</section>

@endsection