<?php

namespace App\Classes\Order;

use App\Classes\DTO\OrderDTO;
use App\Classes\Order\OrderCreatorInterface;
use Illuminate\Support\Facades\Validator;

/**
 * Class OrderCreator
 *
 * Сlass for validation and creation the order
 *
 * @package App\Classes\DTO
 */
class OrderCreator implements OrderCreatorInterface
{
    /**
     * @param array $orderData
     * @return \App\Classes\DTO\OrderDTO
     */
    public function make(array $orderData): array
    {
        $validationResponse = $this->validation($orderData);

        if ($validationResponse['status'] != 200) {
            return $validationResponse;
        }

        $dto = new OrderDTO();
        $dto->setUserId($orderData['user_id']);
        $dto->setDeliveryId($orderData['delivery_id']);
        $dto->setGoodsIds($orderData['goods_ids']);
        $dto->setTotal($orderData['total']);

        $storeResponse = $dto->store();

        return ['status' => $storeResponse];
    }

    /**
     * @param array $orderData
     * @return array
     */
    protected function validation(array $orderData): array
    {
        $rules = [
            'user_id' => 'required|integer',
            'delivery_id' => 'required|integer',
            'goods_ids' => 'required|string',
            'total' => 'required|numeric',
        ];

        $validator = Validator::make($orderData, $rules);

        if ($validator->fails()) {
            return ['status' => 400, 'msg' => $validator->messages()->all()];
        }

        return ['status' => 200];
    }
}
