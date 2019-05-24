<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Services\DataTable;

class SearchSaleDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('serie', function($sale) {
                return '<a href="'.route('sales.show', $sale->id).'">'.$sale->code.'</a>';
            })->editColumn('student', function($sale) {
                return $sale->student->name." ".$sale->student->lastname;
            })->editColumn('payment', function($sale) {
                return $sale->payment->name. ' <i class="'.$sale->payment->icon.'"></i>';
            })->editColumn('voucher', function($sale) {
                return $sale->voucher->name;
            })->editColumn('currency', function($sale) {
                return $sale->currency->icon .' '. $sale->currency->name;
            })->editColumn('credit', function($sale) {
                return $sale->credit==1?'SI':'NO';
            })->rawColumns(['serie', 'payment']);
    }

    public function query()
    {
        $sales = $this->sales;

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
            ['data' => 'serie', 'title' => 'N° Serie'],
            ['data' => 'student', 'title' => 'Estudiante'],
            ['data' => 'description', 'title' => 'Descripción'],
            ['data' => 'payment', 'title' => 'Descripción'],
            ['data' => 'voucher', 'title' => 'Comprobante'],
            ['data' => 'currency', 'title' => 'Moneda'],
            ['data' => 'credit', 'title' => 'Credito'],
            ['data' => 'debt', 'title' => 'Deuda'],
            ['data' => 'date', 'title' => 'Fecha'],
            ['data' => 'subtotal', 'title' => 'Subtotal'],
            ['data' => 'total', 'title' => 'Total'],
            ['data' => 'discount_paypal', 'title' => 'Desc.Paypal'],
            ['data' => 'total_paypal', 'title' => 'Desc.Total'],
            ['data' => 'discount_interbank', 'title' => 'Desc.Interbank'],
            ['data' => 'total_interbank', 'title' => 'Desc.Total2'],
        ]);
    }

    protected function filename()
    {
        return 'filtro_ventas_' . date('YmdHis');
    }
}
