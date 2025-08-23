<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->sentence(),
            'description' => fake()->paragraph(3),
            'sku' => 'SKU-' . fake()->unique()->regexify('[A-Z0-9]{9}'),
            'price' => fake()->randomFloat(2, 1000, 1000000),
            'category_id' => \App\Models\Category::all()->random()->id
        ];
    }
}
