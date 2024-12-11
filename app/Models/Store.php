<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * Get all of the store's inventories.
     */
    public function inventories()
    {
        return $this->morphMany(Inventory::class, 'inventoryable');
    }
}
