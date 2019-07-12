@extends('layouts.master')

@section('title', '| Consulta de Cursos')

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
                    <h3>Consulta de Cursos Interesados</h3>                    
                </div>
                <div class="p-2 bd-highlight">
                    <button type="button" data-toggle="modal" data-target="#consultation-modal" data-backdrop="static" class="btn btn-md btn-success">
                        Consultar <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="p-2 bd-highlight">
                    <button type="button" data-toggle="modal" data-target="#interest-modal" data-backdrop="static" class="btn btn-md btn-primary">
                        Nuevo Interesdo
                    </button>                    
                </div>
            </div>
        </div>
        <div class="col-md-12 table-responsive py-3">
            {!! $dataTable->table() !!}
        </div>
    </div>

    <div class="modal fade" id="interest-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Interesado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                {!! Form::open(['route' => 'students.store', 'files' => true]) !!}                    
                    @include('consultations.form.form')
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
    {{-- componete para consultar informacion --}}
    <consultation-component></consultation-component>
    
@endsection

@section('scripts')    
    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/datatables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $("#country_id").change(event => {
            $.get(`{{ env('APP_URL') }}countries/${event.target.value}`, function(res, sta){
                $("#province_id").empty();
                res.forEach(element => {
                    $('.selectpicker').selectpicker('refresh');
                    $("#province_id").append(`<option value="${element.id}" data-icon="far fa-building">${element.description}</option>`);                
                });
                $('.selectpicker').selectpicker('refresh');
                $("#province_id").focus();        
            });
        });
    </script>
    
@endsection