<?php

namespace App\DataTables;

use App\Models\Appointment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class AppointmentDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('arrival_date', fn(Appointment $appointment) => optional($appointment->arrival_date)->format('M Y, d'))
            ->editColumn('created_at', fn(Appointment $appointment) => optional($appointment->created_at)->format('M Y, d'))
            ->editColumn('name', fn(Appointment $appointment) => $appointment->full_name)
            ->editColumn('phone', fn(Appointment $appointment) => $appointment->phone_with_code)
            ->addColumn('action', 'dashboard.appointments.action')
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    public function query(Appointment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('data-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons(array_reverse([
                Button::make('excel')->className('btn btn-sm float-right ms-1 p-1 text-light btn-success'),
                Button::make('csv')->className('btn btn-sm float-right ms-1 p-1 text-light btn-primary'),
                Button::make('print')->className('btn btn-sm float-right ms-1 p-1 text-light btn-secondary'),
                Button::make('reload')->className('btn btn-sm float-right ms-1 p-1 text-light btn-info')
            ]));
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
//            Column::make('nickname'),
            Column::make('name'),
            Column::make('email'),
//            Column::make('country_phone_code'),
            Column::make('phone'),
//            Column::make('meeting_language'),
//            Column::make('meeting_date'),
//            Column::make('meeting_hour'),
//            Column::make('adults'),
//            Column::make('children'),
            Column::make('arrival_date'),
//            Column::make('departure_date'),
//            Column::make('days'),
            Column::make('expected_budget'),
//            Column::make('notes'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Appointment_' . date('YmdHis');
    }
}
