@extends('layouts.master')

@section('title', '| Actualizar Curso')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Actualizar de Curso</h3>
        </div>
        <div class="card-body">
            {!! Form::model($course, ['route' => ['courses.update', $course->id], 'method' => 'PUT', 'files' => true]) !!}
                        
                @include('courses.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection