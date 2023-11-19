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
        Schema::create('customers', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary(); // uncomment it and comment  $table->id(); if want to use uuid instead id
            // $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->rememberToken();
            $table->string('address')->nullable();
            $table->date('last_purchase_at')->nullable();
            $table->integer('last_purchase_amount')->default(0);
            $table->date('last_payment_at')->nullable();
            $table->integer('last_payment_amount')->default(0);
            $table->integer("balance")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
