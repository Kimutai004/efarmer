<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Goat;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with('customer')
            ->withCount('items');

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'invoice_number',
                    'like',
                    "%{$search}%"
                )
                ->orWhereHas(
                    'customer',
                    function ($customer) use ($search) {

                        $customer
                            ->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'phone',
                                'like',
                                "%{$search}%"
                            );
                    }
                );
            });
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('payment_status')) {
            $query->where(
                'payment_status',
                $request->payment_status
            );
        }

        $sales = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view(
            'admin.sales.index',
            compact('sales')
        );
    }

    public function create()
    {
        $customers = Customer::orderBy('name')
            ->get();

        $goats = Goat::with('breed')
            ->where('status', 'available')
            ->orderBy('tag_number')
            ->get();

        return view(
            'admin.sales.create',
            compact(
                'customers',
                'goats'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'sale_date' => 'required|date',

            'discount' => 'nullable|numeric|min:0',

            'payment_method' => 'nullable|string|max:50',

            'amount_paid' => 'nullable|numeric|min:0',

            'notes' => 'nullable|string',

            'goats' => 'required|array|min:1',

            'goats.*.id' => 'required|exists:goats,id',

            'goats.*.price' => 'required|numeric|min:0',
        ]);

        $sale = DB::transaction(function () use ($data) {

            $subtotal = 0;

            foreach ($data['goats'] as $item) {

                $goat = Goat::lockForUpdate()
                    ->findOrFail($item['id']);

                if ($goat->status !== 'available') {

                    abort(
                        422,
                        "Goat {$goat->tag_number} is not available."
                    );
                }

                $subtotal += $item['price'];
            }

            $discount = $data['discount'] ?? 0;

            if ($discount > $subtotal) {
                $discount = $subtotal;
            }

            $total = $subtotal - $discount;

            $amountPaid = $data['amount_paid'] ?? 0;

            if ($amountPaid > $total) {
                $amountPaid = $total;
            }

            $balance = $total - $amountPaid;

            if ($balance <= 0) {
                $paymentStatus = 'paid';
            } elseif ($amountPaid > 0) {
                $paymentStatus = 'partial';
            } else {
                $paymentStatus = 'unpaid';
            }

            $sale = Sale::create([
                'invoice_number' =>
                    $this->generateInvoiceNumber(),

                'customer_id' =>
                    $data['customer_id'],

                'sale_date' =>
                    $data['sale_date'],

                'subtotal' =>
                    $subtotal,

                'discount' =>
                    $discount,

                'total' =>
                    $total,

                'amount_paid' =>
                    $amountPaid,

                'balance' =>
                    $balance,

                'status' =>
                    'completed',

                'payment_status' =>
                    $paymentStatus,

                'notes' =>
                    $data['notes'] ?? null,
            ]);

            foreach ($data['goats'] as $item) {

                $goat = Goat::lockForUpdate()
                    ->findOrFail($item['id']);

                $sale->items()->create([
                    'goat_id' =>
                        $goat->id,

                    'quantity' =>
                        1,

                    'unit_price' =>
                        $item['price'],

                    'total' =>
                        $item['price'],
                ]);

                $goat->update([
                    'status' => 'sold',
                    'sold_at' => now(),
                ]);
            }

            if ($amountPaid > 0) {

                $sale->payments()->create([
                    'payment_reference' =>
                        'PAY-' . strtoupper(
                            uniqid()
                        ),

                    'amount' =>
                        $amountPaid,

                    'payment_method' =>
                        $data['payment_method']
                        ?? 'cash',

                    'payment_date' =>
                        $data['sale_date'],
                ]);
            }

            return $sale;
        });

        return redirect()
            ->route(
                'admin.sales.show',
                $sale
            )
            ->with(
                'success',
                'Sale recorded successfully.'
            );
    }

    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'items.goat.breed',
            'payments',
        ]);

        return view(
            'admin.sales.show',
            compact('sale')
        );
    }

    protected function generateInvoiceNumber()
    {
        do {

            $number = 'EF-'
                . now()->format('Ym')
                . '-'
                . strtoupper(
                    substr(
                        md5(
                            uniqid(
                                mt_rand(),
                                true
                            )
                        ),
                        0,
                        6
                    )
                );

        } while (
            Sale::where(
                'invoice_number',
                $number
            )->exists()
        );

        return $number;
    }
}