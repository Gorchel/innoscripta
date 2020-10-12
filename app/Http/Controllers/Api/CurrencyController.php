<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\Currency\CurrencyGetter;

/**
 * Class CurrencyController
 *
 * The Controller for currency handle
 *
 * @package App\Http\Controllers\Api
 */
class CurrencyController extends Controller
{
    /**
     * The method returns list with currency rate multiplier
     *
     * @param CurrencyGetter $currencyGetter
     * @return array
     */
    public function getList(CurrencyGetter $currencyGetter)
    {
        return $currencyGetter->getList();
    }
}
