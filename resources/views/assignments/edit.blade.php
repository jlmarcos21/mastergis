@extends('layouts.master')

@section('title', '| Proceso Asignación')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Proceso de Asignación</h3>
        </div>
        <div class="card-body">
            {!! Form::model($assignment, ['route' => ['assignments.update', $assignment->id], 'method' => 'PUT', 'files' => true]) !!}
                        
                @include('assignments.form.form')

            {!! Form::close() !!}
        </div>
    </div>
@endsection