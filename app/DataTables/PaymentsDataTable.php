<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
{

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
                })->editColumn('pay', function($sale) {
                    return '<a href="'.route('payments.show', $sale->code).'" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i></a>';
                })->rawColumns(['code', 'payment', 'pay']);
    }

    public function query()
    {
        $sales = Sale::where('credit', '=' ,'1')
                ->with(['student', 'payment', 'voucher', 'currency'])
                ->get();

        return $sales;
    }

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
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json']      
                    ]);
    }

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
            ['data' => 'debt', 'title' => 'Deuda'],
            ['data' => 'pay', 'title' => 'Deuda'],
        ]);
    }

    protected function filename()
    {
        return 'Payments_' . date('YmdHis');
    }
}
