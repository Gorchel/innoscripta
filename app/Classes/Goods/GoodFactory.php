<?php

namespace App\Classes\Goods;

use App\Classes\Goods\GoodFactoryTypeInterface;
use App\Classes\Goods\Types\PizzaType;

/**
 * Class GoodFactory
 * @package App\Classes\Goods
 */
class GoodFactory implements GoodFactoryTypeInterface
{
    /**
     * @var PizzaType
     */
    protected $type;

    /**
     * GoodFactory constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        switch ($type) {
//            case 'pizza':
//                $this->type = new PizzaType;
//                break;
            default:
                $this->type = new PizzaType;
                break;
        }
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function getList(array $options = [])
    {
        return $this->type->getList($options);
    }
}
