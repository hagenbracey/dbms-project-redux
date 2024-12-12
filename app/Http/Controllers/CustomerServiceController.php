<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerServiceController extends Controller
{
    public function index()
    {
        $stores = Store::all();  // Get all stores for the dropdown
        return view('customer-service', compact('stores'));
    }

    public function search(Request $request)
    {
        $stores = Store::all(); // Get all stores for the dropdown

        $sql = "SELECT DISTINCT p.id AS product_id, s.name AS store_name, p.name AS product_name, i.quantity
                FROM inventories i
                JOIN products p ON i.product_id = p.id
                JOIN stores s ON i.store_id = s.id";

        if ($request->has('store_id') && $request->input('store_id') != '') {
            $storeId = $request->input('store_id');
            $sql .= " WHERE i.store_id = :store_id";
        }

        if ($request->has('product_name') && $request->input('product_name') != '') {
            $productName = $request->input('product_name');
            $sql .= " AND p.name LIKE :product_name";
        }

        $bindings = [];
        if (isset($storeId)) {
            $bindings['store_id'] = $storeId;
        }
        if (isset($productName)) {
            $bindings['product_name'] = '%' . $productName . '%';
        }

        $products = DB::select($sql, $bindings);
        $products = collect($products);

        return view('customer-service', compact('products', 'stores'));
    }
}
