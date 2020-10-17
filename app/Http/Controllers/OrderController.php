<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Classes\Order\OrderCreator;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * @param Request $request
     * @param OrderCreator $orderCreator
     */
    public function checkout(Request $request, OrderCreator $orderCreator)
    {
        $orderData = [
            'user_id' => auth()->user()->id,
            'delivery_id' => $request->get('delivery_id'),
            'total' => $request->get('total'),
            'goods_ids' => json_encode($request->get('goods_ids')),
        ];

        $response = $orderCreator->make($orderData);

        return response()->json($response);
    }
}
