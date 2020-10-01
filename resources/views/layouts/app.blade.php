<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">

</head>
<body>
        <a href="#top" class="page-scroll" id="topBtn" title="Go to top"><i class="fa fa-angle-up"></i></a>

        <!-- Full Page Image Header with Vertically Centered Content -->
        <header class="masthead">

            <!-- mobile menu start -->
            <nav class="navbar navbar-expand-lg fixed-top py-3 p-0 d-md-none d-xs-block" id="mainNav">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand"><img src=" {{asset('img/logo2.png')}} " width="100" height="30" alt=""></a>
                    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="nav" id="langs-mobile">
                            <li><a href="#" class="active">AZ</a></li>
                            <li><a href="#">EN</a></li>
                            <li><a href="#">RU</a></li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active"><a href="#" class="nav-link">ƏSAS SƏHİFƏ <span class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a href="#" class="nav-link">BAŞ REDAKTORDAN</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    JURNAL
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">JURNAL HAQQINDA</a>
                                    <a class="dropdown-item" href="#">ARXİV</a>
                                    <a class="dropdown-item" href="#">REDAKSİYA HEYƏTİ</a>
                                    <a class="dropdown-item" href="#">REDAKSİYA ŞURASI</a>
                                    <a class="dropdown-item" href="#">TƏSİSÇİLƏR</a>
                                    <a class="dropdown-item" href="#">JURNALDA REKLAM</a>
                                    <a class="dropdown-item" href="#">SON NÖMRƏ</a>
                                    <a class="dropdown-item" href="#">ABUNƏ OL</a>
                                    <a class="dropdown-item" href="#">MƏQALƏ QƏBULU</a>
                                </div>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">ƏLAQƏ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- mobile menu end -->


            <img src="{{asset('img/logo2.png')}}" id="headerLogo" class="d-none d-md-block">
            <div class="d-none d-md-block" style="width: 15%;float:right;padding: 1em 2em;">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="langs active" href="#">AZ</a>
                    </li>
                    <li class="nav-item">
                        <a class="langs" href="#">EN</a>
                    </li>
                    <li class="nav-item">
                        <a class="langs" href="#">RU</a>
                    </li>
                </ul>
            </div>
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 text-center">
                        <img class="d-none d-md-block" style="width:75%;margin-top:1em;margin: auto;" src="{{asset('img/title.png')}}">
                        <img class="d-md-none img-fluid" style="margin-top:1em;" src="{{asset('img/title_m.png')}}">
                        <!-- <input type="search" name="mainSearch" placeholder="Açar sözləri daxil edin" id="searchInput"> -->
                        <!-- <input type="button" name="mainSearchButton" id="mainSearchButton"> -->
                        <!-- <button id="mainSearchButton"><i class="fa fa-search"></i></button> -->
                        <!-- <i class="fa fa-search" aria-hidden="true"></i> -->

                        <!-- Another variation with a button -->
                        <div class="input-group" style="margin: 0 auto;" id="header-search">
                            <input type="text" class="form-control" placeholder="Açar sözləri daxil edin" style="border-radius: 3px;">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" id="mainSearchButton" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <br>

                        <div class="d-none d-md-block" style="width: 100%;float: left;margin-left: auto;margin-right: auto;display: block;">
                            <input type="button" name="header_button_left" class="btn headerSideButtons" value="Məqalə qəbulu">
                            <input type="button" name="header_button_middle" class="btn headerMiddleButton" value="Jurnal haqqında">
                            <input type="button" name="header_button_right" class="btn headerSideButtons" value="Arxiv">
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-sm navbar-dark shadow-sm p-2 bg-white d-none d-md-block">
            <!-- Links -->
            <ul class="navbar-nav" style="padding: 0 2em;">
                <li class="nav-item" style="padding: 0 1em;">
                    <a class="nav-link active" href="#">ƏSAS SƏHİFƏ</a>
                </li>
                <li class="nav-item" style="padding: 0 1em;">
                    <a class="nav-link" href="#">BAŞ REDAKTORDAN</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown" style="padding: 0 1em;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        JURNAL
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">JURNAL HAQQINDA</a>
                        <a class="dropdown-item" href="#">ARXİV</a>
                        <a class="dropdown-item" href="#">REDAKSİYA HEYƏTİ</a>
                        <a class="dropdown-item" href="#">REDAKSİYA ŞURASI</a>
                        <a class="dropdown-item" href="#">TƏSİSÇİLƏR</a>
                        <a class="dropdown-item" href="#">JURNALDA REKLAM</a>
                        <a class="dropdown-item" href="#">SON NÖMRƏ</a>
                        <a class="dropdown-item" href="#">ABONƏ OL</a>
                        <a class="dropdown-item" href="#">MƏQALƏ QƏBULU</a>
                    </div>
                </li>

                <li class="nav-item" style="padding: 0 1em;">
                    <a class="nav-link" href="#">ƏLAQƏ</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <section class="row p-md-4 p-2">
            @yield('content')


            <!-- Sidebar -->
            <section class="py-md-5 col-md-3">
                <div class="ant-div-small text-center bg-white">
                    <img class="img-fluid" src="img/casp.png" style="border: 0.5px solid;">
                </div>
                <div class="ant-div-small bg-white">
                    <h4 class="font-weight-medium" style="letter-spacing: 1.2px; font: normal normal bold 18px/28px Arial;">Linklər</h4>
                    <hr align="left" style="width: 5em;border-bottom: 1px solid black; margin-top: 0.5rem !important;">

                    <a href="#"><img class="link-img img-fluid" src="img/logo_links/links1.jpg"></a>
                    <a href="#"><img class="link-img img-fluid" src="img/logo_links/links2.png"></a>
                    <a href="#"><img class="link-img img-fluid" src="img/logo_links/links3.png"></a>
                    <a href="#"><img class="link-img img-fluid" src="img/logo_links/links4.png"></a>
                    <a href="#"><img class="link-img img-fluid" src="img/logo_links/links5.jpg"></a>
                </div>
            </section>
            </section>
        </div>



        <!-- Footer -->
        <footer class="page-footer font-small stylish-color-dark pt-4" style="background-color: #030E22; color: white;">
            <br>
            <!-- Footer Links -->
            <div class="container text-md-left ml-0" id="globalFooter">

                <!-- Grid row -->
                <div class="row p-md-4 p-2">

                    <!-- Grid column -->
                    <div class="col-md-5">

                        <!-- Content -->
                        <img src="img/logo2.png" id="footerLogo">
                        <p class="text-color-custom">Azərbaycan Neft Təsərrüfatı Jurnalı</p>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none">

                    <!-- Grid column -->
                    <div class="col-md-2">

                        <ul class="list-unstyled">
                            <li class="footer-links">
                                <a href="#!">Əsas səhifə</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Baş redaktordan</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Jurnal haqqında</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Məqalə qəbulu</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Əlaqə</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none">

                    <!-- Grid column -->
                    <div class="col-md-2">

                        <ul class="list-unstyled">
                            <li class="footer-links">
                                <a href="#!">Son nömrə</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Arxiv</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Redaksiya heyəti</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Təsisçilər</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Jurnalda reklam</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none">

                    <!-- Grid column -->
                    <div class="col-md-3">

                        <ul class="list-unstyled">
                            <li class="footer-links">
                                <i class="fa fa-map-marker"></i>
                                <a href="#!">&nbsp;H.Zərdabi küç., 88, Az 1012</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">Bakı, Azərbaycan</a>
                            </li>
                            <li class="footer-links">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="#!">&nbsp;+994 (12) 521 15 18</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">521-15-48</a>
                            </li>
                            <li class="footer-links">
                                <a href="#!">433-89-64</a>
                            </li>
                            <li class="footer-links">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <a href="#!">&nbsp;office.aoi@socar.az</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Social buttons -->
            <hr style="background-color: white;height: 1px;opacity: 0.3;border-top: 0 !important;">
            <!-- Copyright -->
            <div class="footer-copyright text-left text-color-custom" style="padding: 0 1.5em 1em 1.5em;">© Copyright 2020. Bütün hüquqlar qorunur.
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->


        <script>

            $(function () {
                $(window).on('scroll', function () {
                    if ( $(window).scrollTop() > 10 ) {
                        $('.navbar').addClass('active');
                    } else {
                        $('.navbar').removeClass('active');
                    }
                });
            });

        </script>

        <script>

            var topbutton = document.getElementById("topBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    topbutton.style.display = "block";
                } else {
                    topbutton.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }

        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


</body>
</html>
