<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    public function definition()
    {
        return [
            'warehouse_id' => Warehouse::factory(),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'status' => $this->faker->randomElement(['pending', 'shipped', 'delivered']),
            'tracking_number' => strtoupper('TRK-' . uniqid()),
        ];
    }
}
