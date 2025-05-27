<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{
    Category as CategoryModel
    , Order as OrderModel
};

class CategoryController extends Controller
{
    /**
    * @var array $_fields
    */
    protected array $_fields = ['title',];

    /**
    * @var string $_model
    */
    protected string $_model = CategoryModel::class;
}
