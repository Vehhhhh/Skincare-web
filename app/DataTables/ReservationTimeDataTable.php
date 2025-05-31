<?php

namespace App\DataTables;

use App\Models\ReservationTime;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReservationTimeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            //dynamic href routes. each href return routes like '/staff/slider/1/edit' for example.
            //and then /staff/slider/2/edit and /staff/slider/3/edit and so on (dynamic).
            $edit = "<a href='" . route('staff.reservation-time.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></i></i></a>";
            $delete = "<a href='" . route('staff.reservation-time.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='fas fa-trash-alt'></i></a>";

            return $edit . $delete;
        })
        ->addColumn('status', function ($query) {
            if ($query->status === 1) { //in here write true if using postgres, write 1 if using mysql.
                return '<span class="badge badge-primary">ACTIVE</span>';
            } else {
                return '<span class="badge badge-danger">INACTIVE</span>';
            }
        })
        ->rawColumns(['action', 'status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ReservationTime $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reservationtime-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('start_time'),
            Column::make('end_time'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ReservationTime_' . date('YmdHis');
    }
}
