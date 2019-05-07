@extends('layouts.master')

@section('title', 'Historial de Cobranzas')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 py-2 table-responsive">
            <table class="table text-center">
                <tr>
                    <th>N° Comprobante</th>
                    <th>Estudiante</th>
                    <th>Metodo de Pago</th>
                    <th>País</th>
                    <th>Moneda</th>
                    <th>Total</th>
                    <th>Deuda</th>
                    <th>Fecha</th>
                </tr>
                <tr>
                    <td>                        
                        <a href="{{ route('sales.show', $sale->code) }}" class="text-danger">{{ $sale->code }}</a>                        
                    </td>
                    <td>
                        {{ $sale->student->lastname }}, {{ $sale->student->name }}
                    </td>
                    <td>
                        {{ $sale->payment->name }} <i class="{{ $sale->payment->icon }}"></i>
                    </td>                    
                    <td>{{ $sale->student->country->description }} <span class="{{ $sale->student->country->flag }}"></span></td> 
                    <td>{{ $sale->currency->icon }} {{ $sale->currency->name }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>{!! $sale->debt==0?'<span class="text-danger">Cancelada</span>':$sale->debt !!}</td>
                    <td>{{ $sale->date }}</td>                    
                </tr>
            </table>
        </div>

        @if ($sale->debt != 0)
            <div class="col-md-12 py-2">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#paymentModal" data-backdrop="static">
                    Añadir Pagos
                </button>
            </div>
        @endif

        <div class="col-md-12 py-2 table-responsive">
            <h4>Historial de pagos</h4>
            <hr>
            <table class="table text-center" id="table-payments">
                <thead>
                    <tr>
                        <th>N° Venta</th>
                        <th>Descripción</th>
                        <th>Deuda Anterior</th>
                        <th>Pago</th>
                        <th>Saldo</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sale->payments as $index => $payment)
                    <tr>
                        <td>{{ $payment->sale->code }}</td>
                        <td>{{ $payment->description }}</td>
                        <td>{{ $payment->previous_amount }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->next_amount }}</td>
                        <td>{{ $payment->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('payments.form.modal')

@endsection

@section('scripts')    

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

    <script>
        $(function(){
            var table = $('#table-payments').DataTable({                
                'language' : {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: 'Copiar Datos',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Columnas Visibles'
                    }
                ]
            });

            table
                .column( '0:visible' )
                .order( 'desc' )
                .draw();
        });
    </script>

@endsection
