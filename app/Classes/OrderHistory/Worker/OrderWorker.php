<?php

namespace App\Classes\OrderHistory\Worker;

use App\Classes\OrderHistory\WorkerInterface;
use App\Order;

/**
 * Class HistoryGetter
 * @package App\Classes\OrderHistory\Worker
 */
class OrderWorker implements WorkerInterface
{
    /**
     * @var Order
     */
    protected $model;

    /**
     * HistoryGetter constructor.
     */
    public function __construct()
    {
        $this->model = new Order;
    }

    /**
     * @param array $options
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getList(array $options = [])
    {
        $query = $this->model->newQuery();

        if (isset($options['user_id'])) {
            $query->where('user_id', $options['user_id']);
        }

        $query->orderBy('created_at', 'desc');

        return $query->simplePaginate(10);
    }
}
