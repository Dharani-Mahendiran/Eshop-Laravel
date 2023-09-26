<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

  <!-- Bootstrap:css -->
  
  <link href="{{ asset('frontend\assets\css\bootstrap5.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend\assets\css\custom.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend\assets\css\responsive.css') }}" rel="stylesheet">
</head>
<body>
   

    <div class="container-scroller">

        @include('layouts.inc.frontend_navbar')
            <div class="main-panel">
   
                    @yield('content')

            </div>

    </div>


    <!-- Scripts -->
    <script src="{{ asset('frontend\assets\js\bootstrap5.bundle.min.js') }}" ></script>
    <script src="{{ asset('frontend\assets\js\jquery-3.7.0.min.js') }}" ></script>
    <script src="{{ asset('frontend\assets\js\custom.js') }}" ></script>

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

</body>
</html>
