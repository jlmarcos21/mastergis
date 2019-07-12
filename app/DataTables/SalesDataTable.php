<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{
  
    public function dataTable($query)
    {
        return datatables($query)
                ->editColumn('code', function($sale) {
                    return '<a href="'.route('sales.show', $sale->id).'">'.$sale->code.'</a>';
                })->editColumn('student', function($sale) {
                    return '<a href="'.route('students.show', $sale->student->id).'" class="text-success">'.$sale->student->name ." ". $sale->student->lastname.'</a>';
                })->editColumn('voucher', function($sale) {
                    return $sale->voucher->name;
                })->editColumn('payment', function($sale) {
                    return $sale->payment->name. ' <i class="'.$sale->payment->icon.'"></i>';
                })->editColumn('currency', function($sale) {
                    return $sale->currency->icon .' '. $sale->currency->name;
                })->addColumn('canceled', 'sales.buttons.delete')
                ->setRowClass('{{ $canceled == 1 ? "alert-danger" : "" }}')
                ->rawColumns(['code', 'student', 'payment', 'canceled']);
    }

    public function query()
    {
        $sales = Sale::with(['student', 'payment', 'voucher', 'currency'])
                ->get();

        return $sales;
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters([
                        'order'   => [[5, 'desc']],
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
            ['data' => 'voucher', 'title' => 'Comprobante'],
            ['data' => 'payment', 'title' => 'Pago'],
            ['data' => 'date', 'title' => 'Fecha'],
            ['data' => 'currency', 'title' => 'Moneda'],
            ['data' => 'total', 'title' => 'Total'],
            ['data' => 'canceled', 'title' => 'Anular'],
        ]);
    }

    protected function filename()
    {
        return 'ventas_' . date('YmdHis');
    }
}
