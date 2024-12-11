<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * Get the parent inventoryable model (store, warehouse, etc.).
     */
    public function inventoryable()
    {
        return $this->morphTo();
    }
}
