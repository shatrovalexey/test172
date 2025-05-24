<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order as OrderModel;
use App\Models\Category as CategoryModel;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $visible = ['id', 'title', 'price', 'comment',];

    public function orders()
    {
        return $this->hasMany(OrderModel::class);
    }

    public function categories()
    {
        return $this->hasMany(CategoryModel::class);
    }
}
