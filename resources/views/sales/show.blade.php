@extends('layouts.master')

@section('title', '| Detalle de Venta')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-4">
                        <div class="col-md-6 py-2 text-center">
                            <div class="p-4 bg-danger">
                                <img src="https://www.mastergis.com/wp-content/themes/masterig/images/logo.svg" class="img-fluid">
                            </div>
                        </div>

                        <div class="col-md-6 py-2 text-right">
                            <p class="font-weight-bold mb-1 text-danger">N° {{ $sale->code }}</p>
                            <p class="text-muted">Fecha: {{ $sale->date }}</p>
                            <p class="text-muted">Hora: {{ $sale->time }}</p>
                        </div>
                    </div>

                    <hr class="my-2">

                    <div class="row pb-4 p-4">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Información del cliente</p>
                            <p class="mb-1"><span class="text-muted">Nombre: </span>{{ $sale->student->lastname }}</p>
                            <p class="mb-1"><span class="text-muted">Apellido: </span>{{ $sale->student->name }}</p>
                            <p class="mb-1"><span class="text-muted">País: </span>{{ $sale->student->country->description }}</p>                            
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Detalles del pago</p>
                            <p class="mb-1"><span class="text-muted">Tipo de pago: </span> {{ $sale->payment->name }}</p>                            
                        </div>
                    </div>

                    <div class="row p-4">
                        <div class="col-md-12 table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold" width="10px">#</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Descripción</th>
                                        <th class="border-0 text-uppercase small font-weight-bold" width="10px">Cantidad</th>
                                        <th class="border-0 text-uppercase small font-weight-bold" >Precio</th>
                                        <th class="border-0 text-uppercase small font-weight-bold" >Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale->items as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->course_description }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-danger text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Total</div>
                            <div class="h2 font-weight-light">{{ $sale->total }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Subtotal</div>
                            <div class="h2 font-weight-light">{{ $sale->subtotal }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection