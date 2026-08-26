<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Personal details
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_id', 50)->unique();
            $table->string('gender', 20)->nullable();
            $table->string('phone', 20)->unique();
            $table->string('alternative_phone', 20)->nullable();
            $table->string('email')->unique();

            // Authentication
            $table->string('password');
            $table->boolean('email_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            // Login tracking
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->timestamp('last_logout_at')->nullable();
            $table->unsignedInteger('login_count')->default(0);

            // Account status
            $table->enum('status', [
                'active',
                'inactive',
                'suspended',
                'pending'
            ])->default('pending');

            $table->timestamp('suspended_at')->nullable();
            $table->text('suspension_reason')->nullable();

            // Remember Me
            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};