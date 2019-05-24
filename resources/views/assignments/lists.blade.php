@extends('layouts.master')

@section('title', '| Lista de Asignacion por Curso')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection