<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goat_weight_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('goat_id')
                ->constrained('goats')
                ->cascadeOnDelete();

            $table->decimal('weight', 8, 2);
            $table->date('recorded_at');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goat_weight_records');
    }
};