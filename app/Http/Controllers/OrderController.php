<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\OrderItem as OrderItemModel;
use App\Models\Order as OrderModel;
use App\Models\Product as ProductModel;

class OrderController extends Controller
{
    /**
    * @param Request $request
    * @param ?OrderModel $obj
    *
    * @return ?OrderModel
    */
    public function _fill(Request $request, ?OrderModel $obj): ?OrderModel
    {
        $obj->fio = $request->input('fio');
        $obj->comment = $request->input('comment');

        return $obj;
    }

    /**
    * @param Request $request
    * @param int $order_id
    * @param int $product_id
    *
    * @return bool
    */
    public function productAdd(Request $request, int $order_id, int $product_id): bool
    {
        $item = new OrderItemModel();
        $item->price = ProductModel::find($product_id)->price;
        $item->quantity = $request->input('quantity');
        $item->order_id = $order_id;
        $item->product_id = $product_id;

        return !! $item->save();
    }

    /**
    * @param Request $request
    * @param int $order_id
    * @param int $product_id
    *
    * @return bool
    */
    public function productDel(Request $request, int $order_id, int $product_id): bool
    {
        return !! OrderItemModel::where('product_id', $product_id)->where('order_id', $order_id)->delete();
    }

    /**
    * @param Request $request
    * @param int $id
    *
    * @return bool
    */
    public function del(Request $request, int $id): bool
    {
        return !! OrderModel::find($id)->delete();
    }

    /**
    * @param Request $request
    *
    * @return array
    */
    public function list(Request $request): array
    {
        $results = [];

        foreach (OrderModel::get() as $order) {
            $order->items = OrderItemModel::where('order_id', $order->id)->get();

            $results[] = $order;
        }

        return $results;
    }

    /**
    * @param Request $request
    * @param int $id
    *
    * @return ?OrderModel
    */
    public function one(int $id): ?OrderModel
    {
        $obj = OrderModel::find($id);
        $obj->products = OrderItemModel::where('order_id', $id)->get();

        return $obj;
    }

    /**
    * @param Request $request
    * @param int $id
    *
    * @return bool
    */
    public function set(Request $request, int $id): bool
    {
        return !!$this->_fill($request, OrderModel::find($id))->save();
    }

    /**
    * @param Request $request
    *
    * @return bool
    */
    public function add(Request $request): ?int
    {
        $obj = new OrderModel();
        $this->_fill($request, $obj)->save();

        return $obj->id;
    }

    /**
    * @param Request $request
    * @param int $order_id
    * @param string $status - "new", "completed"
    *
    * @return bool
    */
    public function setStatus(Request $request, int $order_id, string $status): bool
    {
        $obj = OrderModel::find($order_id);
        $obj->status = $status;

        return !! $obj->save();
    }

    /**
    * @param Request $request
    * @param string $status - "new", "completed"
    *
    * @return Collection
    */
    public function getWithStatus(Request $request, string $status): Collection
    {
        return OrderModel
            ::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}
