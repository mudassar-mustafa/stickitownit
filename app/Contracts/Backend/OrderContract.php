<?php

namespace App\Contracts\Backend;

/**
 * Interface CityContract
 * @package App\Contracts
 */
interface OrderContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listOrder(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function updateOrderStatus(array $data);

    public function getOrderDetail($orderId);

    public function storeFeedback(array $params);

    public function getBuyerList($orderType);

    public function getSellerList($orderType);

    public function getCategoriesList();

}
