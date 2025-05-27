<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem as OrderItemModel;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public $fillable = ['fio', 'comment', 'status',];

    public function items()
    {
        return $this->hasMany(OrderItemModel::class);
    }
}
