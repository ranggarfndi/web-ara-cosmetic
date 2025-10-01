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
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'total_points' => $this->faker->numberBetween(0, 5000),
        ];
    }
}