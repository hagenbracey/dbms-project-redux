<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class InventoryFactory extends Factory
{
    protected $model = \App\Models\Inventory::class;

    public function definition()
    {
        return [
            'inventoryable_id' => null, // Set dynamically in tests or seeders
            'inventoryable_type' => null, // Set dynamically in tests or seeders
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
    }
}
