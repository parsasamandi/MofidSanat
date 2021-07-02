<?php

namespace App\DataTables;

use App\Models\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
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
        ->rawColumns(['action','font_awesome'])
        ->editColumn('font_awesome', function(Service $service) {
            return '<i class="'.$service->font_awesome.'"></i>';
        })
        ->addColumn('action', function (Service $service){
            return $this->dataTable->setAction($service->id);
        });
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ServiceDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model)
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
        return $this->dataTable->html($this->builder(), 
                $this->getColumns(), 'service');
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
            Column::make('title')
            ->title('تیتر'),
            Column::make('description')
            ->title('توضیحات'),
            Column::make('font_awesome')
            ->title('آیکن'),
            $this->dataTable->setActionCol()
        ];
    }
}
