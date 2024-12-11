<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    // Show customer details and the form for creating an order
    public function index()
    {
        $customers = User::all();  // Get all customers
        $products = Product::all();    // Get all products available for order

        return view('call-center', compact('customers', 'products'));
    }

    // Create a new order for a customer
    public function createOrder(Request $request)
    {
        // Validate the request
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities.*' => 'numeric|min:1',
        ]);

        // Create the order for the customer
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'status' => 'ordered',  // Set initial status to 'ordered'
        ]);

        // Attach products to the order with quantities
        foreach ($request->product_ids as $index => $product_id) {
            $order->products()->attach($product_id, [
                'quantity' => $request->quantities[$index],
                'price' => Product::find($product_id)->price,
            ]);
        }

        return redirect()->route('call-center')->with('success', 'Order created successfully');
    }
}
