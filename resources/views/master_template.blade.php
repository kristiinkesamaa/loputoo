<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SK Badmint võistlused</title>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Favicons -->
    <link rel="icon" href="{{ url('images/icon.png') }}" type="image/gif" sizes="16x16 32x32">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ url('plugins/morris/morris.css') }}">

    <!-- Plugins css -->
    <link href="{{ url('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- App css -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" type="text/css"/>


</head>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container-fluid">

            <!-- Logo container-->
            <div class="logo">
                <a href="/" class="logo">
                    <img src="{{ url('images/logo.png') }}" alt="logo" height="30" class="logo-small">
                    <img src="{{ url('images/logo.png') }}" alt="logo" height="45" class="logo-large">
                </a>

            </div>
            <!-- End Logo container-->

            <div class="menu-extras topbar-custom">
                <ul class="list-inline float-right mb-0 mr-0 pr-0">

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
                        <button class="navbar-toggler navbar-toggle nav-link" type="button" data-toggle="collapse"
                                data-target="#mobile-navigation" aria-controls="mobile-navigation"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>
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
                    <li class="has-submenu {{ Request::path() === "/" ? "active" : null }}">
                        <a href="/"><i class="fa fa-home"></i>Avaleht</a>
                    </li>

                    <li class="has-submenu {{ substr(Request::path(), 0, 12) === "competitions" ? "active" : null }}">
                        <a href="/competitions"><i class="fa fa-trophy"></i>Võistlused</a>
                    </li>
                </ul>
                <!-- End navigation menu -->

            </div><!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->

    <div class="navbar-custom">
        <div class="pos-f-t">
            <div class="collapse" id="mobile-navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="/"><i class="fa fa-home"></i>Avaleht</a>
                    </li>

                    <li class="has-submenu">
                        <a href="/competitions"><i class="fa fa-trophy"></i>Võistlused</a>
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div>

        </div>
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->


@yield("content")


<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-grey-light">
                © 2019 MTÜ Sulgpalliklubi BadMint. Kõik õigused kaitstud.
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

<!-- Required datatable js -->
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ url('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ url('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ url('plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ url('plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ url('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<!-- Plugins Init js -->
<script src="{{ url('js/form-advanced.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ url('js/datatables.init.js') }}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function () {
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        })
    });
</script>

</html>