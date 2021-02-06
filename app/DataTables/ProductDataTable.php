<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Cat;
use App\Models\Media;
use App\Models\SubCat;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;


class ProductDataTable extends DataTable
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
            ->rawColumns(['action','image'])
            ->addColumn('image', function (Product $product) {
                foreach($product->media as $media) {
                    if($media->type === MEDIA::IMAGE) 
                        return "<img src=/images/" . $media->media_url . " height='auto' width='50%' />";
                    else if($media->type === MEDIA::VIDEO) {
                        return '<iframe src="' . $media->media_url . '"  width="50%" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>';
                    }
                }
                
            })
            ->editColumn('sc_id', function(Product $product) {
                return $product->sub_cat->name ?? '-';
            })
            ->editColumn('c_id', function(Product $product) {
                return $product->cat->name ?? '-';
            })
            ->editColumn('status', function(Product $product) {
                if($product->status === Product::VISIBLE) return 'موجود';
                else if($product->status === Product::HIDDEN) return 'غیر موجود';
                else return '-';
            })
            ->addColumn('action', function (Product $product) {
                $deleteAddress = URL::signedRoute('product.delete', ['id' => $product->id]);
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
        return $this->builder()
            ->setTableId('productTable')
            ->minifiedAjax(route('product.list.table'))
            ->columns($this->getColumns())
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
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::computed('image') // This column is not in database
            ->title('ویدئو | عکس')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام')
                ->addClass('column-title'),
            Column::make('model')
            ->title('مدل')
                ->addClass('column-title'),
            Column::make('price')
            ->title('هزینه')
                ->addClass('column-title'),
            Column::make('desc')
            ->title('توضیحات')
                ->addClass('column-title'),
            Column::make('c_id')
                ->title('دسته بندی سطح-۱')
                    ->addClass('column-title'),
            Column::make('sc_id')
            ->title('دسته بندی سطح-۲')
                ->addClass('column-title'),
            Column::make('status')
            ->title('وضعیت')
                ->addClass('column-title'),
            Column::make('size')
            ->title('اندازه')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
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
    protected function filename()//excel method
    {
        return 'Product_' . date('YmdHis');
    }
}



