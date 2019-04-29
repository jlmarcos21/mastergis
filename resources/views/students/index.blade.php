@extends('layouts.master')

@section('title','| Estudiantes')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    
    <!-- Breadcrumbs-->
    <a href="{{ route('students.create') }}" class="btn btn-primary" >Nuevo Estudiante <i class="fas fa-user-graduate"></i></a>

    <div class="table-responsive py-3">
        <table class="table table-bordered table-hover text-center" id="table-students">
            <thead>
                <tr>
                    <th width="10px">#</th>
                    <th>Apellidos y Nombres</th>
                    <th>Codigo</th>
                    <th width="10px">País</th>
                    <th>Correo</th>
                    <th width="10px"><i class="far fa-edit"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $index => $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->lastname }}, {{ $student->name }}</td>
                        <td>{{ $student->code }}</td>                                
                        <td><span class="{{ $student->country->flag }}" title="{{ $student->country->description }}"></span></td>
                        <td>
                            <a href="mailto:{{ $student->email }}" title="Enviar Correo">{{ $student->email }}</a>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="ddm-{{ $student->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                            
                                </button>
                                <div class="dropdown-menu" aria-labelledby="ddm-{{ $student->id }}">
                                    <a class="dropdown-item" href="{{ route('students.edit', $student->id) }}"><i class="far fa-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="{{ route('students.show', $student->id) }}"><i class="far fa-user-circle"></i> Perfil</a>

                                    {!! Form::open(['route' => ['students.destroy', $student->id], 'method' => 'DELETE']) !!}
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

    <script>
        $(function(){
            var table = $('#table-students').DataTable({                
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
                }
            });

            table
                .column( '0:visible' )
                .order( 'desc' )
                .draw();
        });
    </script>

@endsection