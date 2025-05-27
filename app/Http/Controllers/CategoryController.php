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
    * @var string $_model
    */
    protected string $_model = CategoryModel::class;
}
