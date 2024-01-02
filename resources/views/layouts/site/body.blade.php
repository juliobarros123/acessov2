<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Vertical | Vuesy - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- plugin css -->
        <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- swiper css -->
        <link rel="stylesheet" href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" id="app-style" rel="stylesheet" type="text/css"  />
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" id="app-style" rel="stylesheet" type="text/css"  /> --}}
   
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/prova.css')}}">

    </head>

    <body data-topbar="dark">
    @include('layouts.admin.header')
        @yield('conteudo')
    @include('layouts.admin.footer')

<!-- JAVASCRIPT -->
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenujs/metismenujs.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

<!-- apexcharts -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Vector map-->
<script src="{{asset('assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
<script src="{{asset('assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

<!-- swiper js -->
<script src="{{asset('assets/libs/swiper/swiper-bundle.min.js')}}"></script>

<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>
