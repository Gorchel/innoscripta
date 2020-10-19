<?php

namespace App\Classes\DTO;

use App\Order;

/**
 * Class OrderDTO
 *
 * Сlass for assembling order
 *
 * @package App\Classes\DTO
 */
class OrderDTO
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * GoodDTO constructor.
     */
    public function __construct()
    {
        $this->order = new Order;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setUserId(?int $id): Order
    {
        $this->order->user_id = $id;
        return $this->order;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setDeliveryId(int $id): Order
    {
        $this->order->delivery_id = $id;
        return $this->order;
    }

    /**
     * @param string $ids
     * @return Order
     */
    public function setGoodsIds(string $ids): Order
    {
        $this->order->goods_ids = $ids;
        return $this->order;
    }

    /**
     * @param float $total
     * @return Order
     */
    public function setTotal(float $total): Order
    {
        $this->order->total = $total;
        return $this->order;
    }

    /**
     * @param string $address
     * @return Order
     */
    public function setAddress(string $address): Order
    {
        $this->order->address = $address;
        return $this->order;
    }

    /**
     * @param string $name
     * @return Order
     */
    public function setName(string $name): Order
    {
        $this->order->name = $name;
        return $this->order;
    }

    /**
     * @return Order
     */
    public function store(): bool
    {
        if ($this->order->save()) {
            return true;
        }

        return false;
    }
}
