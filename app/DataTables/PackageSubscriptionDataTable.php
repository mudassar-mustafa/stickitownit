<?php

namespace App\DataTables;

use App\Models\PackageSubscription;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class PackageSubscriptionDataTable extends DataTable
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
            ->filterColumn('package_name', function ($query, $keyword) {
                $sql = "package_name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('package_name', function ($package_subscription) {
                return empty($package_subscription->package_name) ? "None" : $package_subscription->package_name;
            })
            ->addColumn('package_type', function ($package_subscription) {
                return empty($package_subscription->package_type) ? "--" : $package_subscription->package_type;
            })
            ->addColumn('token', function ($package_subscription) {
                return empty($package_subscription->token) ? "--" : $package_subscription->token;
            })
            ->addColumn('start_date', function ($package_subscription) {
                return empty($package_subscription->start_date) ? "--" : date('Y-m-d H:i:s', strtotime($package_subscription->start_date));
            })
            ->addColumn('end_date', function ($package_subscription) {
                return empty($package_subscription->end_date) ? "--" : date('Y-m-d H:i:s', strtotime($package_subscription->end_date));
            })
            ->addColumn('remaing_token', function ($package_subscription) {
                return empty($package_subscription->remaing_token) ? "--" : $package_subscription->remaing_token;
            })
            ->addColumn('status', function ($package_subscription) {
                if($package_subscription->status == "expired"){
                    return  '<span class="badge rounded-pill btn btn-danger">Cancelled</span>';
                }else if($package_subscription->status == "active"){
                    return '<span class="badge rounded-pill btn btn-success">Active</span>';
                }else{
                    return '<span class="badge rounded-pill btn btn-secondary">Deactive</span>';
                }
            })
            ->escapeColumns(
                []
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PackageSubscription $model)
    {
        return $model->where('user_id', $this->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('package-subscription-table')
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
            Column::make('id'),
            Column::make('package_name')->name('package_name')->data("package_name")
                ->addClass('text-center'),
            Column::make('package_type')->name('package_type')->data("package_type")
                ->addClass('text-center'),
            Column::make('token')->name('token')->data("token")
                ->addClass('text-center'),
            Column::make('Start Date')->name('start_date')->data("start_date")
                ->addClass('text-center'),
            Column::make('End Date')->name('end_date')->data("end_date")
                ->addClass('text-center'),
            Column::make('Remaing Token')->name('remaing_token')->data("remaing_token")
                ->addClass('text-center'),
            Column::make('Status')->name('status')->data("status")
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
        return 'PackageSubscription' . date('YmdHis');
    }
}
