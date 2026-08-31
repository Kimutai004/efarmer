<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Goat;
use App\Models\Breed;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Goat statistics
        $totalGoats = Goat::count();

        $breeds = Breed::count();

        $availableGoats = Goat::where('status', 'available')->count();

        $reservedGoats = Goat::where('status', 'reserved')->count();

        $soldGoats = Goat::where('status', 'sold')->count();


        // Customer statistics
        $customers = Customer::count();


        // Sales statistics
        $totalSales = Sale::where('status', 'completed')
            ->sum('total');

        $totalPaid = Sale::where('status', 'completed')
            ->sum('amount_paid');

        $outstanding = Sale::where('status', 'completed')
            ->sum('balance');


        // Expenses
        $totalExpenses = Expense::sum('amount');


        // Profit
        $profit = $totalSales - $totalExpenses;


        // Monthly sales
        $monthlySales = Sale::select(
                DB::raw('MONTH(sale_date) as month'),
                DB::raw('SUM(total) as total')
            )
            ->where('status', 'completed')
            ->whereYear('sale_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        // Recent sales
        $recentSales = Sale::with('customer')
            ->latest()
            ->limit(8)
            ->get();


        // Recent goats
        $recentGoats = Goat::with([
                'breed',
                'photos'
            ])
            ->latest()
            ->limit(6)
            ->get();


        return view('admin.dashboard', compact(
            'totalGoats',
            'availableGoats',
            'reservedGoats',
            'soldGoats',
            'customers',
            'totalSales',
            'totalPaid',
            'outstanding',
            'totalExpenses',
            'profit',
            'monthlySales',
            'recentSales',
            'recentGoats',
            'breeds'
        ));
    }
}
