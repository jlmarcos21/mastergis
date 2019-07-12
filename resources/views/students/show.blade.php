@extends('layouts.master')

@section('title', '| Perfil del Estudiante')

@section('content')

<div class="row">
  <div class="col-md-8">        
    <div class="row">
      <div class="col-md-12 table-responsive">
        <h3><strong>Asignaciones</strong></h3>
        <hr>
        <table class="table table-sm table-bordered text-center">
          <thead>
            <tr>
              <th>Código</th>
              <th>Curso</th>
              <th>Imagen</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($student->assignments as $assignment)
              <tr>
                <td><a href="{{ route('assignments.show', $assignment->code) }}">{{ $assignment->code }}</a></td>
                <td>{{ $assignment->course->name }}</td>
                <td><img src="{{ $assignment->course->image_url }}" class="img-fluid" alt="{{ $assignment->course->name }}" width="40px"></td>
                <td>
                  @if ($assignment->finished)
                    <strong class="text-success">Curso Terminado</strong>
                  @else
                    <strong class="text-danger">No Terminado</strong>
                  @endif
                </td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="col-md-12 table-responsive p-4">
        <h3><strong>Ventas</strong></h3>
        <hr>
        <table class="table table-sm table-bordered text-center">
          <thead>
            <tr>
              <th>Código</th>
              <th>Comprobante</th>
              <th>Fecha</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($student->sales as $sale)
              <tr>
                <td><a href="{{ route('sales.show', $sale->id) }}">{{ $sale->code }}</a></td>
                <td>{{ $sale->voucher->name }}</td>
                <td>{{ $sale->date }}</td>
                <td>{{ $sale->total }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md">
    <ul class="list-group">
      <li class="list-group-item bg-primary text-center text-white"><h4>Datos del Estudiante</h4></li>
      <li class="list-group-item"><strong>Nombre :</strong> {{ $student->name }}</li>
      <li class="list-group-item"><strong>Apellido :</strong> {{ $student->lastname }}</li>
      <li class="list-group-item"><strong>Sexo :</strong> {{ $student->sex }}</li>          
      <li class="list-group-item"><strong>País :</strong> {{ $student->country->description }} <span class="{{ $student->country->flag }}"></span></li>
      <li class="list-group-item"><strong>Provincia :</strong> {{ $student->province->description }}</li>
      <li class="list-group-item"><strong>Correo :</strong> {{ $student->email }}</li>
      <li class="list-group-item"><strong>Celular :</strong> {{ $student->phone }}</li>      
    </ul>
  </div>
</div>

<div class="row py-3">
  <div class="col-md-12">
    <div class="d-flex justify-content-center bg-primary text-white p-4">
      <div class="px-5">
          <div class="mb-2">Total de Cursos</div>
          <div class="h2 font-weight-light text-center"><i class="fas fa-book"></i> {{ $student->assignments->count() }}</div>
      </div>
    
      <div class="px-5">
          <div class="mb-2">Total de Compras</div>
          <div class="h2 font-weight-light text-center"><i class="fas fa-shopping-cart"></i> {{ $student->sales->count() }}</div>
      </div>
    </div>
  </div>
</div>

@endsection