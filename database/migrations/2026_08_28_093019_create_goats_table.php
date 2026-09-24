<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goats', function (Blueprint $table) {
            $table->id();

            $table->string('tag_number')->unique();
            $table->string('name')->nullable();

            $table->foreignId('breed_id')
                ->nullable()
                ->constrained('breeds')
                ->nullOnDelete();

            $table->string('category')->nullable();

            $table->enum('gender', [
                'male',
                'female',
            ])->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('color')->nullable();

            $table->decimal('weight', 8, 2)->nullable();

            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('selling_price', 12, 2)->nullable();

            $table->string('status')->default('available');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->boolean('featured')->default(false);
            $table->dateTime('sold_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes for frequently queried columns
            $table->index('status');
            $table->index('breed_id');
            $table->index('gender');
            $table->index('featured');
            $table->index('selling_price');
            $table->index(['status', 'featured']);
            $table->index(['status', 'breed_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goats');
    }
};