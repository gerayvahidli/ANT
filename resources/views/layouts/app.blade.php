<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta http-equiv="Content-Security-Policy" content="default-src https://cdn.example.net; child-src 'none'; object-src 'none'">--}}

    <title>SOCAR - Xarici Təqaüd Proqramı</title>
	<link rel="icon" href="http://socar.az/socar/assets/img/logo/ms-icon-144x144.png">

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">--}}
    <link rel="stylesheet"  href="{{asset('font-awesome/css/font-awesome.min.css')}}">
	<!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157723500-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157723500-1');
</script>


    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }


        input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
            color: #fff;
            position: relative;
        }

        input[type="date"]::-webkit-datetime-edit-year-field{
            position: absolute !important;
            border-left:1px solid #8c8c8c;
            padding: 2px;
            color:#000;
            left: 56px;
        }

        input[type="date"]::-webkit-datetime-edit-month-field{
            position: absolute !important;
            border-left:1px solid #8c8c8c;
            padding: 2px;
            color:#000;
            left: 26px;
        }


        input[type="date"]::-webkit-datetime-edit-day-field{
            position: absolute !important;
            color:#000;
            padding: 2px;
            left: 4px;

        }
        #special-div
        { display: none !important; }


    </style>


     @yield('head')
</head>
<body>

@include('frontend.components.mainNavigation')

<div class="container main">
    <div class="row">
        @if(!Request::is('profile*'))
            @if(!Request::is('register*') )
            @include('frontend.components.leftNavigation')
                @endif
        @endif


        <div class=" {{ (Request::is('profile*') || Request::is('register*')) ? 'col-md-12' : 'col-md-9' }} main-content">
            @include('vendor.flash.message')

            @yield('mainSection')
        </div>
    </div>
</div>

<!-- <div class="flex-center position-ref full-height">
    {{--@if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif--}}

</div> -->


 {{--modal--}}
<!-- Modal -->
<div class="modal fade" id="loaderModal" tabindex="-1" role="dialog" aria-labelledby="loaderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--end of modal--}}
<hr>

<!-- Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Bütün hüquqlar qorunur <span style="font-weight: bold;">&copy; <a href="https://caspianic.com/"> Caspian Innovation Center LLC</a></span> {{ now()->year }}</span>
        </div>
    </div>
</footer>
<hr>
<!-- End of Footer -->

<!-- Latest compiled and minified JavaScript -->
@yield('bottom')
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}

@yield('footerScripts')
<script>
    $('#loaderModal').modal({
        keyboard: false,
        show: false
    })
    $('#flash-overlay-modal').modal();

    $('.datepicker').datepicker(
        { format: 'dd.mm.yyyy' }
    );


</script>



</body>
</html>
