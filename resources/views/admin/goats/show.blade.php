@extends('admin.layouts.app')

@section('title', $goat->tag_number)
@section('page-title', 'Goat Details')

@section('content')

@php
    $statusClasses = [
        'available' => 'bg-green-100 text-green-700',
        'reserved' => 'bg-orange-100 text-orange-700',
        'sold' => 'bg-blue-100 text-blue-700',
        'archived' => 'bg-gray-100 text-gray-600',
    ];
@endphp

<div class="max-w-6xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <h2 class="text-2xl font-extrabold text-gray-900">{{ $goat->tag_number }}</h2>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClasses[$goat->status] ?? 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($goat->status) }}
                </span>
            </div>
            <p class="mt-1 text-gray-500">{{ $goat->name ?: 'Unnamed goat' }}</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.goats.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('admin.goats.edit', $goat) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-700 text-white rounded-lg font-semibold hover:bg-green-800">
                <i class="fa-solid fa-pen"></i> Edit Goat
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Photos</h3>

            @if($goat->photos->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($goat->photos as $photo)
                        <div class="relative aspect-square overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $goat->tag_number }}" class="w-full h-full object-cover">
                            @if($photo->is_primary)
                                <span class="absolute top-2 left-2 bg-green-700 text-white text-xs px-2 py-1 rounded">Primary</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="h-48 bg-gray-50 rounded-lg flex flex-col items-center justify-center text-gray-400">
                    <i class="fa-solid fa-camera text-3xl mb-2"></i>
                    <p class="text-sm">No photos uploaded</p>
                </div>
            @endif
        </div>

        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Pricing</h3>
            <dl class="space-y-4 text-sm">
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Selling price</dt><dd class="font-bold">KES {{ number_format($goat->selling_price, 0) }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Purchase price</dt><dd class="font-semibold">{{ $goat->purchase_price ? 'KES ' . number_format($goat->purchase_price, 0) : '-' }}</dd></div>
                <div class="flex justify-between gap-4"><dt class="text-gray-500">Featured</dt><dd class="font-semibold">{{ $goat->featured ? 'Yes' : 'No' }}</dd></div>
            </dl>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Goat Information</h3>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                <div><dt class="text-gray-500">Breed</dt><dd class="mt-1 font-semibold">{{ $goat->breed?->name ?? '-' }}</dd></div>
                <div><dt class="text-gray-500">Category</dt><dd class="mt-1 font-semibold">{{ $goat->category }}</dd></div>
                <div><dt class="text-gray-500">Gender</dt><dd class="mt-1 font-semibold">{{ ucfirst($goat->gender) }}</dd></div>
                <div><dt class="text-gray-500">Color</dt><dd class="mt-1 font-semibold">{{ $goat->color ?: '-' }}</dd></div>
                <div><dt class="text-gray-500">Weight</dt><dd class="mt-1 font-semibold">{{ $goat->weight ? $goat->weight . ' kg' : '-' }}</dd></div>
                <div><dt class="text-gray-500">Date of birth</dt><dd class="mt-1 font-semibold">{{ $goat->date_of_birth?->format('d M Y') ?? '-' }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-gray-500">Location</dt><dd class="mt-1 font-semibold">{{ $goat->location ?: '-' }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-gray-500">Description</dt><dd class="mt-1 text-gray-700 whitespace-pre-line">{{ $goat->description ?: '-' }}</dd></div>
            </dl>
        </div>

        <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Recent Weight Records</h3>
            @forelse($goat->weightRecords as $record)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0 text-sm">
                    <div>
                        <p class="font-semibold">{{ $record->weight }} kg</p>
                        <p class="text-gray-500">{{ $record->recorded_at?->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">No weight records available.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">
        <h3 class="font-bold text-gray-900 mb-4">Health Records</h3>
        @forelse($goat->healthRecords as $record)
            <div class="py-4 border-b border-gray-100 last:border-0">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <p class="font-semibold">{{ $record->record_type ?? 'Health record' }}</p>
                    <span class="text-sm text-gray-500">{{ $record->record_date?->format('d M Y') ?? '-' }}</span>
                </div>
                @if($record->description ?? false)
                    <p class="mt-2 text-sm text-gray-600">{{ $record->description }}</p>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-500">No health records available.</p>
        @endforelse
    </div>
</div>

@endsection
