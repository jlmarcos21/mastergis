@extends('layouts.master')

@section('title', '| Lista de Asignacion por Curso')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/buttons.datatables.min.css') }}">
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Curso - {{ $course->name }}</h3>                
            </div>
            <div class="card-body">
                <div class="table-responsive py-3">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>        
    </div>
</div>

@endsection

@section('scripts')    
    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endsection