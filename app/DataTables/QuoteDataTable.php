<?php

namespace App\DataTables;


use App\Models\Quote;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class QuoteDataTable extends DataTable
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
            ->filterColumn('name', function ($query, $keyword) {
                $sql = "name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('name', function ($quote) {
                return empty($quote->name) ? "N/A" : $quote->name;
            })
            ->addColumn('email', function ($quote) {
                return empty($quote->email) ? "N/A" : $quote->email;
            })
            ->addColumn('phone', function ($quote) {
                return empty($quote->phone) ? "N/A" : $quote->phone;
            })
            ->addColumn('country', function ($quote) {
                return empty($quote->country) ? "N/A" : $quote->country;
            })
            ->addColumn('company', function ($quote) {
                return empty($quote->company) ? "N/A" : $quote->company;
            })
            ->addColumn('website', function ($quote) {
                return empty($quote->website) ? "N/A" : $quote->website;
            })
            ->addColumn('project', function ($quote) {
                return empty($quote->project) ? "N/A" : $quote->project;
            })
            ->addColumn('material_type', function ($quote) {
                return empty($quote->material_type) ? "N/A" : $quote->material_type;
            })
            ->addColumn('size', function ($quote) {
                return empty($quote->width) && (empty($quote->height)) ? "N/A" : $quote->width .' X '. $quote->height;
            })
            ->addColumn('quantity', function ($quote) {
                return empty($quote->quantity) ? "N/A" : $quote->quantity;
            })
            ->addColumn('file', function ($quote) {
                return ($quote->file != null) ? '<img width="50" height="50" class="img-thumbnail"
                id="img" src="'.$quote->file.'"
                alt="your image"/>' : '<span></span>';
            })->addColumn('message', function ($quote) {
                return empty($quote->message) ? "N/A" : $quote->message;
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($quote) {

                $deleteAction = '<a form-alert-message="Kindly Confirm the removal of this category" ' .
                    'form-id="chargeDelete' . $quote->id . '" class="deleteModel" href="'
                    . route('backend.pages.quote.destroy', $quote->id) . '" data-toggle="tooltip" ' .
                    'data-original-title="Remove Quotation"> ' .
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a>';

                $deleteAction .= Form::open(['action' => ['App\Http\Controllers\Backend\QuoteController@destroy', $quote->id],
                    'method' => 'DELETE', 'id' => 'chargeDelete' . $quote->id . '']);
                $deleteAction .= Form::close();

                return $deleteAction;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Quote $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quote $model)
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
            ->setTableId('quote-table')
            ->responsive()
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
            Column::make('Name')->name('name')->data("name")
                ->addClass('text-center'),
            Column::make('Email')->name('email')->data("email")
                ->addClass('text-center'),
            Column::make('Phone')->name('phone')->data("phone")
                ->addClass('text-left'),
            Column::make('Country')->name('country')->data("country")
                ->addClass('text-left'),
            Column::make('Company')->name('company')->data("company")
                ->addClass('text-left'),
            Column::make('Website')->name('website')->data("website")
                ->addClass('text-left'),
            Column::make('Project')->name('project')->data("project")
                ->addClass('text-left'),
            Column::make('Material Type')->name('material_type')->data("material_type")
                ->addClass('text-left'),
            Column::make('Size')->name('size')->data("size")
                ->addClass('text-left'),
            Column::make('Quantity')->name('quantity')->data("quantity")
                ->addClass('text-left'),
            Column::make('Message')->name('message')->data("message")
                ->addClass('text-left'),
            Column::make('Image')->name('file')->data("file")
                ->addClass('text-left'),
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
        return 'Contact-Us' . date('YmdHis');
    }
}
