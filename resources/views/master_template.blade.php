<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Sk Badmint võistlused</title>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ url('plugins/morris/morris.css') }}">

    <!-- Plugins css -->
    <link href="{{ url('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"/>

    <!-- App css -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" type="text/css"/>


</head>
<body>


<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                <a href="/" class="logo">
                    <img src="{{ url('images/loputoo-logo.png') }}" alt="logo" height="35" class="logo-small">
                    <img src="{{ url('images/loputoo-logo.png') }}" alt="logo" height="55" class="logo-large">
                </a>

            </div>
            <!-- End Logo container-->

            <div class="menu-extras topbar-custom">
                <ul class="list-inline float-right mb-0">

                    <!-- User-->
                    @if(Auth::check())
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" href="/logout"
                               role="button"
                               aria-haspopup="false" aria-expanded="false">Logi välja</a>
                        </li>
                    @else
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" href="/login"
                               role="button"
                               aria-haspopup="false" aria-expanded="false">Logi sisse</a>
                        </li>
                    @endif
                    <li class="menu-item list-inline-item">

                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#navigation">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->

                    </li>

                </ul>
            </div>
            <!-- end menu-extras -->

            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <!-- MENU Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <div id="navigation">

                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="/"><i class="ti-home"></i>Avaleht</a>
                    </li>

                    <li class="has-submenu">
                        <a href="/competitions"><i class="ti-cup"></i>Võistlused</a>
                    </li>
                </ul>
                <!-- End navigation menu -->

            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->


@yield("content")


<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <p class="text-grey-light">Võta meiega ühendust</p>
                <hr class="margin">
                +372 506 1430 või koitkesamaa71@gmail.com
            </div>
            <div class="col-sm-4">
                <img src="{{ url('images/SkBadMint.png') }}" width="30%">

            </div>
            <div class="col-sm-4">
                <p class="text-grey-light">Võistlustasud palume kanda sellele arvele</p>
                <hr class="margin">
                A/a 12345678910111213 Swedbank
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<!-- custom js -->
<script src="{{ url('js/custom.js') }}"></script>

<!-- jQuery  -->
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/popper.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/modernizr.min.js') }}"></script>
<script src="{{ url('js/waves.js') }}"></script>
<script src="{{ url('js/jquery.slimscroll.js') }}"></script>
<script src="{{ url('js/jquery.nicescroll.js') }}"></script>
<script src="{{ url('js/jquery.scrollTo.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ url('plugins/morris/morris.min.js') }}"></script>
<script src="{{ url('plugins/raphael/raphael-min.js') }}"></script>

<!-- Plugins js -->
<script src="{{ url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ url('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ url('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"
        type="text/javascript"></script>

<!-- Plugins Init js -->
<script src="{{ url('js/form-advanced.js') }}"></script>

</body>
</html>