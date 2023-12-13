<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'warranty_id',
        'name',
        'slug',
        'image',
        'price',
        'intro',
        'quantity',
        'import_price',
        'sold_quantity',
        'description',
        'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
