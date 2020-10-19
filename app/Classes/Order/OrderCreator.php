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
     */
    public function make(array $orderData)
    {
        $validationResponse = $this->validation($orderData);

        if ($validationResponse['status'] != 200) {
            return ['status' => 400, 'data' => $validationResponse['msg']];
        }

        $dto = new OrderDTO();
        $dto->setUserId($orderData['user_id']);
        $dto->setName($orderData['name']);
        $dto->setAddress($orderData['address']);
        $dto->setDeliveryId($orderData['delivery_id']);
        $dto->setGoodsIds($orderData['goods_ids']);
        $dto->setTotal($orderData['total']);

        $storeResponse = $dto->store();

        return ['status' => 200, 'data' => $storeResponse];
    }

    /**
     * @param array $orderData
     * @return array
     */
    protected function validation(array $orderData): array
    {
        $rules = [
            'delivery_id' => 'required|integer',
            'goods_ids' => 'required|string',
            'total' => 'required|numeric',
            'address' => 'required|string',
            'name' => 'required|string',
        ];

        $validator = Validator::make($orderData, $rules);

        if ($validator->fails()) {
            return ['status' => 400, 'msg' => $validator->messages()];
        }

        return ['status' => 200];
    }
}
