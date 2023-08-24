<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "address", "phone", "notes", "products", "total_price"
    ];


    protected $casts = [
        'products' => 'array'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}