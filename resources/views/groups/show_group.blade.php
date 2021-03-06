@extends("master_template")

@section("content")
    <script src="{{ url('js/jquery.min.js') }}"></script>

    <div class="wrapper" id="page-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group pull-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item text-grey-light">
                                    <a href="/competitions/{{ $competition_id }}">Tagasi osalejate lehele</a>
                                </li>
                            </ol>
                        </div>
                        <h6 class="page-title">{{ $competition_title }}</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="container">
                                <div class="table-responsive">

                                    @if ( session()->has('updated') )
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong>Hästi!</strong> Andmed on muudetud.</span>
                                        </div>
                                    @elseif ( session()->has('deleted') )
                                        <div class="alert alert-success alert-dismissible fade show"
                                             role="alert">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong>Hästi!</strong> Võistleja(d) on kustutatud.</span>
                                        </div>
                                    @elseif ( session()->has('subgroup_added') )
                                        <div class="alert alert-success alert-dismissible fade show"
                                             role="alert">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong>Hästi!</strong> Alagrupp on lisatud.</span>
                                        </div>
                                    @endif

                                    <h6 class="float-left mb-3 mt-4">{{ Auth::check() ? 'Osalejate info muutmine: ' . $title : $title }}</h6>

                                    @if(Auth::check())
                                        <div class="dropdown float-right mb-3">
                                            <button class="btn btn-change text-white dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-plus pr-2"></i>lisa uus alagrupp
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                 x-placement="bottom-start"
                                                 style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" id="subgroup-3">Kolmene alagrupp</a>
                                                <a class="dropdown-item" id="subgroup-4">Neljane alagrupp</a>
                                                <a class="dropdown-item" id="subgroup-5">Viiene alagrupp</a>
                                            </div>
                                        </div>

                                        <table class="table table-sm table-bordered">
                                            @if($second_person)
                                                <thead class="thead-default">
                                                <tr>
                                                    <th>1. mängija nimi</th>
                                                    <th>1. mängija email</th>
                                                    <th>2. mängija nimi</th>
                                                    <th>2. mängija email</th>
                                                    <th>Mänguliik</th>
                                                    <th>Liiga</th>
                                                    <th style="width: 92px;"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($contestants as $contestant)
                                                    @if($loop->odd)
                                                        <tr style="{{ $contestant->subgroup_id === 0 ? "" : "background: #edfdff" }}">
                                                            @endif

                                                            <td>{{ $contestant->name }}</td>
                                                            <td>{{ $contestant->email }}</td>

                                                            @if($loop->even)
                                                                <td>{{ $contestant->type_name }}</td>
                                                                <td>{{ $contestant->league_name }}</td>
                                                                <td>
                                                                    <a class="btn btn-change text-white edit"
                                                                       href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit">
                                                                        <i class="fa fa-pencil-square-o"></i>
                                                                    </a>
                                                                    <button class="btn btn-delete btn-delete-modal"
                                                                            data-team_id="{{ $contestant->team_id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                                </tbody>
                                            @else
                                                <thead>
                                                <tr>
                                                    <th>Mängija nimi</th>
                                                    <th>Mängija email</th>
                                                    <th>Mänguliik</th>
                                                    <th>Liiga</th>
                                                    <th style="width: 92px;"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($contestants as $contestant)
                                                    <tr style="{{ $contestant->subgroup_id === 0 ? "" : "background: #edfdff" }}">
                                                        <td>{{ $contestant->name }}</td>
                                                        <td>{{ $contestant->email }}</td>
                                                        <td>{{ $contestant->type_name }}</td>
                                                        <td>{{ $contestant->league_name }}</td>
                                                        <td>
                                                            <a class="btn btn-change text-white edit"
                                                               href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <button class="btn btn-delete btn-delete-modal"
                                                                    data-team_id="{{ $contestant->team_id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif
                                        </table>
                                </div>

                                <!-- kolmene alagrupp -->
                                <div id="div-subgroup-3" style="display: none">
                                    <form method="post" action="/competitions/{{ $address }}/subgroup">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="subgroup-title" class="col-sm-2 col-form-label">
                                                Alagrupi nimi
                                            </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="subgroup-title"
                                                       name="title" placeholder="Sisesta alagrupi nimi"
                                                       autocomplete="off" required>
                                            </div>
                                        </div>
                                        <table class="table table-sm table-bordered subgroup-3">
                                            <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Mängijad</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="text-center sub-3">1</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-3-1" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="bg-dark dt-height"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center sub-3">2</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-3-2" required>
                                                        <option selected value="">
                                                            Vali mängija(d)
                                                        </option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height"></td>
                                                <td class="bg-dark dt-height"></td>
                                                <td class="dt-height"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center sub-3">3</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-3-3" required>
                                                        <option selected value="">
                                                            Vali mängija(d)
                                                        </option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                                <td class="bg-dark dt-height"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-change mt-2 mb-2" type="submit">Lisa</button>
                                    </form>
                                </div>


                                <!-- neljane alagrupp -->
                                <div id="div-subgroup-4" style="display: none">
                                    <form method="post" action="/competitions/{{ $address }}/subgroup">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="subgroup-title"
                                                   class="col-sm-2 col-form-label pr-0">
                                                Alagrupi nimi
                                            </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="subgroup-title"
                                                       name="title" placeholder="Sisesta alagrupi nimi"
                                                       autocomplete="off" required>
                                            </div>
                                        </div>

                                        <table class="table table-sm table-bordered subgroup-4">
                                            <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Mängijad</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-4-1" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="bg-dark dt-height-4"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-4-2" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-4"></td>
                                                <td class="bg-dark dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-4-3" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                                <td class="bg-dark dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-4-4" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                                <td class="dt-height-4"></td>
                                                <td class="bg-dark dt-height-4"></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <button class="btn btn-change mt-2 mb-2" type="submit">Lisa</button>
                                    </form>
                                </div>


                                <!-- viiene alagrupp -->
                                <div id="div-subgroup-5" style="display: none">
                                    <form method="post" action="/competitions/{{ $address }}/subgroup">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="subgroup-title" class="col-sm-2 col-form-label">
                                                Alagrupi nimi
                                            </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="subgroup-title"
                                                       name="title" placeholder="Sisesta alagrupi nimi"
                                                       autocomplete="off" required>
                                            </div>
                                        </div>

                                        <table class="table table-sm table-bordered subgroup-5">
                                            <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Mängijad</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-5-1" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="bg-dark dt-height-5"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                                <td class="dt-height"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-5-2" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-5"></td>
                                                <td class="bg-dark dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-5-3" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="bg-dark dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-5-4" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="bg-dark dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">5</th>
                                                <th>
                                                    <select name="teams[]" class="form-control"
                                                            id="select-5-5" required>
                                                        <option selected value="">Vali mängija(d)</option>

                                                        @include("partials/subgroup_team_select")

                                                    </select>
                                                </th>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="dt-height-5"></td>
                                                <td class="bg-dark dt-height-5"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-change mt-2 mb-5" type="submit">Lisa</button>
                                    </form>
                                </div>

                                @else
                                    <table class="table table-sm table-bordered">
                                        <thead class="thead-default">
                                        <tr>
                                            <th>Osaleja nimi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contestants as $contestant)
                                            @if($loop->odd)

                                                <tr>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td class="no-border">{{ $contestant->name }}</td>
                                                            </tr>

                                                            @else
                                                                <tr>
                                                                    <td class="no-border">{{ $contestant->name }}</td>
                                                                </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Tiimi kustutamise modal -->
    <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header no-border">
                    <h5 class="modal-title text-center pt-5" id="exampleModalLongTitle">
                        Kas sa soovid võistleja(d) kustutada?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  pl-5 pr-5 pt-5 pb-5">
                </div>
                <div class="modal-footer no-border">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tühista</button>
                    <form method="post" id="delete-form">
                        @method("delete")
                        @csrf

                        <button class="btn btn-delete btn-ok" type="submit">Kustuta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        $(document).ready(function () {
            var div_subgroup_3 = $("#div-subgroup-3");
            var div_subgroup_4 = $("#div-subgroup-4");
            var div_subgroup_5 = $("#div-subgroup-5");
            var select_values = [null, null, null, null, null, null, null, null, null, null, null, null];

            // When delete button next to competition is clicked
            $(".btn-delete-form").on("click", function () {
                var team_id = $(".btn-delete-form").data("team_id");
                var address = '{{ $address }}';

                // Give the delete form the correct action attribute
                $("#delete-form").attr("action", "/competitions/" + address + '/' + team_id);

                // And show modal
                $(".delete-modal").modal("show")
            });


            // Show selected subgroup and hide others
            $("#subgroup-3").on("click", function () {
                div_subgroup_4.slideUp();
                div_subgroup_5.slideUp();

                div_subgroup_3.slideDown();
            });

            $("#subgroup-4").on("click", function () {
                div_subgroup_3.slideUp();
                div_subgroup_5.slideUp();

                div_subgroup_4.slideDown();
            });

            $("#subgroup-5").on("click", function () {
                div_subgroup_3.slideUp();
                div_subgroup_4.slideUp();

                div_subgroup_5.slideDown();
            });


            //  ===== size 3 subgroup =====
            $("#select-3-1").on("change", function () {
                var this_value = $(this).val();

                $('#select-3-2 option[value="' + select_values[0] + '"]').show();
                $('#select-3-3 option[value="' + select_values[0] + '"]').show();

                if (this_value !== "") {
                    $('#select-3-2 option[value="' + this_value + '"]').hide();
                    $('#select-3-3 option[value="' + this_value + '"]').hide()
                }

                select_values[0] = this_value;
            });

            $("#select-3-2").on("change", function () {
                var this_value = $(this).val();

                $('#select-3-1 option[value="' + select_values[1] + '"]').show();
                $('#select-3-3 option[value="' + select_values[1] + '"]').show();

                if (this_value !== "") {
                    $('#select-3-1 option[value="' + this_value + '"]').hide();
                    $('#select-3-3 option[value="' + this_value + '"]').hide()
                }

                select_values[1] = this_value;
            });

            $("#select-3-3").on("change", function () {
                var this_value = $(this).val();

                $('#select-3-1 option[value="' + select_values[2] + '"]').show();
                $('#select-3-2 option[value="' + select_values[2] + '"]').show();

                if (this_value !== "") {
                    $('#select-3-1 option[value="' + this_value + '"]').hide();
                    $('#select-3-2 option[value="' + this_value + '"]').hide()
                }

                select_values[2] = this_value;
            });
            //  ===== size 3 subgroup =====


            //  ===== size 4 subgroup =====
            $("#select-4-1").on("change", function () {
                var this_value = $(this).val();

                $('#select-4-2 option[value="' + select_values[3] + '"]').show();
                $('#select-4-3 option[value="' + select_values[3] + '"]').show();
                $('#select-4-4 option[value="' + select_values[3] + '"]').show();

                if (this_value !== "") {
                    $('#select-4-2 option[value="' + this_value + '"]').hide();
                    $('#select-4-3 option[value="' + this_value + '"]').hide();
                    $('#select-4-4 option[value="' + this_value + '"]').hide()
                }

                select_values[34] = this_value;
            });

            $("#select-4-2").on("change", function () {
                var this_value = $(this).val();

                $('#select-4-1 option[value="' + select_values[4] + '"]').show();
                $('#select-4-3 option[value="' + select_values[4] + '"]').show();
                $('#select-4-4 option[value="' + select_values[4] + '"]').show();

                if (this_value !== "") {
                    $('#select-4-1 option[value="' + this_value + '"]').hide();
                    $('#select-4-3 option[value="' + this_value + '"]').hide();
                    $('#select-4-4 option[value="' + this_value + '"]').hide()
                }

                select_values[4] = this_value;
            });

            $("#select-4-3").on("change", function () {
                var this_value = $(this).val();

                $('#select-4-1 option[value="' + select_values[5] + '"]').show();
                $('#select-4-2 option[value="' + select_values[5] + '"]').show();
                $('#select-4-4 option[value="' + select_values[5] + '"]').show();

                if (this_value !== "") {
                    $('#select-4-1 option[value="' + this_value + '"]').hide();
                    $('#select-4-2 option[value="' + this_value + '"]').hide();
                    $('#select-4-4 option[value="' + this_value + '"]').hide()
                }

                select_values[5] = this_value;
            });

            $("#select-4-4").on("change", function () {
                var this_value = $(this).val();

                $('#select-4-1 option[value="' + select_values[6] + '"]').show();
                $('#select-4-2 option[value="' + select_values[6] + '"]').show();
                $('#select-4-3 option[value="' + select_values[6] + '"]').show();

                if (this_value !== "") {
                    $('#select-4-1 option[value="' + this_value + '"]').hide();
                    $('#select-4-2 option[value="' + this_value + '"]').hide();
                    $('#select-4-3 option[value="' + this_value + '"]').hide()
                }

                select_values[6] = this_value;
            });
            //  ===== size 4 subgroup =====


            //  ===== size 5 subgroup =====
            $("#select-5-1").on("change", function () {
                var this_value = $(this).val();

                $('#select-5-2 option[value="' + select_values[7] + '"]').show();
                $('#select-5-3 option[value="' + select_values[7] + '"]').show();
                $('#select-5-4 option[value="' + select_values[7] + '"]').show();
                $('#select-5-5 option[value="' + select_values[7] + '"]').show();

                if (this_value !== "") {
                    $('#select-5-2 option[value="' + this_value + '"]').hide();
                    $('#select-5-3 option[value="' + this_value + '"]').hide();
                    $('#select-5-4 option[value="' + this_value + '"]').hide();
                    $('#select-5-5 option[value="' + this_value + '"]').hide()
                }

                select_values[7] = this_value;
            });

            $("#select-5-2").on("change", function () {
                var this_value = $(this).val();

                $('#select-5-1 option[value="' + select_values[8] + '"]').show();
                $('#select-5-3 option[value="' + select_values[8] + '"]').show();
                $('#select-5-4 option[value="' + select_values[8] + '"]').show();
                $('#select-5-5 option[value="' + select_values[8] + '"]').show();

                if (this_value !== "") {
                    $('#select-5-1 option[value="' + this_value + '"]').hide();
                    $('#select-5-3 option[value="' + this_value + '"]').hide();
                    $('#select-5-4 option[value="' + this_value + '"]').hide();
                    $('#select-5-5 option[value="' + this_value + '"]').hide()
                }

                select_values[8] = this_value;
            });

            $("#select-5-3").on("change", function () {
                var this_value = $(this).val();

                $('#select-5-1 option[value="' + select_values[9] + '"]').show();
                $('#select-5-2 option[value="' + select_values[9] + '"]').show();
                $('#select-5-4 option[value="' + select_values[9] + '"]').show();
                $('#select-5-5 option[value="' + select_values[9] + '"]').show();

                if (this_value !== "") {
                    $('#select-5-1 option[value="' + this_value + '"]').hide();
                    $('#select-5-2 option[value="' + this_value + '"]').hide();
                    $('#select-5-4 option[value="' + this_value + '"]').hide();
                    $('#select-5-5 option[value="' + this_value + '"]').hide()
                }

                select_values[9] = this_value;
            });

            $("#select-5-4").on("change", function () {
                var this_value = $(this).val();

                $('#select-5-1 option[value="' + select_values[10] + '"]').show();
                $('#select-5-2 option[value="' + select_values[10] + '"]').show();
                $('#select-5-3 option[value="' + select_values[10] + '"]').show();
                $('#select-5-5 option[value="' + select_values[10] + '"]').show();

                if (this_value !== "") {
                    $('#select-5-1 option[value="' + this_value + '"]').hide();
                    $('#select-5-2 option[value="' + this_value + '"]').hide();
                    $('#select-5-3 option[value="' + this_value + '"]').hide();
                    $('#select-5-5 option[value="' + this_value + '"]').hide()
                }

                select_values[10] = this_valuethis_value;
            });

            $("#select-5-5").on("change", function () {
                var this_value = $(this).val();

                $('#select-5-1 option[value="' + select_values[11] + '"]').show();
                $('#select-5-2 option[value="' + select_values[11] + '"]').show();
                $('#select-5-3 option[value="' + select_values[11] + '"]').show();
                $('#select-5-4 option[value="' + select_values[11] + '"]').show();

                if (this_value !== "") {
                    $('#select-5-1 option[value="' + this_value + '"]').hide();
                    $('#select-5-2 option[value="' + this_value + '"]').hide();
                    $('#select-5-3 option[value="' + this_value + '"]').hide();
                    $('#select-5-4 option[value="' + this_value + '"]').hide()
                }

                select_values[11] = this_value;
            })
            //  ===== size 5 subgroup =====


        });
    </script>
@endsection