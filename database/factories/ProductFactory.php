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
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            // 'description ' => $this->faker->paragraph(),
            'name' => $this->faker->text(60),
            'price' => $this->faker->numberBetween(10, 9000),
            'manage_stock' => false,
            'in_stock' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'sku' => $this->faker->word(),

        ];
    }
}
