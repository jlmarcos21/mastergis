@extends('layouts.master')

@section('title', '| Consulta de Ventas')

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
                    <h3>Filtrado de Ventas Por Fechas</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'search_sales', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-2">
                                {{ Form::label('date_s', 'Fecha de Inicio') }}
                                {{ Form::date('date_s', (isset($request->date_s))?$request->date_s:'', ['class' => 'form-control border border-success', 'id' => 'date_s', 'required']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::label('date_f', 'Fecha Final') }}
                                {{ Form::date('date_f', (isset($request->date_f))?$request->date_f:'', ['class' => 'form-control border border-success', 'id' => 'date_f', 'required']) }}
                            </div>
                            <div class="col-md-3">
                                    {{ Form::label('searchpayment', 'Pago') }}
                                    <select name="searchpayment" id="searchpayment" class="form-control">
                                        <option value="">Todos</option>
                                        @foreach ($payments as $payment)     
    
                                        <option value="{{ $payment->id }}"
                                            @isset($request->searchpayment)
                                                @if ($payment->id==$request->searchpayment)
                                                    selected
                                                @endif
                                            @endisset
                                            >{{ $payment->name }}
                                        </option>
    
                                        @endforeach
                                    </select>
                                </div>
                            <div class="col-md-2">
                                {{ Form::label('searchvoucher', 'Comprobante') }}
                                <select name="searchvoucher" id="searchvoucher" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach ($vouchers as $voucher)                                         

                                    <option value="{{ $voucher->id }}"
                                        @isset($request->searchvoucher)
                                            @if ($voucher->id==$request->searchvoucher)
                                                selected
                                            @endif
                                        @endisset
                                        >{{ $voucher->name }}
                                    </option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                    {{ Form::label('searchcurrency', 'Moneda') }}
                                    <select name="searchcurrency" id="searchcurrency" class="form-control">
                                        <option value="">Todos</option>
                                        @foreach ($currencies as $currency)                                             

                                        <option value="{{ $currency->id }}"
                                            @isset($request->searchcurrency)
                                                @if ($currency->id==$request->searchcurrency)
                                                    selected
                                                @endif
                                            @endisset
                                            >{{ $currency->name }}
                                        </option>

                                        @endforeach
                                    </select>
                                </div>
                            <div class="col-md-1">
                                {{ Form::label('date_f', 'Filtrar') }}                                
                                <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>                
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive py-3">                                    
                                {!! $dataTable->table() !!}                                       
                            </div>
                        </div>
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