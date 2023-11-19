<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isBool = $this->faker->boolean;
        return [
            "id" => $this->faker->uuid,
            "customer_id" => Customer::factory(),
            "debit" => !$isBool ? $this->faker->numberBetween(0, 999) : null,
            "credit" => $isBool ? $this->faker->numberBetween(0, 999) : null,
            "description" => $this->faker->sentence,
        ];
    }
}
// // $table->id();
// $table->uuid('id')->primary(); // uncomment it and comment  $table->id(); if want to use uuid instead id
// // $table->uuid('uuid')->unique();
// // $table->foreignId('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
// $table->foreignUuid('customer_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); // uncomment it and comment  $table->foreignId('customer_id')->constrained() if want to use uuid instead id
// $table->decimal('debit', 10, 2)->nullable();
// $table->decimal('credit', 10, 2)->nullable();
// $table->string('description')->nullable();
// $table->timestamps();
// $table->softDeletes();
