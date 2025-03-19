<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') - Admin</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('admin/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/modules/summernote/summernote-bs4.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/components.css') }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      
      @include('admin.partials.navbar')
      @include('admin.partials.sidebar')


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>
     @include('admin.partials.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('admin/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/modules/popper.js') }}"></script>
  <script src="{{ asset('admin/modules/tooltip.js') }}"></script>
  <script src="{{ asset('admin/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('admin/modules/moment.min.js') }}"></script>
  <script src="{{ asset('admin/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
<!--   <script src="{{ asset('admin/modules/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('admin/modules/chart.min.js') }}"></script>
  <script src="{{ asset('admin/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script> -->
  <script src="{{ asset('admin/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('admin/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('admin/js/page/index.js') }}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('admin/js/scripts.js') }}"></script>
  <script src="{{ asset('admin/js/custom.js') }}"></script>
</body>
</html>
