<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>
    <body class="@yield('body_class')">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/base/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
  <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" />

  {{-- datepicker css --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <link href="{{ asset('admin\assets\css\custom.css') }}" rel="stylesheet">
</head>
<body>



    <div class="container-scroller">

         @include('layouts.inc.navbar')

         <div class="container-fluid page-body-wrapper">

            @include('layouts.inc.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
               
                        
                    @yield('content')

                
                </div>
            </div>

         </div>


    </div>
    

    <!-- Scripts -->
    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('admin/js/template.js')}}"></script>
    <script src="{{ asset('admin/js/dashboard.js')}}"></script>
    <script src="{{ asset('admin/js/data-table.js')}}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.js')}}"></script>

    {{-- datepicker js --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    {{-- sweet alert cdn --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if(session('message'))
    <script>
        swal("{{ session('message') }}", {
        icon: "success",
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        swal("{{ session('error') }}", {
        icon: "error",
        });
    </script>
    @endif


    @if(session('warning'))
    <script>
        swal("{{ session('warning') }}", {
        icon: "warning",
        });
    </script>
    @endif



    <script src="{{ asset('admin\assets\js\custom.js') }}" ></script>




</body>
</html>
