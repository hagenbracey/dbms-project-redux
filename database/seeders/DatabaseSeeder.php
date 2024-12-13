<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Bundle;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipment;
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
        // users and payments
        $users = User::factory(100)->create();

        $users->each(function ($user) {
            $payment = Payment::factory()->create([
                'user_id' => $user->id,
            ]);
            $user->update([
                'payment_id' => $payment->id,
            ]);
        });

        // products
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

        // orders
        $statuses = ['late', 'delivered', 'canceled', 'shipped', 'ordered'];

        Order::factory(100)->create()->each(function ($order) use ($statuses) {
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

        $randomOrder = Order::inRandomOrder()->first();
        if ($randomOrder) {
            $randomOrder->update([
                'tracking_number' => '123456',
                'status' => 'canceled',
            ]);
        };

        $orders = Order::all();
        $payments = Payment::all();

        $orders->each(function ($order) use ($users) {
            $user = $users->random();
            $order->update([
                'customer_id' => $user->id,
                'payment_id' => $user->payment_id,
            ]);
        });


        // shipments
        Shipment::factory(50)->create()->each(function ($shipment) {
            $shipment->products()->attach(
                Product::inRandomOrder()->take(rand(3, 5))->pluck('id')
                    ->mapWithKeys(function ($id) use ($shipment) {
                        return [
                            $id => [
                                'quantity' => rand(1, 10),
                                'price' => Product::find($id)->price,
                            ]
                        ];
                    })
            );
        });
    }
}
