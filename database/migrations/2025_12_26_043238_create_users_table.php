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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
             // Account info
            // $table->string('account_type')->nullable();
            // $table->string('salutation')->nullable();
             // User info
            $table->string('name');
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            // Address
            // $table->string('street')->nullable();
            // $table->string('country')->nullable();
            // $table->string('state')->nullable();
            // $table->string('city')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
