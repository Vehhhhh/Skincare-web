<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    //$query is an instance of $slider model, therefore we can access the id of a row by doing $query->id.
    //using this method to get data from database to show it on the frontend
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            //this adds new column to the datatable and inside that column we want to add 2 buttons which are edit and delete.
            ->addColumn('action', function ($query) {
                //dynamic href routes. each href return routes like '/admin/slider/1/edit' for example.
                //and then /admin/slider/2/edit and /admin/slider/3/edit and so on (dynamic).
                $edit = "<a href='" . route('admin.slider.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></i></i></a>";
                $delete = "<a href='" . route('admin.slider.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='fas fa-trash-alt'></i></a>";

                return $edit . $delete;
            })
            ->addColumn('image', function ($query) { //render images in datatable
                return '<img width="100px" src="' . asset($query->image) . '">';
            })->addColumn('status', function ($query) {
                if ($query->status === 1) { //in here write true if using postgres, write 1 if using mysql.
                    return '<span class="badge badge-primary">ACTIVE</span>';
                } else {
                    return '<span class="badge badge-danger">INACTIVE</span>';
                }
            })
            ->rawColumns(['image', 'action', 'status']) //call the columns
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0, 'asc')
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
    //getColumns call the columns to show to frontend
    //also call the columns that we created above in the dataTable function.
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('image')->width(100),
            Column::make('title'),
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
        return 'Slider_' . date('YmdHis');
    }
}
