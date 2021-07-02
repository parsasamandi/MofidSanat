<?php

namespace App\DataTables;

use App\Models\Team;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
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
            ->rawColumns(['action','image','linkedin_address'])
            ->editColumn('linkedin_address', function(Team $team) {
                return "<a href='{$team->linkedin_address}'>باز کردن آدرس</a>";  
            })
            ->addColumn('image', function(Team $team){
                return "<img src=/images/" . optional($team)->media->media_url . " class='dataTableImage' />";
            })
            ->addColumn('action', function (Team $team){
                return $this->dataTable->setAction($team->id); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TeamDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Team $model)
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
                $this->getColumns(), 'team');
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
            Column::make('name')
            ->title('نام'),
            Column::make('responsibility')
            ->title('مسؤلیت'),
            Column::make('linkedin_address')
            ->title('آدرس لینکدین'),
            Column::make('size')
            ->title('اندازه'),
            Column::make('image')
            ->title('تصویر'),
            $this->dataTable->setActionCol()
        ];
    }
}
