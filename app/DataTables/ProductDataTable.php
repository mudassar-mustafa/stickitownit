<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class ProductDataTable extends DataTable
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
            ->filterColumn('title', function ($query, $keyword) {
                $sql = "title like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('title', function ($product) {
                return empty($product->title) ? "None" : $product->title;
            })
            ->addColumn('status', function ($product) {
                return ($product->status == "active") ? '<span class="badge rounded-pill btn btn-success">Active</span>' : '<span class="badge rounded-pill btn btn-danger">De-active</span>';
            })
            ->addColumn('variations', function ($product) {
                if($product->product_type == "variation"){
                    return '<a href="' . route("backend.pages.product.variationEdit", $product->id) . '" class="badge rounded-pill btn btn-primary">Variations</a>';
                }else{
                    return  'N/A';
                }
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($product) {



                $editAction = '<a href="' . route("backend.pages.product.edit", $product->id) . '" class="item-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>';



                $deleteAction = '<a form-alert-message="Kindly Confirm the removal of this Product" ' .
                    'form-id="chargeDelete' . $product->id . '" class="deleteModel" href="'
                    . route('backend.pages.product.destroy', $product->id) . '" data-toggle="tooltip" ' .
                    'data-original-title="Remove Product"> ' .
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a>';

                $deleteAction .= Form::open(['action' => ['App\Http\Controllers\Backend\ProductController@destroy', $product->id],
                    'method' => 'DELETE', 'id' => 'chargeDelete' . $product->id . '']);
                $deleteAction .= Form::close();

                if($product->product_type == "variation"){
                    return  $editAction . $deleteAction;
                }else{
                    return $editAction . $deleteAction;
                }


            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
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
            Column::make('Title')->name('title')->data("title")
                ->addClass('text-center'),
            Column::make('Status')->name('status')->data("status")
                ->addClass('text-center'),
            Column::make('Variations')->name('variations')->data("variations")
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
        return 'Products' . date('YmdHis');
    }
}
