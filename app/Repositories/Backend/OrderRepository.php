<?php

namespace App\Repositories\Backend;

use App\Models\Order;
use App\Models\OrderSaleDetail;
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

    public function updateOrderStatus(array $data){
        $order = Order::where('id', $data['order_id'])->first();
        if(!empty($order)){
            if($data['status'] == "shipped"){
                $order->order_shipped_date = date('Y-m-d H:i:s');
            }else if($data['status'] == "cancelled"){
                $order->order_cancelled_date = date('Y-m-d H:i:s');
            }else if($data['status'] == "delivered"){
                $order->order_delivered_date = date('Y-m-d H:i:s');
            }

            if(isset($data['remarks'])){
                $order->cancel_reason = $data['remarks'];
            }

            $order->order_status = $data['status'];
            $order->save();
            $orderSaleDetails = OrderSaleDetail::where('order_id', $order->id)->get();
            foreach ($orderSaleDetails as $key => $orderSaleDetail) {
                $orderSaleDetail->order_status = $order->order_status;
                $orderSaleDetail->save();
            }
        }

        return $order;
    }
}
