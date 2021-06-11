<?php

namespace App\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GeneralDataTable 
{
    /**
     * html builder | dataTable builder / table columns / table name
     * 
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html($builder, $columns, $table)
    {
        return $builder
            ->setTableId("{$table}Table")
            ->minifiedAjax(route("admin.list.table"))
            ->columns($columns)
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->lengthMenu([10,25,40])
            ->info(false)
            ->ordering(true)
            ->responsive(true)
            ->pageLength(8)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->language(asset('js/persian.json'));
    }

    // Computed column in datatables for delete,update,insertion
    public function action($id) {

    }
}
