@extends('layouts.master')

@section('title', '| Detalle del Curso')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-3">{{ $course->name }}</h1>        
    </div>
    <div class="row">
        <div class="col-md-4 py-2">
            <div class="card text-center">
                <div class="card-header">
                    <h3>Total de Estudiantes</h3>
                </div>
                <div class="card-body">
                    <h1 class="fas fa-user-graduate"> {{ $course->assignments->count() }}</h1>        
                </div>
            </div>
        </div>
    </div>
@endsection