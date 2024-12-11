<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Bundle;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Models\Warehouse;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // users
        User::factory(50)->create();

        $products = Product::factory(100)->create();
        // stores and warehouses
        $stores = Store::factory(100)->create();
        $warehouses = Warehouse::factory(5)->create();

        $stores->each(function ($store) use ($products) {
            $products->each(function ($product) use ($store) {
                if ($store->state === 'CA') {
                    Inventory::create([
                        'product_id' => $product->id,
                        'store_id' => $store->id,
                        'quantity' => 0,
                    ]);
                } else {
                    Inventory::create([
                        'product_id' => $product->id,
                        'store_id' => $store->id,
                        'quantity' => rand(0, 100),
                    ]);
                }
            });
        });
        $warehouses->each(function ($warehouse) use ($products) {
            $products->each(function ($product) use ($warehouse) {
                // inventory entries for each product and store pair
                Inventory::create([
                    'product_id' => $product->id,
                    'store_id' => $warehouse->id,
                    'quantity' => rand(1, 100),
                ]);
            });
        });

        // bundles
        Bundle::factory(20)->create()->each(function ($bundle) {
            $bundle->products()->attach(
                Product::inRandomOrder()->take(rand(3, 5))->pluck('id')
            );
        });

        $specificBundle = Bundle::factory()->create([
            'name' => 'Christmas Bundle',
            'price' => 299.99,
            'description' => 'Get some cool tech for Christmas with this bundle!',
        ]);

        $specificBundle->products()->attach(
            Product::inRandomOrder()->take(3)->pluck('id')
        );

        // payments
        User::factory(10)->has(Payment::factory())->create();

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $user->payment()->create([
            'cardholder' => 'John Doe',
            'card_number' => '4242424242424242',
            'cvv' => '123',
            'expiration_date' => '12/30',
            'zip_code' => '90210',
        ]);

        // orders
        $statuses = ['late', 'delivered', 'canceled', 'shipped', 'ordered'];

        Order::factory(100)->create()->each(function ($order) use ($statuses) {
            // attach products to order
            $order->products()->attach(
                Product::inRandomOrder()->take(rand(3, 5))->pluck('id')
                    ->mapWithKeys(function ($id) use ($order) {
                        return [$id => ['quantity' => rand(1, 3), 'price' => Product::find($id)->price]];
                    })
            );

            $order->update([
                'status' => $statuses[array_rand($statuses)],
            ]);
        });
    }
}
