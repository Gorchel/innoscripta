<?php

namespace App\Http\Controllers;

use App\Classes\OrderHistory\Worker\OrderWorker;
use Illuminate\Http\Request;
use App\Classes\OrderHistory\HistoryGetter;

/**
 * Class HistoryOrderController
 * @package App\Http\Controllers
 */
class HistoryOrderController extends Controller
{
    /**
     * @param Request $request
     * @param HistoryGetter $getter
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderHistory(Request $request)
    {
        $getter = new HistoryGetter(new OrderWorker());

        return response()->json($getter->getList());
    }
}
