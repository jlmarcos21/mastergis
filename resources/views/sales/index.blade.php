@extends('layouts.master')

@section('title', '| Lista de Ventas')

@section('content')    

    <div class="row">
        <div class="col-md-12">                        
            <div class="d-flex bd-highlight">
                <div class="mr-auto p-2 bd-highlight">
                    <h2>Lista de Ventas</h2>
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
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th width="10px"><i class="far fa-edit"></i></th>
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
                                <td class="text-success">{{ $sale->subtotal }}</td>
                                <td class="text-success">{{ $sale->total }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="ddm-{{ $sale->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                            
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="ddm-{{ $sale->id }}">
                                            <a class="dropdown-item" href="{{ route('sales.show', $sale->id) }}"><i class="far fa-edit"></i> Detalle</a>                                    
                                        </div>
                                    </div>
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