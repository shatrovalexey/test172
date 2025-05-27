<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public $visible = ['price', 'quantity', 'order_id', 'product_id',];
    public $fillable = ['price', 'quantity', 'order_id', 'product_id',];
}
