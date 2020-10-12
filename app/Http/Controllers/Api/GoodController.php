<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Goods\GoodFactory;

/**
 * Class CurrencyController
 *
 * The Controller for processing data on goods
 *
 * @package App\Http\Controllers\Api
 */
class GoodController extends Controller
{
    public function getList($type, Request $request)
    {
        $goodFactory = new GoodFactory($type);

        $options = [
            'ids' => json_decode($request->get('ids')),
        ];

        return $goodFactory->getList($options);
    }
}
