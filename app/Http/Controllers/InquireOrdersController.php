<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquireOrdersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('orders.index', compact('users'));
    }

    public function search(Request $request)
    {
        // Fetch all users to populate the user select options
        $users = User::all();

        // Query orders based on user_id if provided
        $orders = Order::select('orders.tracking_number', 'orders.status', 'users.name as customer_name')
            ->join('users', 'orders.customer_id', '=', 'users.id');

        // If a user_id is selected, filter orders by that user
        if ($request->has('user_id') && $request->input('user_id') != '') {
            $orders->where('orders.customer_id', $request->input('user_id'));
        }

        // Get the results
        $orders = $orders->get();

        // Return the view with users and orders
        return view('orders.index', compact('users', 'orders'));
    }
}
