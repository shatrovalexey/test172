<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\{Collection, Model};

abstract class Controller
{
    /**
    * @var array $_fields
    */
    protected array $_fields;

    /**
    * @var string $_model
    */
    protected string $_model = CategoryModel::class;

    /**
    * Заполнить из Request
    *
    * @param Request $request
    * @param ?Model $obj
    *
    * @return ?Model
    */
    protected function _fill(Request $request, ?Model $obj): ?Model
    {
        return $obj?->fill($request->only($this->_fields));
    }

    /**
    * Получить по ID
    *
    * @param Request $request
    * @param int $id - ID
    *
    * @return ?Model
    */
    public function one(int $id): ?Model
    {
        return $this->_model::find($id);
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
        return !! $this->_fill($request, $this->one($id))?->save();
    }

    /**
    * Весь список
    *
    * @param Request $request
    *
    * @return ?Collection
    */
    public function list(Request $request): Collection
    {
        return $this->_model::get();
    }

    /**
    * @param Request $request
    * @param int $id - ID
    *
    * @return bool
    */
    public function del(Request $request, int $id): bool
    {
        return !! $this->_model::find($id)?->delete();
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
        $obj = new $this->_model;

        if (!$this->_fill($request, $obj)?->save()) return null;

        return $obj?->id;
    }
}
