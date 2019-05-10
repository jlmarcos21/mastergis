@extends('layouts.master')

@section('title', '| Ventas por Cobrar')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">                        

            <div class="d-flex bd-highlight">
                <div class="mr-auto p-2 bd-highlight">
                    <h2>Ventas Por Cobrar</h2>
                </div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('sales.create') }}" class="btn btn-dark" >Nueva Venta <i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="table-responsive py-3">
                <table class="table table-bordered table-hover text-center" id="tables-payments">
                    <thead>
                        <tr>
                            <th width="10px">#</th>
                            <th>Codigo</th>
                            <th>Alumno</th>
                            <th>Pago</th>
                            <th>Comprobante</th>
                            <th>Fecha</th>                    
                            <th>Moneda</th>
                            <th>Total</th>
                            <th>Deuda</th>
                            <th width="10px">Cobrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td><a href="{{ route('sales.show', $sale->id) }}">{{ $sale->code }}</a></td>
                                <td>{{ $sale->student->lastname }}, {{ $sale->student->name }}</td>
                                <td>{{ $sale->payment->name }} <i class="{{ $sale->payment->icon }}"></i></td>
                                <td>{{ $sale->voucher->name }}</td>
                                <td>{{ $sale->date }}</td>                        
                                <td>{{ $sale->currency->icon }} {{ $sale->currency->name }}</td>
                                <td class="text-success">{{ $sale->total }}</td>
                                <td>{!! $sale->debt==0?'<span class="text-success">Cancelado</span>': '<span class="text-danger">'.$sale->debt.'</span>'!!}</td>                                
                                <td>
                                    <a href="{{ route('payments.show', $sale->code) }}" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i></a>                                                                        
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>

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
            var table = $('#tables-payments').DataTable({                
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
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
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