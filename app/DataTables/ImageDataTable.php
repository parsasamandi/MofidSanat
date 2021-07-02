<?php

namespace App\DataTables;

use App\Models\Media;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;


class ImageDataTable extends DataTable
{
    public $dataTable;

    public function __construct() {
        $this->dataTable = new GeneralDataTable();
    }
    
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action', 'media_url']) 
            ->editColumn('media_url', function(Media $media) {
                return "<img src=/images/" . $media->media_url . " class='dataTableImage' />";
            })
            ->editColumn('media_id', function (Media $media) {
                return $media->media->name;
            })
            ->filterColumn('media_id', function($query,$keyword) {
                return $this->dataTable->filterColumn($squery, 
                            'media_id in (select id from media where name like ?)', $keyword);
            })
            ->addColumn('action', function(Media $media){
                return $this->dataTable->setAction($media->id); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ImageDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Media $model)
    {
        return $model->where('type', $model::IMAGE);
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->html($this->builder(), 
                $this->getColumns(), 'image');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            $this->dataTable->getIndexCol(),
            Column::make('media_url')
            ->title('رسانه'),
            Column::make('media_id')
            ->title('محصول مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol()
        ];
    }
}
