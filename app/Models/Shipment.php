<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'price',
        'status',
        'tracking_number',
    ];

    /**
     * Define the relationship with the Warehouse model.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Define the relationship with the ShipmentProducts pivot table.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'shipment_products')
            ->withPivot('quantity', 'price');
    }
}
