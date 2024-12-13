<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 500),
            'status' => $this->faker->word(),
            'address' => $this->faker->address(),
            'tracking_number' => $this->faker->uuid(),
            'payment_id' => Payment::factory(),
            'date_ordered' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Define a state to associate products with an order.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProducts()
    {
        return $this->afterCreating(function (Order $order) {
            $products = Product::inRandomOrder()->take(rand(3, 5))->get();

            $products->each(function ($product) use ($order) {
                $order->products()->attach(
                    $product->id,
                    [
                        'quantity' => rand(1, 3),
                        'price' => $product->price
                    ]
                );
            });
        });
    }
}
