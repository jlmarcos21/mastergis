@extends('layouts.master')

@section('title', '| Nuevo Estudiante')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registro de Estudiante</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'students.store', 'files' => true]) !!}
                        
                @include('students.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection