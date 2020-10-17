<?php

namespace App\Classes\OrderHistory;

interface HistoryGetterInterface
{
    public function __construct(WorkerInterface $worker);
    public function getList(array $options = []);
}
