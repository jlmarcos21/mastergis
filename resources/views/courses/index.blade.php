@extends('layouts.master')

@section('title','| Cursos')

@section('content')
    
    <!-- Breadcrumbs-->
    <a href="{{ route('courses.create') }}" class="btn btn-danger" >Nuevo Curso <i class="fas fa-book"></i></a>

    <div class="table-responsive py-3">
        <table class="table table-bordered table-hover text-center" width="100%">
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
        {{ $courses->render() }}
    </div>

@endsection