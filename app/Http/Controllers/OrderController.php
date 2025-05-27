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
    * @var array $_fields
    */
    protected array $_fields = ['fio', 'comment',];

    /**
    * @var string $_model
    */
    protected string $_model = OrderModel::class;

    /**
    * @param Request $request
    * @param int $order_id
    * @param int $product_id
    *
    * @return bool
    */
    public function productAdd(Request $request, int $order_id, int $product_id): bool
    {
        if (!$item = ProductModel::find($product_id)) return false;

        return !! OrderItemModel::create([
            'price' => $item->price
            , 'quantity' => $request->input('quantity')
            , 'order_id' => $order_id
            , 'product_id' => $product_id
            ,
        ]);
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
        return !! OrderItemModel::where('product_id', $product_id)->where('order_id', $order_id)?->delete();
    }

    /**
    * @param Request $request
    *
    * @return Collection
    */
    public function list(Request $request): Collection
    {
        $results = parent::list($request);

        foreach ($results as &$order)
            $order->items = OrderItemModel::where('order_id', $order->id)->get();

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
        if ($obj = parent::one($id))
            $obj->products = OrderItemModel::where('order_id', $id)->get();

        return $obj;
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
