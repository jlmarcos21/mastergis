<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }} @yield('title')</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="icon" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-32x32.png" sizes="32x32" />
  <link rel="icon" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon-precomposed" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-180x180.png" />
  <meta name="msapplication-TileImage" content="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-270x270.png" />
  
  <!-- Styles -->
  <style>
    .card-bg:hover{
      cursor: pointer;
      border: solid #000 1px;
    }
    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(https://loading.io/spinners/earth/lg.earth-globe-map-spinner.gif) center no-repeat #fff;
    }
  </style>
  @yield('links')

</head>

<body id="page-top">
  <div class="se-pre-con"></div>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="{{ route('dashboard') }}">Master<span class="text-danger">Gis</span></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    {{-- <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-danger" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-0 my-0 my-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {!! $view_assignments->count()==0?'':'<span class="badge badge-danger">'.$view_assignments->count().'</span>' !!} 
          <i class="fas fa-bell fa-fw"></i>  
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item">Asignaciones por Vencer</a>
          <div class="dropdown-divider"></div>
          @foreach ($view_assignments as $asig)
            <a class="dropdown-item active text-center" href="{{ route('assignments.show', $asig->code) }}">{{ $asig->code }}</a>
          @endforeach          
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }} <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#logoutModal" data-toggle="modal" data-target="#">Salir</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel de Control</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="StudentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-user-graduate"></i>
          <span>Estudiantes</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="StudentDropdown">
          <a class="dropdown-item" href="{{ route('students.create') }}">Nuevo Estudiante</a>
          <a class="dropdown-item" href="{{ route('students.index') }}">Listado de Estudiantes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="CourseDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-book"></i>
          <span>Cursos</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="CourseDropdown">
          <a class="dropdown-item" href="{{ route('courses.create') }}">Nuevo Curso</a>
          <a class="dropdown-item" href="{{ route('courses.index') }}">Listado de Cursos</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="SaleDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Ventas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="SaleDropdown">
          <a class="dropdown-item" href="{{ route('sales.create') }}">Nueva Venta</a>
          <a class="dropdown-item" href="{{ route('sales.index') }}">Listado de Ventas</a>
          <a class="dropdown-item" href="{{ route('payments.index') }}">Ventas por Cobrar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="AsigDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">          
          <i class="fas fa-fw fa-book-open"></i>
          <span>Asignaciones</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="AsigDropdown">
          <a class="dropdown-item" href="{{ route('assignments.index') }}">Lista de Asignaciones</a>
        </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="ReportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">          
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Reportes</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="ReportDropdown">
            <a class="dropdown-item" href="#">Consulta de Ventas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Consulta de Cursos</a>
          </div>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('statistics.index') }}">          
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Estadísticas</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <!-- container-fluid -->
      <div class="container-fluid" id="app">
          @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Mensaje</strong> {{ session('info') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if(count($errors))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

        @yield('content')

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <a>Copyright <a href="https://www.mastergis.com" target="_blank" class="text-danger">©MasterGIS 2019</a></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.
        </div>
        <div class="modal-footer">
          <button class="btn btn-dark" type="button" data-dismiss="modal">Cancelar</button>

          <a class="btn btn-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            Cerrar Sesión
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script>

    window.onload = function() {
      $(".se-pre-con").fadeOut("slow");
    };
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
  @yield('scripts')
  
</body>

</html>
