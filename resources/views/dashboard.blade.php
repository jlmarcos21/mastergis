@extends('layouts.master')

@section('title', '| Panel de Control')

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
        <div class="card text-white bg-primary o-hidden h-100">
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
        <div class="card text-white bg-info o-hidden">
          <div class="card-body">
            <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>              
            </div>
            <div class="mr-5">{{ $consultations }} Consultas</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{ route('consultations.index') }}">
            <span class="float-left">Ver Consultas</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white text-center bg-success o-hidden h-100">
          <div class="card-header">
              Ventas de {{$date}}
          </div>
          <div class="card-body row">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-users"></i>
            </div>
            <div class="col-md-6">
              S/ {{ number_format($sales_pe->total, 2)}}
            </div>
            <div class="col-md-6">
              $ {{ number_format($sales_usd->total, 2) }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">        
        <div class="card border-danger">
          <div class="card-header border-danger text-center overflow-auto">
            <div class="btn-group btn-group-lg" role="group" id="years">                      
            </div>        
          </div>
          <div class="card-body">
            <div id="search-year" style="height: 100%"></div>
          </div>
        </div>
      </div>

    </div>
@endsection

@section('scripts')
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  <script>

    let URLPAGE = `{{ env('APP_URL') }}`;

    let date = new Date();
    let year = date.getFullYear();
    let years = [0, 1, 2, 3, 4, 5];

    for (const value of years) {
      let result = parseInt(year) - value;
      $("#years").append(`<button type="button" class="btn btn-danger" onclick="get_sales(${result})">${result}</button>`);               
    }



    function get_sales(year){

      let meses = [];
      let total_soles = [];
      let total_dolares = [];    

      $.get(`${URLPAGE}search_year/${year}`, function(res){
        res.forEach(element => {
          meses.push(element.mes)
          total_soles.push(parseFloat(element.total_soles));
          total_dolares.push(parseFloat(element.total_dolares));
        });          

        Highcharts.chart('search-year', {
          chart: {
              type: 'column'
          },
          title: {
              text: `Ventas del Año ${year}`
          },
          xAxis: {
              categories: meses,
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Ventas'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [
            {
              name: 'Soles',         
              data: total_soles

            },
            {
              name: 'Dolares',
              data: total_dolares
            }
          ]
        });
      });
    }

  </script>

@endsection
