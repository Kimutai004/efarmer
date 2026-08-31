<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Goat;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input(
            'from',
            now()->startOfMonth()->toDateString()
        );

        $to = $request->input(
            'to',
            now()->toDateString()
        );

        $sales = Sale::with([
            'customer',
            'items.goat'
        ])
            ->whereBetween(
                'sale_date',
                [$from, $to]
            )
            ->where(
                'status',
                'completed'
            )
            ->latest('sale_date')
            ->get();

        $expenses = Expense::whereBetween(
            'expense_date',
            [$from, $to]
        )->get();

        $revenue = $sales->sum('total');

        $paid = $sales->sum('amount_paid');

        $outstanding = $sales->sum('balance');

        $expenseTotal = $expenses->sum('amount');

        $profit = $revenue - $expenseTotal;

        $goatsSold = $sales->sum(
            fn ($sale) => $sale->items->count()
        );

        $salesByDay = Sale::select(
            'sale_date',
            DB::raw('SUM(total) as total')
        )
            ->whereBetween(
                'sale_date',
                [$from, $to]
            )
            ->where(
                'status',
                'completed'
            )
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->get();

        $inventory = Goat::with('breed')
            ->where(
                'status',
                'available'
            )
            ->get();

        return view(
            'admin.reports.index',
            compact(
                'from',
                'to',
                'sales',
                'expenses',
                'revenue',
                'paid',
                'outstanding',
                'expenseTotal',
                'profit',
                'goatsSold',
                'salesByDay',
                'inventory'
            )
        );
    }
}