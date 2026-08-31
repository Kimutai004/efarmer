<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sale_id')
                ->constrained('sales')
                ->cascadeOnDelete();

            $table->string('payment_reference')->unique();
            $table->decimal('amount', 12, 2);
            $table->string('payment_method')->default('mpesa');
            $table->string('transaction_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->default('pending');
            $table->date('payment_date')->nullable();
            $table->text('notes')->nullable();
            $table->text('mpesa_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};