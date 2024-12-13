<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'manufacturer',
    ];

    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_products', 'product_id', 'bundle_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')
            ->withPivot('quantity', 'price');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
