<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Store;

class InventoryFactory extends Factory
{
    protected $model = \App\Models\Inventory::class;

    // InventoryFactory
// InventoryFactory
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'inventoryable_type' => 'App\Models\Store',
            'inventoryable_id' => Store::factory(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }

}
