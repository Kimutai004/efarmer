<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            // Invoice
            $table->string('invoice_number')->unique();

            // Customer
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Sale information
            $table->date('sale_date');

            // Financial information
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);

            // Sale status
            $table->string('status')->default('pending');

            // Payment status
            $table->string('payment_status')->default('unpaid');

            // Additional information
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes for frequently queried columns
            $table->index('status');
            $table->index('payment_status');
            $table->index('sale_date');
            $table->index('customer_id');
            $table->index(['status', 'sale_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};