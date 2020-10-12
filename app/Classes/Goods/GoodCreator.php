<?php

namespace App\Classes\Goods;

use App\Classes\DTO\GoodDTO;
use App\Classes\Goods\GoodCreatorInterface;
use Illuminate\Support\Facades\Validator;

/**
 * Class GoodCreator
 *
 * Сlass for validation and creation the good
 *
 * @package App\Classes\DTO
 */
class GoodCreator implements GoodCreatorInterface
{
    /**
     * @param array $goodData
     * @return \App\Classes\DTO\GoodDTO
     */
    public function make(array $goodData): array
    {
        $validationResponse = $this->validation($goodData);

        if ($validationResponse['status'] != 200) {
            return $validationResponse;
        }

        $dto = new GoodDTO;
        $dto->setName($goodData['name']);
        $dto->setDescription($goodData['description']);
        $dto->setImgPath($goodData['img_path']);
        $dto->setPrice($goodData['price']);

        $storeResponse = $dto->store();

        return ['status' => $storeResponse];
    }

    /**
     * @param array $goodData
     * @return array
     */
    protected function validation(array $goodData): array
    {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'img_path' => 'required|string',
        ];

        $validator = Validator::make($goodData, $rules);

        if ($validator->fails()) {
            return ['status' => 400, 'msg' => $validator->messages()->all()];
        }

        return ['status' => 200];
    }
}
