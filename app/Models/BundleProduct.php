<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleProduct extends Model
{
    protected $fillable = [
        'bundle_id', 'product_id',
    ];
}
