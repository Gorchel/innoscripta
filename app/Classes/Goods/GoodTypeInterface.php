<?php

namespace App\Classes\Goods;

/**
 * Interface GoodTypeInterface
 *
 * The Interface for type of good (pizza, sushi ...)
 *
 * @package App\Classes\Goods
 */
interface GoodTypeInterface
{
    /**
     * @param array $options
     * @return mixed
     */
    public function getList(array $options = []);
}
