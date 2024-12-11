<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Bundle;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\Inventory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Brick\Math\BigInteger;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // users
        User::factory(100)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // products
        Product::factory(1000)->create();

        Product::factory()->create([
            'name' => 'Product Name',
            'type' => 'PC Component',
            'description' => 'This is a wonderful PC component!',
            'price' => 229.99,
            'manufacturer' => 'Radeon',
        ]);

        // bundles
        Bundle::factory(010)->create()->each(function ($bundle) {
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
        User::factory(100)->has(Payment::factory())->create();

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
        Order::factory(1000)->create()->each(function ($order) {
            $order->products()->attach(
                Product::inRandomOrder()->take(rand(3, 5))->pluck('id')
                    ->mapWithKeys(function ($id) use ($order) {
                        return [$id => ['quantity' => rand(1, 3), 'price' => Product::find($id)->price]];
                    })
            );
        });

        // warehouses
        Warehouse::factory(1000)
        ->has(Inventory::factory()->count(100), 'inventories')
        ->create();
        
        // stores
        Store::factory(1000)
            ->has(Inventory::factory()->count(100), 'inventories')
            ->create();
    }
}
