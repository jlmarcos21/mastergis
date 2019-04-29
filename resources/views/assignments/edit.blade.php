@extends('layouts.master')

@section('title', '| Actualizar Asignación')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Actualizar de Curso</h3>
        </div>
        <div class="card-body">
            {!! Form::model($assignment, ['route' => ['assignments.update', $assignment->id], 'method' => 'PUT', 'files' => true]) !!}
                        
                @include('assignments.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection