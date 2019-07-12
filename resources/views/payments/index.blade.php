@extends('layouts.master')

@section('title', '| Ventas por Cobrar')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/buttons.datatables.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">                        

            <div class="d-flex bd-highlight">
                <div class="mr-auto p-2 bd-highlight">
                    <h2>Ventas Por Cobrar</h2>
                </div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('sales.create') }}" class="btn btn-dark" >Nueva Venta <i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="table-responsive py-3">
                {!! $dataTable->table() !!}            
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