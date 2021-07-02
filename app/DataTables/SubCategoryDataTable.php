<?php

namespace App\DataTables;

use App\Models\Subcetegory;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
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
            ->rawColumns(['action', 'status'])
            ->editColumn('name', function(Subcategory $subcategory) {
                return $subcategory->name;   
            })
            ->editColumn('status', function (Subcategory $subcategory) {
                return $this->dataTable->setStatusCol($category->statuses->status);
            })
            ->addColumn('category_id', function (Subcategory $subcategory) {
                return optional($subcategory->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                return $this->dataTable->filterCategoryCol($query, $keyword); 
            })
            ->addColumn('action', function (Subcategory $subcategory) {
                return $this->dataTable->setAction($subcategory->id);    
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subcategory $model)
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
                $this->getColumns(), 'subcategory');
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
            Column::make('status')
            ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول'),
            $this->dataTable->setActionCol()
        ];
    }
}
