<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'payment_id',
        'price',
        'status',
        'address',
        'tracking_number',
    ];

    // Many to Many relationship with Products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity', 'price');
    }

    // Belongs to relationship with User (Customer)
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Belongs to relationship with Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
