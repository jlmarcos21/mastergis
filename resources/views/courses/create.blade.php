@extends('layouts.master')

@section('title', '| Nuevo Curso')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Registro de Curso</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'courses.store', 'files' => true]) !!}
                        
                @include('courses.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection