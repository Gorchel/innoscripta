<?php

namespace App\Classes\Goods\Types;

use App\Classes\Goods\GoodTypeInterface;
use App\Good;

/**
 * Class PizzaType
 * @package App\Classes\Goods\Types
 */
class PizzaType implements GoodTypeInterface
{
    /**
     * @param array $options
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getList(array $options = [])
    {
        $query = Good::query();
        $query->select('id','name','description','price','img_path');

        if (!empty($options['ids'])) {
            $query->whereIn('id', $options['ids']);
        }

        return $query->simplePaginate(20);
    }

}
