<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardholder',
        'card_number',
        'cvv',
        'expiration_date',
        'zip_code',
    ];

    protected $hidden = [
        'cardholder',
        'card_number',
        'cvv',
        'expiration_date',
        'zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
