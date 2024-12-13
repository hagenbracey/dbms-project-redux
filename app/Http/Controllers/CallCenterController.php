<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Exception;
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
        $totalAmount = 0.0;

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'nullable|exists:products,id',
            'products.*.quantity' => 'nullable|integer|min:1',
        ], [
            'products.*.product_id.exists' => 'The selected product is invalid.',
            'products.*.quantity.min' => 'Quantity must be at least 1.',
        ]);

        $selectedProducts = collect();

        foreach ($request->products as $productData) {
            if (isset($productData['product_id']) && $productData['product_id']) {
                $quantity = isset($productData['quantity']) ? (int) $productData['quantity'] : 0;
                if ($quantity > 0) {
                    $product = Product::find($productData['product_id']);
                    $selectedProducts->push([
                        'product' => $product,
                        'quantity' => $quantity,
                    ]);

                    $totalAmount += $product->price * $quantity;
                }
            }
        }
        if ($selectedProducts->isEmpty()) {
            return redirect()->back()->with('error', 'You must select at least one product with a valid quantity.');
        }

        $trackingNumber = strtoupper('TRK-' . strtoupper(uniqid()));

        Log::info('Products Sold:', ['selected_products' => $selectedProducts]);
        Log::info('Generated tracking number: ' . $trackingNumber);

        $user = User::find($request->user_id);

        $order = Order::create([
            'customer_id' => $request->user_id,
            'price' => $totalAmount,
            'status' => 'pending',
            'tracking_number' => $trackingNumber,
            'address' => $request->address,
            'payment_id' => $user->payment_id,
        ]);

        return redirect()->route('call-center')
            ->with('success', 'Order placed successfully! Tracking Number: ' . $trackingNumber);
    }
}
