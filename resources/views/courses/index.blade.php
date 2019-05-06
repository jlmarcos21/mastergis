@extends('layouts.master')

@section('title','| Cursos')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
@endsection

@section('content')
    
    <!-- Breadcrumbs-->
    <a href="{{ route('courses.create') }}" class="btn btn-danger" >Nuevo Curso <i class="fas fa-book"></i></a>

    <div class="table-responsive py-3">
        <table class="table table-bordered table-hover text-center" id="table-courses">
            <thead>
                <tr>
                    <th width="10px">#</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Nivel</th>                    
                    <th>Imagen</th>
                    <th width="10px"><i class="far fa-edit"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->code }}</td>
                        <td><i class='fas fa-circle' style='color:{{ $course->level->colour }}'></i> {{ $course->level->description }}</td>                        
                        <td>
                            <img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="img-fluid" width="50px">
                        </td>                             
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-danger dropdown-toggle" type="button" id="ddm-{{ $course->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                            
                                </button>
                                <div class="dropdown-menu" aria-labelledby="ddm-{{ $course->id }}">
                                    <a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}"><i class="far fa-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="{{ route('courses.show', $course->id) }}"><i class="fas fa-info"></i> Detalles</a>

                                    {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'DELETE']) !!}
                                        <button class="dropdown-item">
                                            <i class="far fa-trash-alt"></i> Eliminar
                                        </button>                           
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
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
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text:'Exportar Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text:'Exportar PDF',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },                    
                    {
                        extend: 'colvis',
                        text:'Columnas Visibles'
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