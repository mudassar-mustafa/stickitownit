<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class PackageOrderDataTable extends DataTable
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
            ->filterColumn('id', function ($query, $keyword) {
                $sql = "id like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->filterColumn('order_type', function ($query, $keyword) {
                $sql = "order_type like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->filterColumn('order_date', function ($query, $keyword) {
                $sql = "order_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->filterColumn('payment_method', function ($query, $keyword) {
                $sql = "payment_method like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->filterColumn('order_status', function ($query, $keyword) {
                $sql = "order_status like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('order_id', function ($order) {
                return  'ST-'.date('Y', strtotime($order->created_at)).'-'.$order->id ;
            })
            ->addColumn('order_type', function ($order) {
                return empty($order->order_type) ? "None" : $order->order_type;
            })
            ->addColumn('buyer_id', function ($order) {
                return empty($order->buyer_detail) ? "--" : "".$order->buyer_detail->name."(".$order->buyer_detail->id.")";
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
            ->addColumn('order_status', function ($order) {
                return '<span class="badge rounded-pill btn btn-success">Completed</span>';
            })
            ->escapeColumns(
                []
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        $userId = $this->userId;

        if($this->request->buyerIds != "null" && $this->request->buyerIds != null){
            $userId = $this->request->buyerIds;     
        }

        $order = $model->where('order_type', 'Package')->newQuery();
        if($userId != 0){
            $order = $order->where('buyer_id', $userId);
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
            Column::make('Order Date')->name('order_date')->data("order_date")
                ->addClass('text-center'),
            Column::make('Payment Method')->name('payment_method')->data("payment_method")
                ->addClass('text-center'),
            Column::make('Total Amount')->name('order_total_amount')->data("order_total_amount")
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
