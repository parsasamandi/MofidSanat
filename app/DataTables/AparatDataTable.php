<?php

namespace App\DataTables;

use App\Models\Media;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AparatDataTable extends DataTable
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
                return '<iframe src="'.$media->media_url.'"></iframe>';
            })
            ->addColumn('product_id', function (Media $media) {
                return $media->media->name;
            })
            ->filterColumn('product_id', function($query,$keyword) {

                return $this->dataTable->filterProductCol($query, $keyword);
            })
            ->addColumn('action', function(Media $media){
                return $this->dataTable->setAction($media->id); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AparatDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Media $model)
    {
        return $model->where('type', $model::VIDEO);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->html($this->builder(), 
                $this->getColumns(), 'aparat');
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
            Column::make('product_id')
            ->title('محصول مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol()
        ];
    }
}
