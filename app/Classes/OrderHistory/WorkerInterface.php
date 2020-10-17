<?php

namespace App\Classes\OrderHistory;

interface WorkerInterface
{
    public function getList(array $options = []);
}
