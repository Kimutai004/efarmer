@extends('admin.layouts.app')

@section('title', 'Sales')

@section('page-title', 'Sales')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h2 class="text-2xl font-extrabold">
                Sales
            </h2>

            <p class="text-gray-500">
                Manage Efarmer goat sales and invoices.
            </p>

        </div>

        <a
            href="{{ route('admin.sales.create') }}"
            class="px-5 py-3 rounded-xl bg-green-700 text-white font-bold"
        >
            <i class="fa-solid fa-plus mr-2"></i>
            New Sale
        </a>

    </div>


    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

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
                            Total
                        </th>

                        <th class="text-left px-6 py-4">
                            Payment
                        </th>

                        <th class="text-right px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($sales as $sale)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-bold">
                                {{ $sale->invoice_number }}
                            </td>

                            <td class="px-6 py-4">

                                <p class="font-semibold">
                                    {{ $sale->customer->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $sale->customer->phone }}
                                </p>

                            </td>

                            <td class="px-6 py-4">
                                {{ $sale->sale_date->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-extrabold">
                                KES {{ number_format($sale->total, 2) }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $sale->payment_status === 'paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($sale->payment_status === 'partial'
                                            ? 'bg-orange-100 text-orange-700'
                                            : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($sale->payment_status) }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('admin.sales.show', $sale) }}"
                                    class="text-green-700 font-bold"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="p-12 text-center text-gray-500"
                            >
                                No sales recorded.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-5">
            {{ $sales->links() }}
        </div>

    </div>

</div>

@endsection