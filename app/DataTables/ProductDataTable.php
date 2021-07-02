<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Category;
use App\Models\Media;
use App\Models\Subcategory;
use App\Models\Status;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;
use App\Datatables\GeneralDataTable;


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
                        return "<img src=/images/" . $media->media_url . " class='dataTableImage' />";
                    else if($media->type === MEDIA::VIDEO) 
                        return '<iframe src="' . $media->media_url . '"width="50%"></iframe>';
                } 
            })
            ->filterColumn('category_id', function($query, $keyword) {
                return $this->dataTable->filterCategoryCol($query, $keyword); 
            })
            ->addColumn('subcategory_id', function(Product $product) {
                return $product->subcategory->name ?? '-';
            })
            ->filterColumn('subcategory_id', function($query, $keyword) {

                return $this->dataTable->filterColumn($query, 
                            'subcategory_id in (select id from subcategories where name like ?)', $query);
            })
            ->editColumn('status', function(Product $product) {
                return $this->dataTable->setStatusCol($product->statuses->status);
            })
            ->addColumn('action', function (Product $product) {
                return $this->dataTable->setAction($product->id); 
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
            $this->dataTable->getIndexCol(),
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
            $this->dataTable->setActionCol()
        ];
    }
}



