@extends('layouts.master')

@section('title', '| Consulta de Ventas')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Filtrado de Ventas Por Fechas</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'search_sales', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                {{ Form::label('date_s', 'Fecha de Inicio', ['class' => 'font-weight-bold']) }}
                                {{ Form::date('date_s', (isset($request->date_s))?$request->date_s:'', ['class' => 'form-control border-success text-center', 'id' => 'date_s', 'required']) }}
                            </div>
                            <div class="col-md-4 form-group">
                                {{ Form::label('date_f', 'Fecha Final', ['class' => 'font-weight-bold']) }}
                                {{ Form::date('date_f', (isset($request->date_f))?$request->date_f:'', ['class' => 'form-control border-success text-center', 'id' => 'date_f', 'required']) }}
                            </div>
                            
                            <div class="col-md-4 form-group">
                                {{ Form::label('searchpayment', 'Pago') }}
                                <select name="searchpayment" id="searchpayment" class="form-control border-success">
                                    <option value="">Todos</option>
                                    @foreach ($payments as $payment)     

                                    <option value="{{ $payment->id }}"
                                        @isset($request->searchpayment)
                                            @if ($payment->id==$request->searchpayment)
                                                selected
                                            @endif
                                        @endisset
                                        >{{ $payment->name }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                {{ Form::label('searchvoucher', 'Comprobante') }}
                                <select name="searchvoucher" id="searchvoucher" class="form-control border-success">
                                    <option value="">Todos</option>
                                    @foreach ($vouchers as $voucher)                                         

                                    <option value="{{ $voucher->id }}"
                                        @isset($request->searchvoucher)
                                            @if ($voucher->id==$request->searchvoucher)
                                                selected
                                            @endif
                                        @endisset
                                        >{{ $voucher->name }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                {{ Form::label('searchcurrency', 'Moneda') }}
                                <select name="searchcurrency" id="searchcurrency" class="form-control border-success">
                                    <option value="">Todos</option>
                                    @foreach ($currencies as $currency)                                             

                                    <option value="{{ $currency->id }}"
                                        @isset($request->searchcurrency)
                                            @if ($currency->id==$request->searchcurrency)
                                                selected
                                            @endif
                                        @endisset
                                        >{{ $currency->name }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                {{ Form::label('credit', 'Credito') }}
                                <select name="credit" id="credit" class="form-control border-success">
                                    <option value="" {{ isset($request->credit)?($request->credit==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->credit)?($request->credit=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->credit)?($request->credit=='0'?'selected':''):'' }}>No</option>                                       
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                {{ Form::label('canceled', 'Anulado') }}
                                <select name="canceled" id="canceled" class="form-control border-success">
                                    <option value="" {{ isset($request->canceled)?($request->canceled==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->canceled)?($request->canceled=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->canceled)?($request->canceled=='0'?'selected':''):'' }}>No</option>                                       
                                </select>
                            </div>
                            <div class="col-md-12 form-group">                                                          
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @isset($sales)
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive py-3">
                                <table class="table table-bordered table-hover text-center" id="table-sales">
                                    <thead>
                                        <tr>
                                            <th width="10px">#</th>
                                            <th>Serie</th>
                                            <th>Estudiante</th>
                                            <th>Observación</th>
                                            <th>Anulado</th>
                                            <th>Comprobante</th>
                                            <th>Pago</th>
                                            <th>Agencia</th>                                            
                                            <th>Moneda</th>
                                            <th>Credito</th>
                                            <th>Deuda</th>
                                            <th>Fecha</th>                                                                
                                            <th>SubTotal</th>
                                            <th>Total</th>
                                            <th>Desc.Paypal</th>
                                            <th>Paypal.Total</th>
                                            <th>Desc.Interbank</th>
                                            <th>Interbank.Total</th>                                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sale->id }}</td>
                                                <td><a href="{{ route('sales.show', $sale->id) }}">{{ $sale->code }}</a></td>
                                                <td>{{ $sale->student->name }} {{ $sale->student->lastname }}</td>
                                                <td>{{ $sale->description }}</td>
                                                <td>{{ $sale->canceled==1?'SI':'NO' }}</td>
                                                <td>{{ $sale->voucher->name }}</td>                                                             
                                                <td>{{ $sale->payment->name }} <i class="{{ $sale->payment->icon }}"></i></td>
                                                <td>{{ $sale->agency->name }} <i class="{{ $sale->agency->icon }}"></i></td>                                                
                                                <td>{{ $sale->currency->icon }} {{ $sale->currency->name }}</td>
                                                <td>{{ $sale->credit==1?'Si':'No' }}</td>
                                                <td>{{ $sale->debt }}</td>
                                                <td>{{ $sale->date }}</td>    
                                                <td>{{ $sale->subtotal }}</td>
                                                <td>{{ $sale->total }}</td>
                                                <td>{{ $sale->discount_paypal }}</td>
                                                <td>{{ $sale->total_paypal }}</td>
                                                <td>{{ $sale->discount_interbank }}</td>
                                                <td>{{ $sale->total_interbank }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                
                            </div>
                        </div>
                    </div>
                </div>
                @endisset
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
            var table = $('#table-sales').DataTable({                
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
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
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