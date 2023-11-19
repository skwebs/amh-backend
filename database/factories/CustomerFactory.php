<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id" => $this->faker->uuid,
            "name" => $this->faker->name,
            "email" => $this->faker->safeEmail,
            "address" => $this->faker->address,
            "mobile" => $this->faker->numberBetween(6000000000, 9999999999),
        ];
    }
}
