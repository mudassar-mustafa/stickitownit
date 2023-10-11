<?php

namespace App\DataTables;


use App\Models\ContactUs;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class ContactUsDataTable extends DataTable
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
            ->addColumn('name', function ($contactus) {
                return empty($contactus->name) ? "None" : $contactus->name;
            })
            ->addColumn('email', function ($contactus) {
                return empty($contactus->email) ? "None" : $contactus->email;
            })
            ->addColumn('message', function ($contactus) {
                return empty($contactus->message) ? "None" : $contactus->message;
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($contactus) {

                $deleteAction = '<a form-alert-message="Kindly Confirm the removal of this category" ' .
                    'form-id="chargeDelete' . $contactus->id . '" class="deleteModel" href="'
                    . route('backend.pages.contact-us.destroy', $contactus->id) . '" data-toggle="tooltip" ' .
                    'data-original-title="Remove Contact Us"> ' .
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a>';

                $deleteAction .= Form::open(['action' => ['App\Http\Controllers\Backend\ContactUsController@destroy', $contactus->id],
                    'method' => 'DELETE', 'id' => 'chargeDelete' . $contactus->id . '']);
                $deleteAction .= Form::close();

                return $deleteAction;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContactUs $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContactUs $model)
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
            ->setTableId('contactus-table')
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
            Column::make('Message')->name('message')->data("message")
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
