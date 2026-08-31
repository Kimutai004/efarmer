@extends('admin.layouts.app')

@section('title', 'Payments')
@section('page-title', 'Payments')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-gray-500">View all payment transactions.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <div class="p-4 border-b">
            <form method="GET" class="flex flex-wrap gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search payments..." class="border rounded-lg px-4 py-2 flex-1 min-w-[200px]">
                <select name="status" class="border rounded-lg px-4 py-2">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800">
                    <i class="fa-solid fa-search"></i> Search
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Reference</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Buyer</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Amount</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">M-Pesa Receipt</th>
                        <th class="text-center px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($payments as $payment)
                        <tr>
                            <td class="px-6 py-4 font-mono font-semibold">{{ $payment->payment_reference }}</td>
                            <td class="px-6 py-4 text-sm">{{ $payment->phone_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-semibold">KES {{ number_format($payment->amount, 2) }}</td>
                            <td class="px-6 py-4 font-mono text-sm">{{ $payment->transaction_id ?? 'Pending' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 rounded-full text-xs font-bold {{ $payment->status === 'completed' ? 'bg-green-100 text-green-700' : ($payment->status === 'failed' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $payment->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="p-4 border-t">
            {{ $payments->links() }}
        </div>

    </div>

</div>

@endsection