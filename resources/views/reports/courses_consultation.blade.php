@extends('layouts.master')

@section('title', '| Consulta de Cursos')

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
                    <h3>Filtrado Cursos Vendidos Por Fechas</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'search_courses', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                {{ Form::label('date_s', 'Fecha de Inicio') }}
                                {{ Form::date('date_s', isset($request->date_s), ['class' => 'form-control border border-success', 'id' => 'date_s', 'required']) }}
                            </div>
                            <div class="col-md-5">
                                {{ Form::label('date_f', 'Fecha Final') }}
                                {{ Form::date('date_f', isset($request->date_f), ['class' => 'form-control border border-success', 'id' => 'date_f', 'required']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::label('date_f', 'Filtrar') }}                                
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @isset($s_courses)
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive py-3">
                                <table class="table table-bordered table-hover text-center" id="table-courses">
                                    <thead>
                                        <tr>                                            
                                            <th>Codigo</th>
                                            <th>Curso</th>                                            
                                            <th>Fecha</th>  
                                        </tr>                  
                                    </thead>
                                    <tbody>
                                        @foreach ($s_courses as $s_course)
                                            <tr>
                                                <td>{{ $s_course->course->code }}</td>
                                                <td>{{ $s_course->course->name }}</td>
                                                <td>{{ $s_course->date }}</td>                   
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
            var table = $('#table-courses').DataTable({                
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
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
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