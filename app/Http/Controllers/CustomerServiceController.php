<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $stores = Store::all();  // Get all stores for the dropdown
        return view('customer-service', compact('stores'));
    }

    public function search(Request $request)
    {
        $stores = Store::all();
        $query = Product::query();

        // product name
        if ($request->has('product_name') && $request->input('product_name') != '') {
            $query->where('name', 'like', '%' . $request->input('product_name') . '%');
        }

        // store
        if ($request->has('store_id') && $request->input('store_id') != '') {
            $query->whereHas('inventories', function ($query) use ($request) {
                $query->where('store_id', $request->input('store_id'));
            });
        }

        $products = $query->with(['inventories.store'])->take(10)->get();

        \Log::info('Products and Inventories:', [
            'products' => $products,
            'inventories' => $products->pluck('inventories')->flatten()
        ]);

        return view('customer-service', compact('products', 'stores'));
    }
}
