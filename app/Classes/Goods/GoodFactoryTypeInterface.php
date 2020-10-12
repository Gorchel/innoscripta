<?php

namespace App\Classes\Goods;

interface GoodFactoryTypeInterface
{
    public function __construct(string $type);
    public function getList(array $options = []);
}
