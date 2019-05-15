@extends("master_template")

@section("content")
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                    </div>
                </div>
            </div>

            @if ( session()->has('stored') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Hästi!</strong> Võistlus on lisatud.</span>
                </div>
            @endif
        <!-- end page title end breadcrumb -->

            @if(Auth::check())
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-white border-green">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-check text-green"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-green">{{ $past_competitions }}</span>
                                Toimunud võistlust kokku
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-white border-pink">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-trophy text-pink"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-pink">{{ $future_competitions }}</span>
                                Võistlust tulemas
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="mini-stat clearfix bg-white border-orange">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-users text-orange"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-orange">{{ $past_contestants }}</span>
                                Võistlejat osalenud kokku
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 add">
                        <div class="mini-stat clearfix bg-add" data-toggle="modal" data-target="#create-modal">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-plus text-add"></i></span>
                            <div class="mini-stat-info text-right text-light">
                                <h6 class="button-text">Lisa uus võistlus</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <style>
                    .mini-stat-info {
                        font-size: 14px;
                    }
                </style>
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="mini-stat clearfix bg-white border-green">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-check text-green"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-green">{{ $past_competitions }}</span>
                                Toimunud võistlust kokku
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="mini-stat clearfix bg-white border-pink">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-trophy text-pink"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-pink">{{ $future_competitions }}</span>
                                Võistlust tulemas
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="mini-stat clearfix bg-white border-orange">
                            <span class="mini-stat-icon bg-light"><i class="fa fa-users text-orange"></i></span>
                            <div class="mini-stat-info text-right text-muted">
                                <span class="counter text-orange">{{ $past_contestants }}</span>
                                Võistlejat osalenud kokku
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Võistlused</h4>
                            <div class="competition">
                                <ul>
                                    @if($competitions->count() < 1)
                                        <span>Eesolevaid võistlusi pole.</span>
                                    @else
                                        @foreach ($competitions as $competition)

                                            <li class="competition">
                                                <a class="text-grey" href="/competitions/{{ $competition->id }}">
                                                    {{ $competition->title }},
                                                    {{ $competition->location }},
                                                    @foreach ($competition->leagues as $league)
                                                        {{ $league->name }},
                                                    @endforeach
                                                    {{ $competition->datetime }}
                                                </a>
                                            </li>

                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- end container -->


        <!-- Lisa uus võistlus modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true" id="create-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Lisa uus võistlus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">

                                <form id="add" method="post" action="/competitions" enctype="multipart/form-data">
                                    @csrf

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            Palun täida ära kõik väljad!
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="competition-name" class="col-sm-4 col-form-label">
                                            Võistluse nimi
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="competition-name" name="title"
                                                   placeholder="Sisesta võistluse nimi" autocomplete="off" required
                                                   value="{{ old("title") }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="competition-place" class="col-sm-4 col-form-label">
                                            Võistluse koht
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="competition-place"
                                                   name="location" placeholder="Sisesta võistluse koht"
                                                   autocomplete="off" required
                                                   value="{{ old("location") }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="competition-place" class="col-sm-4 col-form-label">
                                            Võistluse toimumise aeg
                                        </label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" data-date-start-date="+1d"
                                                       placeholder="Vali kuupäev" id="datepicker-autoclose"
                                                       name="date" value="{{ old("date") }}" autocomplete="off"
                                                       required>

                                                <div class="input-group-append bg-custom b-0">
                                                    <span class="input-group-text">
                                                        <i class="mdi mdi-calendar"></i>
                                                    </span>
                                                </div>
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="col-sm-4">
                                            <input class="form-control" type="time" name="time"
                                                   value="{{ old("time") }}" id="example-time-input" required>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="competition-place" class="col-sm-4 col-form-label">
                                            Liigad
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select name="leagues[]" class="selectpicker" multiple
                                                        title="Vali liigad" required>
                                                    <option value="1">Meistriliiga</option>
                                                    <option value="2">Esiliiga</option>
                                                    <option value="3">2. liiga</option>
                                                    <option value="4">3. liiga</option>
                                                    <option value="5">4. liiga</option>
                                                </select>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $('.selectpicker').selectpicker();
                                        });
                                    </script>

                                    <div class="form-group row">
                                        <label for="customFile" class="col-sm-4 col-form-label">Võistluse juhend</label>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                       name="instructions" accept=".pdf" required>
                                                <label class="custom-file-label" id="instructions-label"
                                                       for="customFile">Vali fail</label>

                                                <small id="guideHelp" class="form-text text-muted">
                                                    Lisa siia võistluse juhendi pdf fail.
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="customImage" class="col-sm-4 col-form-label">
                                            Võistluse kaanepilt
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customImage"
                                                       name="image" accept=".png">
                                                <label class="custom-file-label" id="image-label" for="customImage">Vali
                                                    fail</label>
                                                <small id="guideHelp" class="form-text text-muted">
                                                    Lisa siia võistluse pildi png fail.
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Mänguliigid
                                        </label>

                                        <div class="col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                       value="1" name="doubles">
                                                <label class="form-check-label" for="inlineCheckbox1">Paarismänguturniir
                                                </label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                       value="2" name="singles">
                                                <label class="form-check-label" for="inlineCheckbox2">Üksikmänguturniir
                                                </label>
                                            </div>
                                        </div>


                                    </div>

                                    <div id="doubles" style="display: none">
                                        <div class="form-group row">
                                            <div class="col-sm-4"></div>

                                            <div class="col-sm-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="checkbox1"
                                                           value="3" name="types[]">
                                                    <label class="form-check-label"
                                                           for="checkbox1">Meespaar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="checkbox2"
                                                           value="4" name="types[]">
                                                    <label class="form-check-label"
                                                           for="checkbox2">Naispaar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="checkbox3"
                                                           value="5" name="types[]">
                                                    <label class="form-check-label"
                                                           for="checkbox3">Segapaar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="singles" style="display: none">
                                        <div class="form-group row">
                                            <div class="col-sm-4"></div>

                                            <div class="col-sm-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="CheckboxMen1"
                                                           value="1" name="types[]">
                                                    <label class="form-check-label"
                                                           for="inlineCheckbox1">Meesüksik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="CheckboxWomen2"
                                                           value="2" name="types[]">
                                                    <label class="form-check-label"
                                                           for="inlineCheckbox2">Naisüksik</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date-range" class="col-sm-4 col-form-label">Registreerimine</label>
                                        <div class="col-sm-8">
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="registration starts"
                                                       placeholder="Algab" autocomplete="off" required/>
                                                <div class="input-group-append bg-custom b-0"><span
                                                            class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span></div>
                                                <input type="text" class="form-control ml-4" name="registration ends"
                                                       placeholder="Lõppeb" autocomplete="off" required/>
                                                <div class="input-group-append bg-custom b-0"><span
                                                            class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer no-border">
                                        <input type="submit" class="btn btn-add" value="Lisa võistlus" disabled>
                                    </div>

                                </form>

                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- end modal body -->
                </div>
            </div>
        </div>
    </div>

    <script>

        var doublesCheckbox = $("#inlineCheckbox1");
        var singlesCheckbox = $("#inlineCheckbox2");
        var doubles = $("#doubles");
        var singles = $("#singles");

        doublesCheckbox.on("click", function () {

            // Get the output text
            var text = $("#doubles");

            // If this checkbox is checked, display the output text
            if ($(this).prop("checked")) {
                doubles.slideDown();
            } else {
                doubles.slideUp();
            }

            // If the other checkbox is checked, uncheck it and hide its output
            if (singlesCheckbox.prop("checked")) {

                // Uncheck the other checkbox
                singlesCheckbox.prop("checked", false);

                // Hide it
                singles.slideUp();

                // And uncheck all of its checkboxes
                singles.find("input").each(function () {
                    $(this).prop("checked", false)
                })

            }
        });

        singlesCheckbox.on("click", function () {

            // If this checkbox is checked, display the output text
            if ($(this).prop("checked")) {
                singles.slideDown();
            } else {
                singles.slideUp();
            }

            // If the other checkbox is checked
            if (doublesCheckbox.prop("checked")) {

                // Uncheck the other checkbox
                doublesCheckbox.prop("checked", false);

                // Hide it
                doubles.slideUp();

                // And uncheck all of its checkboxes
                doubles.find("input").each(function () {
                    $(this).prop("checked", false)
                })
            }
        });

        var instructionsInput = document.getElementById('customFile');
        var instructionsName = document.getElementById('instructions-label');

        instructionsInput.addEventListener('change', showInstructionsName);

        function showInstructionsName(event) {

            // the change event gives us the input it occurred in
            var input = event.srcElement;

            // use fileName however fits your app best, i.e. add it into a div
            instructionsName.textContent = input.files[0].name;
        }


        var imageInput = document.getElementById('customImage');
        var imageName = document.getElementById('image-label');

        imageInput.addEventListener('change', showImageName);

        function showImageName(event) {

            // the change event gives us the input it occurred in
            var input = event.srcElement;

            // use fileName however fits your app best, i.e. add it into a div
            imageName.textContent = input.files[0].name;
        }


        //Change Valmis! button color when checkboxes are checked
        $("input[class='form-check-input']").click(function () {
            if ($("input:checkbox:checked").length > 0) {

                $(".btn-add").removeAttr("disabled");
            } else {
                $(".btn-add").attr("disabled", "disabled");
            }
        });

        @if ($errors->any())
            $("#create-modal").modal("show");
        @endif
    </script>


@endsection