<?php

namespace App\DataTables;

use App\Models\GenerationImage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Form;

class ImageGenerationDataTable extends DataTable
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

            ->addColumn('image', function ($generationImage) {
                return ($generationImage->image != null) ? '<img width="50" height="50" class="img-thumbnail"
                id="img" src="'.$generationImage->image.'"
                alt="your image"/>' : '<span></span>';
            })
            ->escapeColumns(
                []
            )
            ->addColumn('action', function ($generationImage) {

                $image  = ($generationImage->image != null) ? $generationImage->image : '#';
                $downloadBtn = '<a href="'. $image .'" download class="btn btn-primary" style="font-size: 10px;width: 100%; margin-bottom: 3px;">Download</a>';


                return $downloadBtn;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GenerationImage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GenerationImage $model)
    {
        $userId = $this->userId;
        $query = $model->newQuery();
        if($userId != 0){
            $query = $query->where('user_id', $userId);
        }
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
            Column::make('generation_id'),
            Column::make('Image')->name('image')->data("image")
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
        return 'GenerationImage' . date('YmdHis');
    }
}
