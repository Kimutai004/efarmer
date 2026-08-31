<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'description',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'category',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'reference',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $expenses = $query
            ->latest('expense_date')
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.expenses.index',
            compact('expenses')
        );
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        Expense::create($data);

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense recorded successfully.'
            );
    }

    public function edit(Expense $expense)
    {
        return view(
            'admin.expenses.edit',
            compact('expense')
        );
    }

    public function update(
        Request $request,
        Expense $expense
    ) {

        $data = $request->validate([
            'category' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $expense->update($data);

        return redirect()
            ->route('admin.expenses.index')
            ->with(
                'success',
                'Expense updated successfully.'
            );
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return back()->with(
            'success',
            'Expense deleted.'
        );
    }
}