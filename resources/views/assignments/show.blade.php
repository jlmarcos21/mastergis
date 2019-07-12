@extends('layouts.master')

@section('title', '| Detalle de Asignacion')

@section('content')

    <div class="row">
        <div class="col-md-12">            
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Inicio <i class="far fa-calendar-check"></i></th>                            
                            <th>Final <i class="far fa-calendar-times"></i></th>
                            <th>Dias Restantes</th>
                            <th>Comprobante</th>
                            <th>Descripción</th>
                            <th>Generar Certificado</th>                                        
                            <th>Actualizar</th>            
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>
                            <td><span class="text-success">{{ $assignment->start_date }}</span></td>
                            <td><span class="text-danger">{{ $assignment->final_date }}</span></td>
                            <td>{!! $assignment->remaining_days<0?'<span class="text-danger">Curso Vencido</span>':'<span class="text-success">'.$assignment->remaining_days.'</span>' !!}</td>
                            <td><a href="{{ route('sales.show', $assignment->sale->id) }}">{{ $assignment->sale->code }}</a></td>
                            <td>
                                <div class="w-100">
                                    <small>{{ $assignment->description }}</small>
                                </div>
                            </td>
                            <td>
                                @if ($assignment->finished)
                                    <a href="{{ route('generate-certificate', $assignment->code) }}" target="_blank" class="btn btn-sm btn-dark" title="Generar Certificado">Generar Certificado</a>                                    
                                @else
                                    <span class="text-danger">Proceso...</span>
                                @endif                                
                            </td>                            
                            <td>
                                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-sm btn-success" title="Actualizar Seguimiento"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>                
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código</th>
                            <th>Estudiante</th>
                            <th>País</th>
                            <th>Curso</th>
                            <th>Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $assignment->code }}</td>
                            <td><a href="{{ route('students.show', $assignment->student->id) }}">{{ $assignment->student->name." ".$assignment->student->lastname }}</a></td>
                            <td>{{ $assignment->student->country->description }} <span class="{{ $assignment->student->country->flag }}"></span></td>
                            <td>{{ $assignment->course->name }}</td>
                            <td><i class="fas fa-circle" style="color:{{ $assignment->course->level->colour }}"> {{ $assignment->course->level->description }}</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th width="10px">Acceso</th>
                            <th width="10px">Ingreso</th>
                            <th>C.Básico</th>
                            <th>C.Intermedio</th>
                            <th>C.Avanzado</th>
                            <th>Certificado</th>
                            <th>Estado</th>
                            <th width="10px">Encuesta</th>             
                            <th>Certificado.F</th>                                                       
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>                            
                            <td>
                                {!! $assignment->access=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->entry=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->basic_constancy=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->intermediate_constancy=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->advanced_constancy=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->certificate=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->finished=='0'?'<strong class="text-danger">No Terminado</strong>':'<strong class="text-success">Curso Terminado</strong>' !!}
                            </td> 
                            <td>
                                {!! $assignment->poll=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>
                            <td>
                                {!! $assignment->physical_certificate=='0'?'<strong class="text-danger">NO</strong>':'<strong class="text-success">SI</strong>' !!}
                            </td>                                                       
                        </tr>          
                    </tbody>
                </table>                           
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex bd-highlight">
                <div class="mr-auto p-2 bd-highlight">
                    <a href="{{ route('assignments.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
                @if (($assignment->access==1) && ($assignment->entry==1))
                    <div class="p-2 bd-highlight">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#projectModal" data-backdrop="static" {{ $assignment->finished?'DISABLED':'' }}>
                            Añadir Proyectos
                        </button>
                    </div>            
                @endif                
            </div>                                                
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>Nivel</th>
                        <th>Descripción</th>                        
                        <th>Estado</th>
                        <th width="15%">Fecha</th>
                        <th>Constancia</th>
                        <th>Observaciones</th>
                    </thead>
                    <tbody>
                        @foreach ($assignment->projects as $project)
                            <tr>
                                <td><i class="fas fa-circle" style="color:{{ $project->sub_level->colour }}"> {{ $project->sub_level->description }}</i></td>
                                <td>{{ $project->description }}</td>
                                <td>
                                    {!! $project->state=='0'?'<span class="text-danger">Desaprobado</span>':'<span class="text-success">Aprobado</span>' !!}
                                </td>
                                <td>{{ $project->date }}</td>
                                <th width="10px">
                                    @if($project->state==1)
                                        <a href="{{ route('generate-constancy', $project->id) }}" target="_blank" class="btn btn-sm btn-danger">Constancia</a>
                                    @else
                                    <h3 class="far fa-sad-cry text-danger"></h3>
                                    @endif
                                </th>
                                <th width="10px">
                                    <a href="{{ route('generate-annotation', $project->id) }}" target="_blank" class="btn btn-sm btn-danger">Observaciones</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>    
    @include('assignments.form.project')
@endsection