@extends('layouts.master')

@section('title', '| Ventas por Cobrar')

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
                <table class="table table-bordered table-hover text-center" width="100%">
                    <thead>
                        <tr>
                            <th width="10px">#</th>
                            <th>Codigo</th>
                            <th>Alumno</th>
                            <th>Pago</th>
                            <th>Fecha</th>                    
                            <th>Moneda</th>
                            <th>Total</th>
                            <th>Deuda</th>
                            <th width="10px">Cobrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td><a href="{{ route('sales.show', $sale->id) }}">{{ $sale->code }}</a></td>
                                <td>{{ $sale->student->lastname }}, {{ $sale->student->name }}</td>
                                <td>{{ $sale->payment->name }} <i class="{{ $sale->payment->icon }}"></i></td>
                                <td>{{ $sale->date }}</td>                        
                                <td>{{ $sale->currency->icon }} {{ $sale->currency->name }}</td>
                                <td class="text-success">{{ $sale->total }}</td>
                                <td>{!! $sale->debt==0?'<span class="text-success">Cancelado</span>': '<span class="text-danger">'.$sale->debt.'</span>'!!}</td>                                
                                <td>
                                    <a href="{{ route('payments.show', $sale->code) }}" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i></a>                                                                        
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sales->render() }}
            </div>
        </div>
    </div>

    

@endsection