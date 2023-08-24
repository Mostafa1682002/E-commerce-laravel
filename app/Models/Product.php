<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "product_name",
        "categorie_id",
        "price",
        "discount",
        "total_price",
        "image"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }
}