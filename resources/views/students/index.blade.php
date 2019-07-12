@extends('layouts.master')

@section('title','| Estudiantes')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/buttons.datatables.min.css') }}">
@endsection

@section('content')
    
    <!-- Breadcrumbs-->
    <a href="{{ route('students.create') }}" class="btn btn-primary" >Nuevo Estudiante <i class="fas fa-user-graduate"></i></a>

    <div class="table-responsive py-3">
        {!! $dataTable->table() !!}
    </div>

@endsection

@section('scripts')    

    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    
@endsection