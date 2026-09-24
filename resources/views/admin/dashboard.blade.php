@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-8">

    <!-- Header -->

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <p class="text-sm text-gray-500">
                {{ now()->format('l, F d, Y') }}
            </p>

            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-1">
                Welcome back, {{ auth()->user()->name }}
            </h2>

            <p class="text-gray-500 mt-1">
                Here's what's happening with your goat business.
            </p>

        </div>

        <a
            href="{{ route('admin.goats.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-green-700 text-white font-bold hover:bg-green-800 transition"
        >
            <i class="fa-solid fa-plus"></i>
            Add Goat
        </a>

    </div>


    <!-- Statistics -->

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Goats
                    </p>

                    <h3 class="text-3xl font-extrabold mt-2">
                        {{ number_format($totalGoats) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center">
                    <i class="fa-solid fa-cow text-xl"></i>
                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Available
                    </p>

                    <h3 class="text-3xl font-extrabold mt-2">
                        {{ number_format($availableGoats) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Goats Sold
                    </p>

                    <h3 class="text-3xl font-extrabold mt-2">
                        {{ number_format($soldGoats) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                </div>

            </div>

        </div>


        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Customers
                    </p>

                    <h3 class="text-3xl font-extrabold mt-2">
                        {{ number_format($customers) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-700 flex items-center justify-center">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- Financial Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-green-900 text-white rounded-2xl p-6">

            <p class="text-green-200 text-sm">
                Total Sales
            </p>

            <p class="text-3xl font-extrabold mt-2">
                KES {{ number_format($totalSales, 2) }}
            </p>

        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6">

            <p class="text-gray-500 text-sm">
                Amount Collected
            </p>

            <p class="text-3xl font-extrabold mt-2 text-green-700">
                KES {{ number_format($totalPaid, 2) }}
            </p>

        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6">

            <p class="text-gray-500 text-sm">
                Outstanding
            </p>

            <p class="text-3xl font-extrabold mt-2 text-orange-600">
                KES {{ number_format($outstanding, 2) }}
            </p>

        </div>

        <div class="bg-white border border-gray-100 rounded-2xl p-6">

            <p class="text-gray-500 text-sm">
                Estimated Profit
            </p>

            <p class="text-3xl font-extrabold mt-2 text-blue-700">
                KES {{ number_format($profit, 2) }}
            </p>

        </div>

    </div>


    <!-- Recent Sales + Goat Inventory -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Sales -->

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">

            <div class="p-6 border-b border-gray-100 flex items-center justify-between">

                <div>

                    <h3 class="font-extrabold text-gray-900">
                        Recent Sales
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Latest goat transactions
                    </p>

                </div>

                <a
                    href="{{ route('admin.sales.index') }}"
                    class="text-sm font-bold text-green-700 hover:text-green-900"
                >
                    View all
                </a>

            </div>

            <div class="divide-y divide-gray-100">

                @forelse($recentSales as $sale)

                    <a
                        href="{{ route('admin.sales.show', $sale) }}"
                        class="flex items-center justify-between p-5 hover:bg-gray-50 transition"
                    >

                        <div>

                            <p class="font-bold text-gray-900">
                                {{ $sale->invoice_number }}
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $sale->customer->name }}
                            </p>

                        </div>

                        <div class="text-right">

                            <p class="font-extrabold text-gray-900">
                                KES {{ number_format($sale->total, 2) }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1">
                                {{ $sale->sale_date->format('d M Y') }}
                            </p>

                        </div>

                    </a>

                @empty

                    <div class="p-8 text-center text-gray-500">
                        No sales recorded yet.
                    </div>

                @endforelse

            </div>

        </div>


        <!-- Goats -->

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">

            <div class="p-6 border-b border-gray-100 flex items-center justify-between">

                <div>

                    <h3 class="font-extrabold text-gray-900">
                        Recent Goats
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Latest livestock inventory
                    </p>

                </div>

                <a
                    href="{{ route('admin.goats.index') }}"
                    class="text-sm font-bold text-green-700"
                >
                    View all
                </a>

            </div>

            <div class="divide-y divide-gray-100">

                @forelse($recentGoats as $goat)

                    <a
                        href="{{ route('admin.goats.show', $goat) }}"
                        class="flex items-center gap-4 p-5 hover:bg-gray-50 transition"
                    >

                        <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">

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

                        <div class="flex-1">

                            <p class="font-bold">
                                {{ $goat->tag_number }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $goat->breed->name ?? 'Unknown' }}
                                &middot;
                                {{ ucfirst($goat->gender) }}
                            </p>

                        </div>

                        <div class="text-right">

                            <p class="font-extrabold">
                                KES {{ number_format($goat->selling_price, 0) }}
                            </p>

                            <span class="text-xs font-bold text-green-700">
                                {{ ucfirst($goat->status) }}
                            </span>
                        </div>
                    </a>
                @empty

                    <div class="p-8 text-center text-gray-500">
                        No goats added yet.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection