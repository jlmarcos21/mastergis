@extends('layouts.master')

@section('title','| Cursos')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/buttons.datatables.min.css') }}">
@endsection

@section('content')
    
    <!-- Breadcrumbs-->
    <a href="{{ route('courses.create') }}" class="btn btn-danger" >Nuevo Curso <i class="fas fa-book"></i></a>

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