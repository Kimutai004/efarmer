@extends('admin.layouts.app')

@section('title', 'Goats')

@section('page-title', 'Goat Inventory')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h2 class="text-2xl font-extrabold">
                Goat Inventory
            </h2>

            <p class="text-gray-500 mt-1">
                Manage Efarmer's goat stock.
            </p>

        </div>

        <a
            href="{{ route('admin.goats.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-green-700 text-white px-5 py-3 rounded-xl font-bold hover:bg-green-800"
        >
            <i class="fa-solid fa-plus"></i>
            Add Goat
        </a>

    </div>


    <!-- Filters -->

    <div class="bg-white border border-gray-100 rounded-2xl p-5">

        <form
            method="GET"
            class="grid grid-cols-1 md:grid-cols-4 gap-4"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search tag, name, color..."
                class="w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
            >

            <select
                name="status"
                class="rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
            >

                <option value="">
                    All Status
                </option>

                @foreach(['available','reserved','sold','archived'] as $status)

                    <option
                        value="{{ $status }}"
                        @selected(request('status') === $status)
                    >
                        {{ ucfirst($status) }}
                    </option>

                @endforeach

            </select>

            <select
                name="breed_id"
                class="rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
            >

                <option value="">
                    All Breeds
                </option>

                @foreach($breeds as $breed)

                    <option
                        value="{{ $breed->id }}"
                        @selected(request('breed_id') == $breed->id)
                    >
                        {{ $breed->name }}
                    </option>

                @endforeach

            </select>

            <div class="flex gap-2">

                <button
                    class="flex-1 bg-green-700 text-white rounded-xl font-bold"
                >
                    Search
                </button>

                <a
                    href="{{ route('admin.goats.index') }}"
                    class="px-4 flex items-center justify-center rounded-xl bg-gray-100 text-gray-700"
                >
                    <i class="fa-solid fa-rotate-left"></i>
                </a>

            </div>

        </form>

    </div>


    <!-- Table -->

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b border-gray-100">

                    <tr>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Goat
                        </th>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Breed
                        </th>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Gender
                        </th>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Weight
                        </th>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Price
                        </th>

                        <th class="text-left px-6 py-4 font-bold text-gray-500">
                            Status
                        </th>

                        <th class="text-right px-6 py-4 font-bold text-gray-500">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($goats as $goat)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden">

                                        @if($goat->primary_photo)

                                            <img
                                                src="{{ asset('storage/'.$goat->primary_photo->path) }}"
                                                class="w-full h-full object-cover"
                                            >

                                        @else

                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <i class="fa-solid fa-cow"></i>
                                            </div>

                                        @endif

                                    </div>

                                    <div>

                                        <p class="font-extrabold">
                                            {{ $goat->tag_number }}
                                        </p>

                                        <p class="text-gray-500">
                                            {{ $goat->name ?: 'Unnamed goat' }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-4">
                                {{ $goat->breed->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ ucfirst($goat->gender) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $goat->weight ? $goat->weight.' kg' : '—' }}
                            </td>

                            <td class="px-6 py-4 font-bold">
                                KES {{ number_format($goat->selling_price, 0) }}
                            </td>

                            <td class="px-6 py-4">

                                @php

                                    $classes = [
                                        'available' => 'bg-green-100 text-green-700',
                                        'reserved' => 'bg-orange-100 text-orange-700',
                                        'sold' => 'bg-blue-100 text-blue-700',
                                        'archived' => 'bg-gray-100 text-gray-600',
                                    ];

                                @endphp

                                <span class="px-3 py-1.5 rounded-full text-xs font-bold {{ $classes[$goat->status] }}">
                                    {{ ucfirst($goat->status) }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('admin.goats.show', $goat) }}"
                                    class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-green-100 hover:text-green-700"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a
                                    href="{{ route('admin.goats.edit', $goat) }}"
                                    class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-gray-400 text-4xl mb-4">
                                    <i class="fa-solid fa-cow"></i>
                                </div>

                                <p class="font-bold text-gray-700">
                                    No goats found
                                </p>

                                <p class="text-gray-500 text-sm mt-1">
                                    Add your first goat to the inventory.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($goats->hasPages())

            <div class="p-5 border-t border-gray-100">
                {{ $goats->links() }}
            </div>

        @endif

    </div>

</div>

@endsection