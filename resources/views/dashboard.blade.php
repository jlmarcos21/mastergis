@extends('layouts.master')

@section('title', 'Panel de Control')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('dashboard') }}">Panel de Control</a>
        </li>
    </ol>

      <!-- Icon Cards-->
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-dark o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-users"></i>
            </div>
            <div class="mr-5">{{ $students }} Estudiantes</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('students.index') }}">
            <span class="float-left">Ver Detalles</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-book"></i>
            </div>
            <div class="mr-5">{{ $courses }} Cursos</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('courses.index') }}">
            <span class="float-left">Ver Detalles</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-shopping-cart"></i>
            </div>
            <div class="mr-5">{{ $sales }} Ventas</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('sales.index') }}">
            <span class="float-left">Ver Detalles</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-globe-americas"></i>
            </div>
            <div class="mr-5">{{ $countries }} Paises</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('countries.index') }}">
            <span class="float-left">Ver Detalles</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white text-center bg-primary o-hidden h-100">
          <div class="card-header">
              Ventas de {{$date}}
          </div>
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-users"></i>
            </div>
            <div class="py-1">
              S/ {{ number_format($sales_pe->total, 2)}}
            </div>
            <div class="py-1">
              $ {{ number_format($sales_usd->total, 2) }}
            </div>
        </div>
      </div>
    </div>
@endsection
