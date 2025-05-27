<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{
    Product as ProductModel
    , ProductCategory as ProductCategoryModel
};

class ProductController extends Controller
{
    /**
    * @var string $_model
    */
    protected string $_model = ProductModel::class;

    /**
    * Весь список
    *
    * @param Request $request
    *
    * @return Collection
    */
    public function list(Request $request): Collection
    {
        $results = parent::list($request);

        foreach ($results as &$product)
            $product->categories = $product->categories();

        return $results;
    }

    /**
    * @param Request $request
    * @param int $product_id
    * @param int $category_id
    *
    * @return bool
    */
    public function addCategory(Request $request, int $product_id, int $category_id): bool
    {
        return !! ProductCategoryModel::create(['product_id' => $product_id, 'category_id' => $category_id,]);
    }

    /**
    * @param Request $request
    * @param int $product_id
    * @param int $category_id
    *
    * @return bool
    */
    public function delCategory(Request $request, int $product_id, int $category_id): bool
    {
        return !! ProductCategoryModel::where('product_id', $product_id)->where('category_id', $category_id)->delete();
    }
}
