<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Product as ProductModel;
use App\Models\ProductCategory as ProductCategoryModel;

class ProductController extends Controller
{
    /**
    * Заполнить из Request
    *
    * @param Request $request
    * @param ?ProductModel $obj
    *
    * @return ?ProductModel
    */
    protected function _fill(Request $request, ?ProductModel $obj): ?ProductModel
    {
        if (!$obj) return null;

        $obj->title = $request->input('title');
        $obj->comment = $request->input('comment');
        $obj->price = $request->input('price');

        return $obj;
    }

    /**
    * Получить по ID
    *
    * @param Request $request
    * @param int $id - ID
    *
    * @return ?ProductModel
    */
    public function one(int $id): ?ProductModel
    {
        return ProductModel::find($id);
    }

    /**
    * Обновить по ID
    *
    * @param Request $request
    * @param int $id - ID
    *
    * @return bool
    */
    public function set(Request $request, int $id): bool
    {
        return !! $this->_fill($request, $this->one($id))->save();
    }

    /**
    * Создать
    *
    * @param Request $request
    *
    * @return ?int
    */
    public function add(Request $request): ?int
    {
        $obj = new ProductModel();
        $this->_fill($request, $obj)->save();

        return $obj->id;
    }

    /**
    * Весь список
    *
    * @param Request $request
    *
    * @return ?ProductModel
    */
    public function list(Request $request): array
    {
        $results = [];

        foreach (ProductModel::get() as $product) {
            $product->categories = $product->categories();

            $results[] = $product;
        }

        return $results;
    }

    /**
    * @param Request $request
    * @param int $id - ID
    *
    * @return bool
    */
    public function del(Request $request, int $id): bool
    {
        return !! ProductModel::find($id)->delete();
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
