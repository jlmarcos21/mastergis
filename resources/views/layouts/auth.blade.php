<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'MasterGis')</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="icon" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-32x32.png" sizes="32x32" />
  <link rel="icon" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon-precomposed" href="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-180x180.png" />
  <meta name="msapplication-TileImage" content="https://www.mastergis.com/wp-content/uploads/2018/08/cropped-favicon-1-270x270.png" />

  <style>
    .bg-login{
      background-image: url("https://i.imgur.com/ThZvNLF.jpg");
      background-color: black;
      height: 500px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
  </style>
</head>

<body class="bg-login">

    <div class="container" id="app">

        @yield('content')
        
    </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')

</body>

</html>
