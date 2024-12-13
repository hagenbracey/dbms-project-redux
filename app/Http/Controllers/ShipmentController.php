<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('shipments.index', compact('warehouses'));
    }

    public function search(Request $request)
    {
        $warehouses = Warehouse::all();

        $query = DB::table('shipments as s')
            ->join('shipment_products as sp', 's.id', '=', 'sp.shipment_id')
            ->join('products as p', 'sp.product_id', '=', 'p.id')
            ->select('s.id as shipment_id', 's.tracking_number', 's.status', 'p.name as product_name', 'sp.quantity', 'sp.price');

        if ($request->has('warehouse_id') && $request->input('warehouse_id') != '') {
            $query->where('s.warehouse_id', $request->input('warehouse_id'));
        }

        $shipments = $query->get();

        return view('shipments.index', compact('shipments', 'warehouses'));
    }
}
