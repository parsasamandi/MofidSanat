<?php

namespace App\DataTables;

use App\Models\PhoneNumber;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;

class PhoneNumberDataTable extends DataTable
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
            ->rawColumns(['action'])
            ->addColumn('product_id', function (PhoneNumber $phoneNumber) {
                return $phoneNumber->product->name;
            })
            ->filterColumn('product_id', function ($query,$keyword) {
                return $this->dataTable->filterProductCol($query, $keyword);
            })
            ->addColumn('action', function(PhoneNumber $phoneNumber) {
                return $this->dataTable->setAction($phoneNumber->id); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PhoneNumberDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PhoneNumber $model)
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
                $this->getColumns(), 'product');
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
            Column::make('number')
            ->title('شماره تلفن'),
            Column::make('product_id')
            ->title('محصول')
                ->orderable(false),
            $this->dataTable->setActionCol()
        ];
    }
}
