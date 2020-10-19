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
            'user_id' => !empty(auth()->user()) ? auth()->user()->id : null,
            'delivery_id' => $request->get('delivery_id'),
            'total' => $request->get('total'),
            'goods_ids' => json_encode($request->get('goods_ids')),
            'address' => $request->get('address'),
            'name' => $request->get('name'),
        ];

        \Log::info($orderData);

        $response = $orderCreator->make($orderData);

        return response()->json($response['data'], $response['status']);
    }
}
