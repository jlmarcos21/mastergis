<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
                ->editColumn('code', function($sale) {
                    return '<a href="'.route('sales.show', $sale->id).'">'.$sale->code.'</a>';
                })->editColumn('student', function($sale) {
                    return $sale->student->lastname ." ". $sale->student->name;
                })->editColumn('payment', function($sale) {
                    return $sale->payment->name. ' <i class="'.$sale->payment->icon.'"></i>';
                })->editColumn('voucher', function($sale) {
                    return $sale->voucher->name;
                })->editColumn('currency', function($sale) {
                    return $sale->currency->icon .' '. $sale->currency->name;
                })->rawColumns(['code', 'payment']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $sales = Sale::with(['student', 'payment', 'voucher', 'currency'])
                ->get();

        return $sales;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[0, 'desc']],
                        'dom' => 'Bfrtip',
                        'buttons' => [                    
                            ['extend' => 'export'],                   
                            ['extend' => 'print'],
                            ['extend' => 'reset'],
                            ['extend' => 'reload'],            
                        ],            
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return ([
            ['data' => 'id', 'title' => '#'],
            ['data' => 'code', 'title' => 'Código'],
            ['data' => 'student', 'title' => 'Estudiante'],
            ['data' => 'payment', 'title' => 'Pago'],
            ['data' => 'voucher', 'title' => 'Comprobante'],
            ['data' => 'date', 'title' => 'Fecha'],
            ['data' => 'currency', 'title' => 'Moneda'],
            ['data' => 'total', 'title' => 'Total'],
        ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sales_' . date('YmdHis');
    }
}
