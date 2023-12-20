<?php

namespace App\DataTables;

use App\Models\Generation;
use App\Models\GenerationImage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class ImageGenerationDataTableInprogress extends DataTable
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
            ->filterColumn('generation_id', function ($query, $keyword) {
                $sql = "leonardo_generation_id like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('generation_id',function ($generation){
                return !is_null($generation->leonardo_generation_id) ? $generation->leonardo_generation_id : '-';
            })
            ->addColumn('status', function ($generation) {
                return $generation->status === 'pending' ? 'Inprogress' : 'Completed';
            })
            ->escapeColumns(
                []
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Generation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Generation $model)
    {
        $userId = $this->userId;
        $query = $model->newQuery();
        if($userId != 0){
            $query = $query->where('user_id', $userId);
        }
        $query = $query->whereStatus('pending');
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('generation-image-table')
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
            Column::make('generation_id')->width(30),
            Column::make('Status')->name('status')->data("status")
                ->addClass('text-center')
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
        return 'Generation' . date('YmdHis');
    }
}
