<?php

namespace App\DataTables;

use App\Models\ProductAttributeGroup;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class ProductVariationDataTable extends DataTable
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
            ->filterColumn('short_description', function ($query, $keyword) {
                $sql = "short_description like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('Visibility', function ($product) {
                $checked = "";
                if($product->visibilty == 1){
                    $checked = "checked";
                }
                return '<input type="checkbox" id="visibility'.$product->id.'" value="1" '.$checked.' />';
            })
            ->addColumn('short_description', function ($product) {
                return empty($product->short_description) ? "None" : $product->short_description;
            })
            ->addColumn('quantity', function ($product) {
                return '<input type="number" id="quantity'.$product->id.'" value="'.$product->quantity.'" />';
            })
            ->addColumn('price', function ($product) {
                return '<input type="number" step="any" id="price'.$product->id.'" value="'.$product->price.'" />';
            })
            ->addColumn('main_image', function ($product) {
                $inputField = '<input type="file" id="image'.$product->id.'" />';
                $inputImage = '<img src="'.$product->main_image.'" alt="image" style= "width: 50px;height: 50px;object-fit: contain;">';
                return $inputField . $inputImage;
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($product) {

                $editAction = '<a href="#" onclick="updateVariationData('.$product->id.')" class="item-edit"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.61 122.88"  width="24px" height="30px"><title>update</title><path d="M111.9,61.57a5.36,5.36,0,0,1,10.71,0A61.3,61.3,0,0,1,17.54,104.48v12.35a5.36,5.36,0,0,1-10.72,0V89.31A5.36,5.36,0,0,1,12.18,84H40a5.36,5.36,0,1,1,0,10.71H23a50.6,50.6,0,0,0,88.87-33.1ZM106.6,5.36a5.36,5.36,0,1,1,10.71,0V33.14A5.36,5.36,0,0,1,112,38.49H84.44a5.36,5.36,0,1,1,0-10.71H99A50.6,50.6,0,0,0,10.71,61.57,5.36,5.36,0,1,1,0,61.57,61.31,61.31,0,0,1,91.07,8,61.83,61.83,0,0,1,106.6,20.27V5.36Z"/></svg></a>';

                $deleteAction = '<a form-alert-message="Kindly Confirm the removal of this Product Variation" ' .
                    'form-id="chargeDelete' . $product->id . '" class="deleteModel" href="'
                    . route('backend.pages.product.destroyVariation', $product->id) . '" data-toggle="tooltip" ' .
                    'data-original-title="Remove Product Variation"> ' .
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a>';

                $deleteAction .= Form::open(['action' => ['App\Http\Controllers\Backend\ProductController@destroyVariation', $product->id],
                    'method' => 'DELETE', 'id' => 'chargeDelete' . $product->id . '']);
                $deleteAction .= Form::close();

                return $editAction . $deleteAction;


            })->rawColumns(['action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Rate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductAttributeGroup $model)
    {
        $id = $this->request->id;
        return $model->where('product_id', $id)->newQuery();
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
            Column::make('Visibility')->name('Visibility')->data("Visibility")
                ->addClass('text-center'),
            Column::make('Short Description')->name('short_description')->data("short_description")
                ->addClass('text-center'),
            Column::make('Quantity')->name('quantity')->data("quantity")
                ->addClass('text-center'),
            Column::make('Price')->name('price')->data("price")
                ->addClass('text-center'),
            Column::computed('main_image')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
