@extends('layouts.master')

@section('title', '| Perfil del Estudiante')

@section('content')

<div class="row">
  <div class="col-md-8">
    <h3><strong>Cursos Comprados</strong></h3>
    <hr>
    <div class="row">
      @foreach ($student->assignments as $assignment)
      <div class="col-md-4 py-2">
        <div class="card text-center card-bg" onclick="location.href='{{ route('assignments.show', $assignment->code) }}'" title="Realizar Seguimiento">
          <img src="{{ $assignment->course->image_url }}" class="card-img-top" alt="{{ $assignment->course->name }}">
          <div class="card-body">
            <p class="card-text">{{ $assignment->course->name }}</p>
            <p class="text-muted">{{ $assignment->code }}</p>

            @php
              $progress = $assignment->access+$assignment->entry+$assignment->physical_certificate+$assignment->poll
            @endphp
            
            @if($progress==1)
              <div class="progress">
                  <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%"></div>
              </div>
            @elseif($progress==2)
              <div class="progress">
                  <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"></div>
              </div>
            @elseif($progress==3)
              <strong class="text-success">Curso Terminado</strong>
            @endif

          </div>
        </div>
      </div>
      @endforeach        
    </div>
  </div>
  <div class="col-md">
    <ul class="list-group">
      <li class="list-group-item bg-primary text-center text-white"><h4>Datos del Estudiante</h4></li>
      <li class="list-group-item"><strong>Nombre :</strong> {{ $student->name }}</li>
      <li class="list-group-item"><strong>Apellido :</strong> {{ $student->lastname }}</li>      
      <li class="list-group-item"><strong>Nacionalidad :</strong> {{ $student->nationality }}</li>
      <li class="list-group-item"><strong>País :</strong> {{ $student->country->description }} <span class="{{ $student->country->flag }}"></span></li>      
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