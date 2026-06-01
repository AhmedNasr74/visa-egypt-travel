<?php

namespace App\DataTables;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookingDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('tour_operator', function (Booking $booking) {
                $color = is_null($booking->tour_operator_id) ? 'danger' : 'success';
                $name = $booking->tour_operator?->name ?? 'Not Assigned';
                return "<span class='text-$color'>$name</span>";
            })
            ->filterColumn('tour_operator', function ($q, $k) {
                return strtolower(request('search.value')) == 'not assigned' ?
                    $q->whereNull('tour_operator_id') :
                    $q->whereHas('tour_operator', fn($q) => $q->where('name', 'LIKE', "%$k%"));
            })
            ->filterColumn('payment_status', function ($query, $keyword) {
                $query->where('payment_status', $keyword);
            })
            ->filterColumn('tour', function ($query, $keyword) {
                $query->where('tour_id', $keyword);
            })
            ->filterColumn('date', function ($query, $keyword) {
                $dates = explode(',', $keyword);
                if (count($dates) === 2) {
                    $fromDate = $dates[0];
                    $toDate = $dates[1];
                    $query->whereBetween('date', [$fromDate, $toDate]);
                }
            })
            ->editColumn('created_at', fn(Booking $booking) => optional($booking->created_at)->format('M Y, d'))
            ->editColumn('date', fn(Booking $booking) => optional($booking->date)->format('M Y, d'))
            ->addColumn('tour', fn(Booking $booking) => $booking->tour?->title)
            ->addColumn('payment_status', fn(Booking $booking) => $booking->payment_status)
            ->addColumn('action', 'dashboard.bookings.action')
            ->setRowId('id')
            ->rawColumns(['action', 'tour_operator']);
    }

    public function query(Booking $model): QueryBuilder
    {
        return $model->newQuery()->with(['tour', 'tour_operator']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('data-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
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
            Column::make('tour'),
            Column::make('tour_operator'),
            Column::make('total_price'),
            Column::make('name'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('date'),
            Column::make('payment_status'),
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
        return 'Booking_' . date('YmdHis');
    }
}
