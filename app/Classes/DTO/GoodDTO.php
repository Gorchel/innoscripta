<?php

namespace App\Classes\DTO;

use App\Good;

/**
 * Class GoodDTO
 *
 * Сlass for assembling goods
 *
 * @package App\Classes\DTO
 */
class GoodDTO
{
    /**
     * @var Good
     */
    protected $good;

    /**
     * GoodDTO constructor.
     */
    public function __construct()
    {
        $this->good = new Good;
    }

    /**
     * @param string $name
     * @return Good
     */
    public function setName(string $name): Good
    {
        $this->good->name = $name;
        return $this->good;
    }

    /**
     * @param string $description
     * @return Good
     */
    public function setDescription(string $description): Good
    {
        $this->good->description = $description;
        return $this->good;
    }

    /**
     * @param float $price
     * @return Good
     */
    public function setPrice(float $price): Good
    {
        $this->good->price = $price;
        return $this->good;
    }

    /**
     * @param string $imgPath
     * @return Good
     */
    public function setImgPath(string $imgPath): Good
    {
        $this->good->img_path = $imgPath;
        return $this->good;
    }

    /**
     * @return Good
     */
    public function store(): bool
    {
        if ($this->good->save()) {
            return true;
        }

        return false;
    }
}
