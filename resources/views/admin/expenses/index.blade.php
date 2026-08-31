@extends('admin.layouts.app')

@section('title', 'Expenses')

@section('page-title', 'Expenses')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-2xl font-extrabold">
                Farm Expenses
            </h2>

            <p class="text-gray-500">
                Track costs associated with running Efarmer.
            </p>

        </div>

        <a
            href="{{ route('admin.expenses.create') }}"
            class="px-5 py-3 bg-green-700 text-white rounded-xl font-bold"
        >
            <i class="fa-solid fa-plus mr-2"></i>
            Add Expense
        </a>

    </div>


    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4">
                            Date
                        </th>

                        <th class="text-left px-6 py-4">
                            Category
                        </th>

                        <th class="text-left px-6 py-4">
                            Description
                        </th>

                        <th class="text-left px-6 py-4">
                            Amount
                        </th>

                        <th class="text-right px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($expenses as $expense)

                        <tr>

                            <td class="px-6 py-4">
                                {{ $expense->expense_date->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-bold">
                                {{ $expense->category }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $expense->description }}
                            </td>

                            <td class="px-6 py-4 font-extrabold">
                                KES {{ number_format($expense->amount, 2) }}
                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('admin.expenses.edit', $expense) }}"
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
                                No expenses recorded.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-5">
            {{ $expenses->links() }}
        </div>

    </div>

</div>

@endsection