<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param $query
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->filterColumn('order_type', function ($query, $keyword) {
                $sql = "order_type like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('order_id', function ($order) {
                return  'ST-'.date('Y', strtotime($order->created_at)).'-'.$order->id ;
            })->addColumn('order_type', function ($order) {
                return empty($order->order_type) ? "None" : $order->order_type;
            })
            ->addColumn('buyer_id', function ($order) {
                return empty($order->buyer_detail) ? "--" : "".$order->buyer_detail->name."(".$order->buyer_detail->id.")";
            })
            ->addColumn('seller_id', function ($order) {
                return empty($order->seller_detail) ? "--" : "".$order->seller_detail->name."(".$order->seller_detail->id.")";
            })
            ->addColumn('order_date', function ($order) {
                return empty($order->order_date) ? "--" : date('Y-m-d H:i:s', strtotime($order->order_date));
            })
            ->addColumn('payment_method', function ($order) {
                return empty($order->payment_method) ? "--" : $order->payment_method;
            })
            ->addColumn('order_total_amount', function ($order) {
                return empty($order->order_total_amount) ? "--" : $order->order_total_amount;
            })
            ->addColumn('feedback', function ($order) {
                if(empty($order->order_review) || count($order->order_review) == 0 || is_null($order->order_review[0])){
                    return "--";
                }else{
                    return $order->order_review[0]->rating." Stars";
                }
            })
            ->addColumn('order_status', function ($order) {
                if($order->order_status == "printed"){
                    return '<span class="badge rounded-pill btn btn-warning">Printed</span>';
                }else if($order->order_status == "cancelled"){
                    return  '<span class="badge rounded-pill btn btn-danger">Cancelled</span>';
                }else if($order->order_status == "delivered" || $order->order_status == "completed"){
                    return '<span class="badge rounded-pill btn btn-success">'.ucfirst($order->order_status).'</span>';
                }else{
                    return '<span class="badge rounded-pill btn btn-secondary">Pending</span>';
                }
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($order) {

                $updateStatus = "";
                if(($order->order_status == "cancelled" || $order->order_status == "completed") || auth()->user()->hasrole('Customer') == true ){

                }else{
                    $updateStatus = '<button type="button" class="btn btn-primary" style="font-size: 10px;width: 100%; margin-bottom: 3px;" id="btnStatus'.$order->id.'" data-bs-toggle="modal" data-order_status ="'.$order->order_status.'"  onclick="updateStatus('.$order->id.');">Update Status</button>';
                }

                $feedback = "";
                if($order->order_status == "delivered" && auth()->user()->hasrole('Customer') == true && empty($order->order_review)){
                    $feedback = '<button type="button" class="btn btn-primary" style="font-size: 10px;width: 100%; margin-bottom: 3px;" id="btnStatus'.$order->id.'" data-bs-toggle="modal" data-order_status ="'.$order->order_status.'"  onclick="updateFeedback('.$order->id.');">Feedback</button>';
                }

                $orderDetail = '<button type="button" type="button" class="btn btn-info" style="font-size: 10px;width: 100%; color:#ffffff;" onclick="showOrderDetail('.$order->id.');">Order Detail</button>';



                return $updateStatus.$feedback.$orderDetail;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        $buyerId = $this->buyerId;
        $sellerId = $this->sellerId;
        $order = $model->where('order_type', 'Sale')->newQuery();
        if($buyerId != 0){
            $order = $order->where('buyer_id', $buyerId);
        }
        if($sellerId != 0){
            $order = $order->where('seller_id', $sellerId);
        }
        return $order;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters(['drawCallback' => 'function() { drawCallBackHandler(); }',]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('Order No#')->name('order_id')->data("order_id"),
            Column::make('Order Type')->name('order_type')->data("order_type")
                ->addClass('text-center'),
            Column::make('Order Status')->name('order_status')->data("order_status")
                ->addClass('text-center'),
            Column::make('Buyer')->name('buyer_id')->data("buyer_id")
                ->addClass('text-center'),
            Column::make('Seller')->name('seller_id')->data("seller_id")
                ->addClass('text-center'),
            Column::make('Order Date')->name('order_date')->data("order_date")
                ->addClass('text-center'),
            Column::make('Payment Method')->name('payment_method')->data("payment_method")
                ->addClass('text-center'),
            Column::make('Total Amount')->name('order_total_amount')->data("order_total_amount")
                ->addClass('text-center'),
            Column::make('Feedback')->name('feedback')->data("feedback")
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Orders' . date('YmdHis');
    }
}
