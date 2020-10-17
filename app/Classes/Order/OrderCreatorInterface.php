<?php

namespace App\Classes\Order;

/**
 * Interface OrderCreatorInterface
 * @package App\Classes\Order
 */
interface OrderCreatorInterface
{
    /**
     * @param $orderData
     * @return array
     */
    public function make(array $orderData): array;
}
