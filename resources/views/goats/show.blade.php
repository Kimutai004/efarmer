@extends('layouts.app')

@section('title', ($goat->name ?? $goat->tag_number) . ' | Efarmer')
@section('description', $goat->description ?? 'View this quality goat for sale on Efarmer.')

@section('content')

<section class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-efarmer-600">Home</a>
            <i class="fa-solid fa-chevron-right text-xs mx-2"></i>
            <a href="{{ route('goats.index') }}" class="hover:text-efarmer-600">Goats</a>
            <i class="fa-solid fa-chevron-right text-xs mx-2"></i>
            <span class="text-gray-900">{{ $goat->name ?? $goat->tag_number }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- Photos -->
            <div>
                <div class="bg-white rounded-2xl border overflow-hidden">
                    @if($goat->primary_photo)
                        <img src="{{ asset('storage/'.$goat->primary_photo->path) }}" class="w-full h-96 object-cover" alt="{{ $goat->name ?? $goat->tag_number }}" id="mainPhoto">
                    @else
                        <img src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=800&q=80" class="w-full h-96 object-cover" alt="{{ $goat->name ?? $goat->tag_number }}" id="mainPhoto">
                    @endif
                </div>

                @if($goat->photos->count() > 1)
                    <div class="flex gap-3 mt-4">
                        @foreach($goat->photos as $photo)
                            <img src="{{ asset('storage/'.$photo->path) }}" class="w-20 h-20 rounded-lg object-cover cursor-pointer border-2 border-transparent hover:border-efarmer-500" onclick="document.getElementById('mainPhoto').src=this.src">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Details -->
            <div>
                <div class="bg-white rounded-2xl border p-8">

                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ ucfirst($goat->status) }}
                        </span>
                        @if($goat->featured)
                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">
                                <i class="fa-solid fa-star"></i> Featured
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-extrabold text-gray-900">{{ $goat->name ?? $goat->tag_number }}</h1>

                    <p class="text-gray-500 mt-2">
                        <i class="fa-solid fa-location-dot text-efarmer-600"></i>
                        {{ $goat->location ?? 'Kenya' }}
                    </p>

                    <div class="text-4xl font-extrabold text-efarmer-600 mt-4">
                        KSh {{ number_format($goat->selling_price) }}
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-8">

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Breed</p>
                            <p class="font-bold mt-1">{{ $goat->breed->name ?? 'Unknown' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Gender</p>
                            <p class="font-bold mt-1">{{ ucfirst($goat->gender) }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Weight</p>
                            <p class="font-bold mt-1">{{ $goat->weight ? $goat->weight . ' kg' : 'N/A' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Category</p>
                            <p class="font-bold mt-1">{{ $goat->category ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Color</p>
                            <p class="font-bold mt-1">{{ $goat->color ?? 'N/A' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-xs text-gray-500 uppercase">Date of Birth</p>
                            <p class="font-bold mt-1">{{ $goat->date_of_birth ? $goat->date_of_birth->format('M Y') : 'N/A' }}</p>
                        </div>

                    </div>

                    @if($goat->description)
                        <div class="mt-6">
                            <h3 class="font-bold text-lg">Description</h3>
                            <p class="text-gray-600 mt-2 leading-relaxed">{{ $goat->description }}</p>
                        </div>
                    @endif

                    @if($goat->status === 'available')
                        <a href="{{ route('checkout', $goat) }}" class="mt-8 w-full bg-efarmer-600 hover:bg-efarmer-700 text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-3 transition">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Buy Now - Pay with M-Pesa
                        </a>
                    @else
                        <div class="mt-8 w-full bg-gray-200 text-gray-600 py-4 rounded-xl font-bold text-lg text-center">
                            This goat is {{ $goat->status }}
                        </div>
                    @endif

                </div>
            </div>

        </div>

        <!-- Related Goats -->
        @if($relatedGoats->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Related Goats</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedGoats as $related)
                        <article class="card-hover bg-white rounded-xl overflow-hidden border">
                            <div class="relative h-48 overflow-hidden">
                                @if($related->primary_photo)
                                    <img src="{{ asset('storage/'.$related->primary_photo->path) }}" class="goat-image w-full h-full object-cover" alt="{{ $related->name ?? $related->tag_number }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1524024973431-2ad916746881?auto=format&fit=crop&w=700&q=80" class="goat-image w-full h-full object-cover" alt="{{ $related->name ?? $related->tag_number }}">
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold">{{ $related->name ?? $related->tag_number }}</h3>
                                <p class="text-efarmer-600 font-extrabold mt-2">KSh {{ number_format($related->selling_price) }}</p>
                                <a href="{{ route('goats.show', $related) }}" class="mt-3 block text-center bg-efarmer-50 hover:bg-efarmer-100 text-efarmer-700 py-2 rounded-lg font-semibold text-sm">
                                    View Details
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@endsection