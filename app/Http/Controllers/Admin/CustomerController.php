<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::withCount('sales');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'phone',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                );

            });
        }

        $customers = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.customers.index',
            compact('customers')
        );
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Customer::create($data);

        return redirect()
            ->route('admin.customers.index')
            ->with(
                'success',
                'Customer created successfully.'
            );
    }

    public function show(Customer $customer)
    {
        $customer->load([
            'sales.items.goat',
            'sales.payments'
        ]);

        return view(
            'admin.customers.show',
            compact('customer')
        );
    }

    public function edit(Customer $customer)
    {
        return view(
            'admin.customers.edit',
            compact('customer')
        );
    }

    public function update(
        Request $request,
        Customer $customer
    ) {

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $customer->update($data);

        return redirect()
            ->route('admin.customers.index')
            ->with(
                'success',
                'Customer updated successfully.'
            );
    }

    public function destroy(Customer $customer)
    {
        if ($customer->sales()->exists()) {

            return back()->with(
                'error',
                'Customer has sales records and cannot be deleted.'
            );
        }

        $customer->delete();

        return back()->with(
            'success',
            'Customer deleted.'
        );
    }
}