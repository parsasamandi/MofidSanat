<?php

namespace App\DataTables;

use App\Models\PhoneNumber;
use App\DataTables\PhoneNumberDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;

class PhoneNumberDataTable extends DataTable
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
            ->rawColumns(['action'])
            ->editColumn('number', function(PhoneNumber $phoneNumber) {
                return $phoneNumber->number;
            })
            ->editColumn('product_id', function (PhoneNumber $phoneNumber) {
                return $phoneNumber->product->name;
            })
            ->addColumn('action', function(PhoneNumber $phoneNumber) {
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$phoneNumber->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$phoneNumber->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
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
        return $this->builder()
            ->setTableId('phoneNumberTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('phoneNumber.list.table'))
            ->lengthMenu([10,25,50,100])
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
            Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false)
                ->addClass('column-title'),
            Column::make('number')
                ->title('شماره تلفن')
                ->addClass("column-title"),
            Column::make('product_id')
                ->title('محصول')
                ->addClass('column-title'),
            Column::computed('action')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش')
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
        return 'PhoneNumber_' . date('YmdHis');
    }
}
