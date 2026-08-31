@extends('admin.layouts.app')

@section('title', 'Customers')

@section('page-title', 'Customers')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <h2 class="text-2xl font-extrabold">
                Customers
            </h2>

            <p class="text-gray-500">
                Manage Efarmer's goat buyers.
            </p>

        </div>

        <a
            href="{{ route('admin.customers.create') }}"
            class="px-5 py-3 rounded-xl bg-green-700 text-white font-bold"
        >
            <i class="fa-solid fa-plus mr-2"></i>
            Add Customer
        </a>

    </div>


    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4">
                            Customer
                        </th>

                        <th class="text-left px-6 py-4">
                            Phone
                        </th>

                        <th class="text-left px-6 py-4">
                            Location
                        </th>

                        <th class="text-left px-6 py-4">
                            Sales
                        </th>

                        <th class="text-right px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($customers as $customer)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <p class="font-bold">
                                    {{ $customer->name }}
                                </p>

                                @if($customer->email)

                                    <p class="text-xs text-gray-500">
                                        {{ $customer->email }}
                                    </p>

                                @endif

                            </td>

                            <td class="px-6 py-4">
                                {{ $customer->phone }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $customer->location ?: '—' }}
                            </td>

                            <td class="px-6 py-4 font-bold">
                                {{ $customer->sales_count }}
                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('admin.customers.edit', $customer) }}"
                                    class="text-green-700 font-bold"
                                >
                                    Edit
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="p-12 text-center text-gray-500"
                            >
                                No customers found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-5">
            {{ $customers->links() }}
        </div>

    </div>

</div>

@endsection