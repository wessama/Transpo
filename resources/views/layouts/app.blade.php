<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Plug-in meta -->
  @stack('meta')

  <!-- Title Page-->
  <title>{{ setting('site.title') }}</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/icon/favicon.jpg') }}"/>

  <!-- Fontfaces CSS-->
  <link href=" {{ asset('css/font-face.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }} " rel="stylesheet" media="all">

  <!-- Bootstrap CSS-->
  <link href=" {{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }} " rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href=" {{ asset('vendor/animsition/animsition.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/wow/animate.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/slick/slick.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/select2/select2.min.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }} " rel="stylesheet" media="all">
  <link href=" {{ asset('vendor/vector-map/jqvmap.min.css') }} " rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href=" {{ asset('css/theme.css') }} " rel="stylesheet" media="all">

  <!-- Plug-in CSS -->
  @stack('styles')

</head>

<body class="animsition">
  <div class='page-wrapper'>
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar2">
      <div class="logo">
        <a>

        </a>
      </div>
      <div class="menu-sidebar2__content js-scrollbar1">
        @include('includes.partials.sidebar')
      </div>
    </aside>
    <!-- END MENU SIDEBAR-->
    <!-- START PAGE -->
    <div class='page-container2'>
      @include('includes.partials.nav')
      @include('includes.partials.breadcrumb')  
      @yield('content')
      @include('includes.partials.footer')
    </div>
    <!-- END PAGE -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  </div>


  <!-- Jquery JS-->
  <script src=" {{ asset('vendor/jquery-3.2.1.min.js') }} "></script>

  <!-- Bootstrap JS-->
  <script src=" {{ asset('vendor/bootstrap-4.1/popper.min.js') }} "></script>
  <script src=" {{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }} "></script>

  <!-- Vendor JS       -->
  <script src=" {{ asset('vendor/slick/slick.min.js') }} "></script>
  <script src=" {{ asset('vendor/wow/wow.min.js') }} "></script>
  <script src=" {{ asset('vendor/animsition/animsition.min.js') }} "></script>
  <script src=" {{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }} "></script>
  <script src=" {{ asset('vendor/counter-up/jquery.waypoints.min.js') }} "></script>
  <script src=" {{ asset('vendor/counter-up/jquery.counterup.min.js') }} "></script>
  <script src=" {{ asset('vendor/circle-progress/circle-progress.min.js') }} "></script>
  <script src=" {{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }} "></script>
  <script src=" {{ asset('vendor/chartjs/Chart.bundle.min.js') }} "></script>
  <script src=" {{ asset('vendor/select2/select2.min.js') }} "></script>
  <script src=" {{ asset('vendor/vector-map/jquery.vmap.js') }} "></script>
  <script src=" {{ asset('vendor/vector-map/jquery.vmap.min.js') }} "></script>
  <script src=" {{ asset('vendor/vector-map/jquery.vmap.sampledata.js') }} "></script>
  <script src=" {{ asset('vendor/vector-map/jquery.vmap.world.js') }} "></script>

  <!-- Main JS-->
  <script src=" {{ asset('js/main.js') }} "></script>

  <!-- Plug-in JS -->
  @stack('pagescript')
</body>

</html>    
