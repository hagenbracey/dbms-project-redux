<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index()
    {
        $users = User::all();
        $products = Product::all();

        return view('call-center.index', compact('users', 'products'));
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create the order for the selected user
        $order = Order::create([
            'user_id' => $validated['user_id'],
            'status' => 'ordered',
        ]);

        foreach ($validated['products'] as $productData) {
            $order->products()->attach($productData['product_id'], [
                'quantity' => $productData['quantity'],
                'price' => Product::find($productData['product_id'])->price,
            ]);
        }

        $trackingNumber = strtoupper('TRK-' . strtoupper(uniqid()));

        $order->tracking_number = $trackingNumber;
        $order->save();

        dd(session()->all());

        return redirect()->route('call-center')
                         ->with('success', 'Order placed successfully! Tracking Number: ' . $trackingNumber);
    }
}