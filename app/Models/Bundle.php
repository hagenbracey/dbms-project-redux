<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_products', 'bundle_id', 'product_id');
    }
}
