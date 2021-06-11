<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Category;
use App\Models\Media;
use App\Models\Subcategory;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;


class ProductDataTable extends DataTable
{
    public $dataTable;

    public function __construct() {
        $this->dataTable = new GeneralDataTable();
    }
    
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
            ->rawColumns(['action','media'])
            ->addColumn('media', function (Product $product) {
                foreach($product->media as $media) {
                    if($media->type === MEDIA::IMAGE) 
                        return "<img src=/images/" . $media->media_url . " height='auto' width='50%' />";
                    else if($media->type === MEDIA::VIDEO) 
                        return '<iframe src="' . $media->media_url . '"width="50%" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
                } 
            })
            ->addColumn('category_id', function(Product $product) {
                return $product->cat->name ?? '-';
            })
            ->filterColumn('category_id', function($query, $keyword) {
                $sql = "category_id in (select id from categories where name like ?)";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('subcategory_id', function(Product $product) {
                return $product->subcategory->name ?? '-';
            })
            ->filterColumn('subcategory_id', function($query, $keyword) {
                $sql = "subcategory_id in (select id from subcategories where name like ?)";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('status', function(Product $product) {
                if($product->statuses->status == Status::ACTIVE) return 'موجود';
                else if($product->statuses->status == Status::INACTIVE) return 'ناموجود';
            })
            ->addColumn('action', function (Product $product) {
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$product->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$product->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;      
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('media') // This column is not in database
            ->title('ویدئو | عکس')
                ->orderable(false),
            Column::make('name')
            ->title('نام'),
            Column::make('model')
            ->title('مدل'),
            Column::make('price')
            ->title('هزینه'),
            Column::make('description')
            ->title('توضیحات'),
            Column::make('category_id')
            ->title('دسته بندی اول')
                ->orderable(false),
            Column::make('subcategory_id')
            ->title('دسته بندی دوم'),
            Column::make('status')
            ->title('وضعیت'),
            Column::make('size')
            ->title('اندازه دوره (۱ تا ۱۲)'),
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
    protected function filename()//excel method
    {
        return 'Product_' . date('YmdHis');
    }
}



