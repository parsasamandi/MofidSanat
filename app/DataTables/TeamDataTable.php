<?php

namespace App\DataTables;

use App\Models\Team;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
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
            ->rawColumns(['action','image','linkedin_address'])
            ->addColumn('action', function (Team $team){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$team->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$team->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            })
            ->editColumn('name', function (Team $team){
                return $team->name;
            })
            ->editColumn('responsibility', function(Team $team){
                return $team->responsibility;
            })
            ->editColumn('linkedin_address', function(Team $team){
                return <<<ATAG
                            <a href="$team->linkedin_address">باز کردن آدرس</a>
                        ATAG;  
            })
            ->editColumn('size', function(Team $team){
                return $team->size;
            })
            ->editColumn('image', function(Team $team){
                return "<img src=/images/" . $team->image . " height='auto' width='100px' />";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TeamDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Team $model)
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
            ->setTableId('teamTable')
            ->minifiedAjax(route('team.list.table'))
            ->columns($this->getColumns())
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
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام')
                ->addClass('column-title'),
            Column::make('responsibility')
            ->title('مسؤلیت')
                ->addClass('column-title'),
            Column::make('linkedin_address')
            ->title('آدرس لینکدین')
                ->addClass('column-title'),
            Column::make('size')
            ->title('اندازه')
                ->addClass('column-title'),
            Column::make('image')
            ->title('تصویر')
                ->addClass('column-title'),
            Column::computed('action') // This Column is not in database
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
        return 'Team_' . date('YmdHis');
    }
}
