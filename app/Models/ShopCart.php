<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'order_id',
        'quantity',
        'price',
    ];
}
