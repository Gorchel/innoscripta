<?php

namespace App\Classes\Goods;

use App\Classes\DTO\GoodDTO;

/**
 * Interface GoodCreatorInterface
 * @package App\Classes\Goods
 */
interface GoodCreatorInterface
{
    /**
     * @param $goodData
     * @return array
     */
    public function make(array $goodData): array;
}
