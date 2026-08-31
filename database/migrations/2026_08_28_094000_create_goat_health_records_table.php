<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goat_health_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('goat_id')
                ->constrained('goats')
                ->cascadeOnDelete();

            $table->string('record_type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('veterinarian')->nullable();
            $table->date('record_date');
            $table->date('next_due_date')->nullable();
            $table->decimal('cost', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goat_health_records');
    }
};