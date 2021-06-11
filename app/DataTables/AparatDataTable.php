<?php

namespace App\DataTables;

use App\Models\Media;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
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
            ->rawColumns(['action','media_url']) 
            ->editColumn('media_url', function(Media $media) {
                return '<iframe src="'.$media->media_url.'"  width="50%" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
            })
            ->addColumn('product_id', function (Media $media) {
                return $media->product->name;
            })
            ->filterColumn('product_id', function($query,$keyword) {
                $sql = "product_id in (select id from product where name like ?)";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function(Media $media){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$media->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$media->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
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
        return $model->where('type',1);
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
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('media_url')
            ->title('رسانه'),
            Column::make('product_id')
            ->title('محصول مرتبط')
                ->orderable(false),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش')
            ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Aparat_' . date('YmdHis');
    }
}
