@extends('layouts.master')

@section('title', '| Consulta de Asignaciones')

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
                    {!! Form::open(['route' => 'search_assignments', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-3 form-group">
                                {{ Form::label('date_s', 'Fecha de Inicio', ['class' => 'font-weight-bold']) }}
                                {{ Form::date('date_s', (isset($request->date_s))?$request->date_s:'', ['class' => 'form-control text-center border-success', 'id' => 'date_s', 'required']) }}
                            </div>
                            <div class="col-md-3 form-group">
                                {{ Form::label('date_f', 'Fecha Final', ['class' => 'font-weight-bold']) }}
                                {{ Form::date('date_f', (isset($request->date_f))?$request->date_f:'', ['class' => 'form-control text-center border-success', 'id' => 'date_f', 'required']) }}
                            </div>
                            <div class="col-md-6 form-group">
                                {{ Form::label('searchcourse', 'Curso') }}
                                <select name="searchcourse" id="searchcourse" class="form-control border-success">
                                    <option value="">Todos</option>
                                    @foreach ($courses as $course)     

                                    <option value="{{ $course->id }}"
                                        @isset($request->searchcourse)
                                            @if ($course->id==$request->searchcourse)
                                                selected
                                            @endif
                                        @endisset
                                        >{{ $course->name }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchaccess', 'Acceso') }}
                                <select name="searchaccess" id="searchaccess" class="form-control border-success">
                                    <option value="" {{ isset($request->searchaccess)?($request->searchaccess==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchaccess)?($request->searchaccess=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->searchaccess)?($request->searchaccess=='0'?'selected':''):'' }}>NO</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchentry', 'Ingreso') }}
                                <select name="searchentry" id="searchentry" class="form-control border-success">
                                    <option value="" {{ isset($request->searchentry)?($request->searchentry==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchentry)?($request->searchentry=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->searchentry)?($request->searchentry=='0'?'selected':''):'' }}>NO</option>                                       
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchbasisc', 'C.Basico') }}
                                <select name="searchbasisc" id="searchbasisc" class="form-control border-success">
                                    <option value="" {{ isset($request->searchbasisc)?($request->searchbasisc==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchbasisc)?($request->searchbasisc=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->searchbasisc)?($request->searchbasisc=='0'?'selected':''):'' }}>NO</option>                                       
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchintermediate', 'C.Intermedio') }}
                                <select name="searchintermediate" id="searchintermediate" class="form-control border-success">
                                    <option value="" {{ isset($request->searchintermediate)?($request->searchintermediate==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchintermediate)?($request->searchintermediate=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->searchintermediate)?($request->searchintermediate=='0'?'selected':''):'' }}>NO</option>                                       
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchadvanced', 'C.Avanzado') }}
                                <select name="searchadvanced" id="searchadvanced" class="form-control border-success">
                                    <option value="" {{ isset($request->searchadvanced)?($request->searchadvanced==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchadvanced)?($request->searchadvanced=='1'?'selected':''):'' }}>SI</option>  
                                    <option value="0" {{ isset($request->searchadvanced)?($request->searchadvanced=='0'?'selected':''):'' }}>NO</option>                                       
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                {{ Form::label('searchfinished', 'Estado') }}
                                <select name="searchfinished" id="searchfinished" class="form-control border-success">
                                    <option value="" {{ isset($request->searchfinished)?($request->searchfinished==''?'selected':''):'' }}>Todos</option>
                                    <option value="1" {{ isset($request->searchfinished)?($request->searchfinished=='1'?'selected':''):'' }}>Terminado</option>  
                                    <option value="0" {{ isset($request->searchfinished)?($request->searchfinished=='0'?'selected':''):'' }}>No Terminado</option>                                       
                                </select>
                            </div>
                            <div class="col-md-12 form-group">                                                          
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                @isset($s_assignments)
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive py-3">
                                <table class="table table-bordered" id="table-assignments">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Estudiante</th>
                                            <th>Curso</th>
                                            <th>Nivel</th>
                                            <th>Descripción de Venta</th>
                                            <th>Descripción</th>
                                            <th>Fecha</th>
                                            <th>Acceso</th>
                                            <th>Ingreso</th>
                                            <th>C.Básico</th>
                                            <th>C.Intermedio</th>
                                            <th>C.Avanzado</th>
                                            <th>Certificado</th>
                                            <th>Estado</th>
                                            <th>Encuesta</th>
                                            <th>Certificado.F</th>
                                            <th>Inicio</th>
                                            <th>Final</th>
                                            <th>Días</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($s_assignments as $assignment)
                                        <tr>
                                            <td><a href="{{ route('assignments.show', $assignment->code) }}" target="_blank">{{ $assignment->code }}</a></td>
                                            <td>{{ $assignment->student->name." ".$assignment->student->lastname}}</td>
                                            <td>{{ $assignment->course->name }}</td>
                                            <td>{{ $assignment->course->level->description }}</td>
                                            <td>{{ $assignment->description_sale }}</td>
                                            <td>{{ $assignment->description }}</td>
                                            <td>{{ $assignment->date }}</td>
                                            <td><strong>{{ $assignment->access==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->entry==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->basic_constancy==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->intermediate_constancy==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->advanced_constancy==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->certificate==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->finished==1?'Curso Terminado':'No Terminado' }}</strong></td>
                                            <td><strong>{{ $assignment->poll==1?'SI':'NO' }}</strong></td>
                                            <td><strong>{{ $assignment->physical_certificate==1?'SI':'NO' }}</strong></td>
                                            <td>{{ $assignment->start_date }}</td>
                                            <td>{{ $assignment->final_date }}</td>
                                            <td>{{ $assignment->remaining_days<0?'Curso Vencido':$assignment->remaining_days }}</td>
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
            var table = $('#table-assignments').DataTable({                
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