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
        Schema::create('transactions', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary(); // uncomment it and comment  $table->id(); if want to use uuid instead id
            // $table->uuid('uuid')->unique();
            // $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); // uncomment it and comment  $table->foreignId('customer_id')->constrained() if want to use uuid instead id
            $table->decimal('debit', 10, 2)->nullable();
            $table->decimal('credit', 10, 2)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
