@extends('layouts.master')

@section('title', 'Historial de Cobranzas')

@section('content')

    <div class="row">
        <div class="col-md-12 py-2 table-responsive">
            <table class="table text-center">
                <tr>
                    <th>N° Comprobante</th>
                    <th>Estudiante</th>
                    <th>Metodo de Pago</th>
                    <th>País</th>
                    <th>Moneda</th>
                    <th>Total</th>
                    <th>Deuda</th>
                    <th>Fecha</th>
                </tr>
                <tr>
                    <td>                        
                        <a href="{{ route('sales.show', $sale->code) }}" class="text-danger">{{ $sale->code }}</a>                        
                    </td>
                    <td>
                        {{ $sale->student->lastname }}, {{ $sale->student->name }}
                    </td>
                    <td>
                        {{ $sale->payment->name }} <i class="{{ $sale->payment->icon }}"></i>
                    </td>                    
                    <td>{{ $sale->student->country->description }} <span class="{{ $sale->student->country->flag }}"></span></td> 
                    <td>{{ $sale->currency->icon }} {{ $sale->currency->name }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>{!! $sale->debt==0?'<span class="text-danger">Cancelada</span>':$sale->debt !!}</td>
                    <td>{{ $sale->date }}</td>                    
                </tr>
            </table>
        </div>

        @if ($sale->debt != 0)
            <div class="col-md-12 py-2">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#paymentModal" data-backdrop="static">
                    Añadir Pagos
                </button>
            </div>
        @endif

        <div class="col-md-12 py-2 table-responsive">
            <h4>Historial de pagos</h4>
            <hr>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th width="10px">#</th>
                        <th>Descripción</th>
                        <th>Deuda Anterior</th>
                        <th>Pago</th>
                        <th>Saldo</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sale->payments as $index => $payment)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $payment->description }}</td>
                        <td>{{ $payment->previous_amount }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->next_amount }}</td>
                        <td>{{ $payment->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('payments.form.modal')

@endsection