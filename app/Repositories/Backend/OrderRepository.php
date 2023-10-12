<?php

namespace App\Repositories\Backend;

use App\Models\Order;
use App\Contracts\Backend\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listOrder(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {

    }
}
