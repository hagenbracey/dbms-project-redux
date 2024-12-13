<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Inventory;

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
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['PC Components', 'PC Accessories', 'Displays', 'Headphones', 'Laptops', 'Cables and Chargers']),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'manufacturer' => $this->faker->company(),
        ];
    }

    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'inventoryable');
    }
}
