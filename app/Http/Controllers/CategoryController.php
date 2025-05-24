<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category as CategoryModel;

class CategoryController extends Controller
{
    /**
    * Получить по ID
    *
    * @param int $id - ID
    *
    * @return ?CategoryModel
    */
    public function one(int $id): ?CategoryModel
    {
        return CategoryModel::find($id);
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
        $obj = $this->one($id);
        $obj->title = $request->input('title');

        return !! $obj->save();
    }

    /**
    * Весь список
    *
    * @param Request $request
    *
    * @return ?Collection
    */
    public function list(Request $request): ?Collection
    {
        return CategoryModel::get();
    }
}
