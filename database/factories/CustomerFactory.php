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
            'identity_id' =>  \App\Models\Identity::all()->random()->id,
            'document_number' => fake()->unique()->numerify('###########'),
            'name' => fake()->company(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),

        ];
    }
}
