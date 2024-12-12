<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('storeOrder method was called');  // Add this line to confirm the method is called.

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $validated['user_id'],
            'status' => 'ordered',
        ]);

        // Attach products to the order
        foreach ($validated['products'] as $productData) {
            $order->products()->attach($productData['product_id'], [
                'quantity' => $productData['quantity'],
                'price' => Product::find($productData['product_id'])->price,
            ]);
        }

        try {
            $trackingNumber = strtoupper('TRK-' . strtoupper(uniqid()));
            Log::info('Generated tracking number: ' . $trackingNumber);
            $order->tracking_number = $trackingNumber;
            $order->save();
        } catch (\Exception $e) {
            Log::error('Error generating tracking number: ' . $e->getMessage());
        }



        // Redirect with success message
        return redirect()->route('call-center')
            ->with('success', 'Order placed successfully! Tracking Number: ' . $trackingNumber);
    }
}
