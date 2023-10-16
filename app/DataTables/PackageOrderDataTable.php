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
            ->filterColumn('order_type', function ($query, $keyword) {
                $sql = "order_type like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
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
            )
            ->addColumn('action', function ($order) {

                $deleteAction = '<a form-alert-message="Kindly Confirm the removal of this Order" ' .
                    'form-id="chargeDelete' . $order->id . '" class="deleteModel" href="'
                    . route('backend.pages.order.destroy', $order->id) . '" data-toggle="tooltip" ' .
                    'data-original-title="Remove Order"> ' .
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a>';

                $deleteAction .= Form::open(['action' => ['App\Http\Controllers\Backend\OrderController@destroy', $order->id],
                    'method' => 'DELETE', 'id' => 'chargeDelete' . $order->id . '']);
                $deleteAction .= Form::close();

                return $deleteAction;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        $userId = $this->userId;
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
            Column::make('Order No#')->name('id')->data("id"),
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
