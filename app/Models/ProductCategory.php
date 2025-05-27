<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $visible = ['category_id', 'product_id',];
    protected $fillable = ['category_id', 'product_id',];
}
