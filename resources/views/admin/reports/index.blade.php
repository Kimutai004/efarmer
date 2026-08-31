@extends('admin.layouts.app')

@section('title', 'Reports')

@section('page-title', 'Reports')

@section('content')

<div class="space-y-6">

    <div>

        <h2 class="text-2xl font-extrabold">
            Business Reports
        </h2>

        <p class="text-gray-500 mt-1">
            Monitor sales, expenses, revenue and inventory.
        </p>

    </div>


    <form
        method="GET"
        class="bg-white rounded-2xl border border-gray-100 p-5 grid grid-cols-1 md:grid-cols-3 gap-4"
    >

        <div>

            <label class="text-sm font-bold">
                From
            </label>

            <input
                type="date"
                name="from"
                value="{{ $from }}"
                class="w-full mt-2 rounded-xl border-gray-200"
            >

        </div>

        <div>

            <label class="text-sm font-bold">
                To
            </label>

            <input
                type="date"
                name="to"
                value="{{ $to }}"
                class="w-full mt-2 rounded-xl border-gray-200"
            >

        </div>

        <div class="flex items-end">

            <button class="w-full py-3 rounded-xl bg-green-700 text-white font-bold">
                Generate Report
            </button>

        </div>

    </form>


    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5">

        <div class="bg-white p-6 rounded-2xl border">
            <p class="text-sm text-gray-500">Revenue</p>
            <p class="text-2xl font-extrabold mt-2">
                KES {{ number_format($revenue, 0) }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border">
            <p class="text-sm text-gray-500">Collected</p>
            <p class="text-2xl font-extrabold text-green-700 mt-2">
                KES {{ number_format($paid, 0) }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border">
            <p class="text-sm text-gray-500">Outstanding</p>
            <p class="text-2xl font-extrabold text-orange-600 mt-2">
                KES {{ number_format($outstanding, 0) }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border">
            <p class="text-sm text-gray-500">Expenses</p>
            <p class="text-2xl font-extrabold text-red-600 mt-2">
                KES {{ number_format($expenseTotal, 0) }}
            </p>
        </div>

        <div class="bg-green-900 text-white p-6 rounded-2xl">
            <p class="text-sm text-green-200">Profit</p>
            <p class="text-2xl font-extrabold mt-2">
                KES {{ number_format($profit, 0) }}
            </p>
        </div>

    </div>


    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="font-extrabold">
                Sales Report
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4">
                            Invoice
                        </th>

                        <th class="text-left px-6 py-4">
                            Customer
                        </th>

                        <th class="text-left px-6 py-4">
                            Date
                        </th>

                        <th class="text-left px-6 py-4">
                            Goats
                        </th>

                        <th class="text-right px-6 py-4">
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($sales as $sale)

                        <tr>

                            <td class="px-6 py-4 font-bold">
                                {{ $sale->invoice_number }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->customer->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->sale_date->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->items->count() }}
                            </td>

                            <td class="px-6 py-4 text-right font-extrabold">
                                KES {{ number_format($sale->total, 2) }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="p-10 text-center text-gray-500"
                            >
                                No sales found for this period.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection