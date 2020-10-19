<?php

namespace App\Classes\OrderHistory;

/**
 * Class HistoryGetter
 * @package App\Classes\OrderHistory
 */
class HistoryGetter implements HistoryGetterInterface
{
    /**
     * @var WorkerInterface
     */
    protected $worker;

    /**
     * HistoryGetter constructor.
     * @param WorkerInterface $worker
     */
    public function __construct(WorkerInterface $worker)
    {
        $this->worker = $worker;
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function getList(array $options = [])
    {
        $options = [
            'user_id' => auth()->user()->id,
        ];

        return $this->worker->getList($options);
    }

}
