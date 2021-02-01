<?php

namespace App\DataTables;

use App\Models\Cat;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->editColumn('name', function (Cat $category) {
                return $category->name;
            })
            ->addColumn('action', function (Cat $category) {
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$category->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$category->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;      
            })
            ->editColumn('status', function (Cat $category) {
                if($category->status === Cat::VISIBLE) return 'فعال';
                else if($category->status === Cat::HIDDEN) return 'غیر فعال';
                else return '-';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Cat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cat $model)
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
            ->setTableId('categoryTable')
            ->minifiedAjax(route('category.list.table'))
            ->columns($this->getColumns())
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->info(false)
            ->pageLength(8)
            ->responsive(true)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->language(asset('js/Persian.json'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex') // connected to line 226 column
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام')
                ->addClass('column-title'),
            Column::make('status')
                ->title('وضعیت')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
            ->title('ویرایش/حذف')
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
    protected function filename()//excel method
    {
        return 'Categories_' . date('YmdHis');
    }
}
