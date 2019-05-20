@extends('layouts.master')

@section('title', '| Detalle de Asignacion')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha de Inicio <i class="far fa-calendar-check"></i></th>                            
                            <th>Fecha de Final <i class="far fa-calendar-times"></i></th>
                            <th>Dias Restantes</th>
                            <th>Generar Certificado</th>                                                
                            <th>Actualizar</th>            
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>
                            <td><span class="text-success">{{ $assignment->start_date }}</span></td>
                            <td><span class="text-danger">{{ $assignment->final_date }}</span></td>
                            <td><span>{{ $assignment->remaining_days }}</span></td>
                            <td>
                                @if ($assignment->access==1 && $assignment->entry==1)
                                    <a href="{{ route('generate-certificate', $assignment->code) }}" target="_blank" class="btn btn-sm btn-dark" title="Generar Certificado">Generar Certificado</a>
                                    {{-- @include('assignments.certificates.certi') --}}
                                @else
                                    <div class="spinner-border text-danger" role="status">
                                        <span class="sr-only">Proceso...</span>
                                      </div>
                                @endif                                
                            </td>                            
                            <td>
                                <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-sm btn-success" title="Actualizar Seguimiento"><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>      
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Codigo</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Nivel</th>
                            <th width="10px">Acceso</th>
                            <th width="10px">Ingreso</th>
                            <th width="10px">Encuesta</th>             
                            <th width="10px">Certificado.F</th>
                            <th>Estado</th>                            
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>
                            <td>{{ $assignment->code }}</td>
                            <td>{{ $assignment->student->name }}, {{ $assignment->student->lastname }}</td>
                            <td>{{ $assignment->course->name }}</td>
                            <td><i class="fas fa-circle" style="color:{{ $assignment->course->level->colour }}"> {{ $assignment->course->level->description }}</i></td>
                            <td>
                                {!! $assignment->access=='0'?'<i class="far fa-times-circle text-danger"></i>':'<i class="far fa-check-circle text-success"></i>' !!}
                            </td>
                            <td>
                                {!! $assignment->entry=='0'?'<i class="far fa-times-circle text-danger"></i>':'<i class="far fa-check-circle text-success"></i>' !!}
                            </td>
                            <td>
                                    {!! $assignment->poll=='0'?'<i class="far fa-times-circle text-danger"></i>':'<i class="far fa-check-circle text-success"></i>' !!}
                                </td> 
                            <td>
                                {!! $assignment->physical_certificate=='0'?'<i class="far fa-times-circle text-danger"></i>':'<i class="far fa-check-circle text-success"></i>' !!}
                            </td>
                            <td>
                                {!! $assignment->finished=='0'?'<span class="text-danger">Curso no Terminado</span>':'<span class="text-success">Curso Terminado</span>' !!}
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
                <div class="p-2 bd-highlight">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#projectModal" data-backdrop="static">
                        Añadir Proyectos
                    </button>
                </div>
            </div>                                                
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>Nivel</th>
                        <th>Descrición</th>                        
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