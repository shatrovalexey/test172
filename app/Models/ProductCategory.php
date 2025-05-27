<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $visible = ['category_id', 'product_id',];
    public $fillable = ['category_id', 'product_id',];
}
