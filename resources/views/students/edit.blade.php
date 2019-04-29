@extends('layouts.master')

@section('title', '| Actualizar Estudiante')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Actualizar de Estudiante</h3>
        </div>
        <div class="card-body">
            {!! Form::model($student, ['route' => ['students.update', $student->id], 'method' => 'PUT', 'files' => true]) !!}
                        
                @include('students.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection