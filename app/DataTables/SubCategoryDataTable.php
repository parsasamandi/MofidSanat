<?php

namespace App\DataTables;

use App\Models\Subcetegory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
{
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
                if($subcategory->statuses->status == Status::ACTIVE) return 'موجود';
                else if($subcategory->statuses->status == Status::INACTIVE) return 'ناموجود';
            })
            ->addColumn('category_id', function (Subcategory $subcategory) {
                return optional($subcategory->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                $sql = "category_id in (select id from cat where name like ?)";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function (Subcategory $subcategory) {
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$subcategory->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$subcategory->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;      
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
        return $this->builder()
            ->setTableId('subcategoryTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('subcategory.list.table'))
            ->dom('Bfrtip')
            ->orderBy(1)
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->info(false)
            ->responsive(true)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->language(asset('js/persian.json'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام')
                ->addClass('column-title'),
            Column::make('status')
                ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
            ->title('حذف،ویرایش')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->addClass('column-title')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Subcategory_' . date('YmdHis');
    }
}
