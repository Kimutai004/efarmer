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
        // Optimized goat statistics - single query with conditional aggregation
        $goatStats = Goat::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN status = "available" THEN 1 ELSE 0 END) as available,
            SUM(CASE WHEN status = "reserved" THEN 1 ELSE 0 END) as reserved,
            SUM(CASE WHEN status = "sold" THEN 1 ELSE 0 END) as sold
        ')->first();

        $totalGoats = $goatStats->total;
        $availableGoats = $goatStats->available;
        $reservedGoats = $goatStats->reserved;
        $soldGoats = $goatStats->sold;

        // Breed count (cached for performance)
        $breeds = cache()->remember('breeds_count', 3600, function () {
            return Breed::count();
        });

        // Customer statistics (cached for performance)
        $customers = cache()->remember('customers_count', 3600, function () {
            return Customer::count();
        });

        // Sales statistics - single query with conditional aggregation
        $salesStats = Sale::where('status', 'completed')
            ->selectRaw('
                COALESCE(SUM(total), 0) as total_sales,
                COALESCE(SUM(amount_paid), 0) as total_paid,
                COALESCE(SUM(balance), 0) as outstanding
            ')
            ->first();

        $totalSales = $salesStats->total_sales;
        $totalPaid = $salesStats->total_paid;
        $outstanding = $salesStats->outstanding;

        // Expenses (cached for performance)
        $totalExpenses = cache()->remember('total_expenses', 300, function () {
            return Expense::sum('amount');
        });

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

        // Recent sales with eager loading
        $recentSales = Sale::with('customer')
            ->latest()
            ->limit(8)
            ->get();

        // Recent goats with eager loading
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
