<?php
namespace App\Classes\Currency;

/**
 * Class CurrencyGetter
 * @package App\Classes\Currency
 */
class CurrencyGetter
{
    /**
     * The method returns list with currency rate multiplier
     * @return array
     */
    public function getList(): array
    {
        return config('currency');
    }
}
