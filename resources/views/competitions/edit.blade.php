@extends("master_template")

@section("content")
    <script src="{{ url('js/jquery.min.js') }}"></script>

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="page-title-box">
                        <h6 style="font-weight:200;">Muuda võistlust</h6><h6>{{ $competition->title }}</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 pr-5 pl-5">
                    <div class="card m-b-30">
                        <div class="card-body pl-5 pr-5">
                            <form method="post" action="/competitions/{{ $competition->id }}"
                                  enctype="multipart/form-data">
                                @method("patch")
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
                                    <label for="competition-name" class="col-sm-4 col-form-label">Võistluse
                                        nimi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="competition-name" name="title"
                                               value="{{ $competition->title }}"
                                               placeholder="Sisesta võistluse nimi"
                                               required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="competition-place" class="col-sm-4 col-form-label">
                                        Võistluse koht
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="competition-place"
                                               name="location"
                                               value="{{ $competition->location }}"
                                               placeholder="Sisesta võistluse koht" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="competition-place" class="col-sm-4 col-form-label">
                                        Võistluse aeg
                                    </label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" data-date-start-date="+1d"
                                                   name="datetime"
                                                   value="{{ $competition->date }}"
                                                   placeholder="Vali kuupäev" id="datepicker-autoclose">
                                            <div class="input-group-append bg-custom b-0"><span
                                                        class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span></div>
                                        </div><!-- input-group -->
                                    </div>

                                    <div class="col-sm-4">
                                        <input class="form-control" type="time" name="time"
                                               value="{{ $competition->time }}" id="example-time-input" required>
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

                                <div class="form-group row">
                                    <label for="customFile" class="col-sm-4 col-form-label">Võistluse juhend</label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile"
                                                   name="instructions"
                                                   accept=".pdf" value="">
                                            <label class="custom-file-label" id="instructions-label"
                                                   for="customFile">
                                                {{ $competition->instructions }}
                                            </label>
                                            <small id="guideHelp" class="form-text text-muted">
                                                Lisa siia võistluse juhendi pdf fail.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customImage" class="col-sm-4 col-form-label">Võistluse
                                        kaanepilt</label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customImage"
                                                   name="image"
                                                   accept=".png">
                                            <label class="custom-file-label" id="image-label" for="customImage">
                                                {{ $competition->image }}
                                            </label>
                                            <small id="guideHelp" class="form-text text-muted">
                                                Lisa siia võistluse pildi png fail.
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                   name="doubles"
                                                   value="option1">
                                            <label class="form-check-label"
                                                   for="inlineCheckbox1">Paarismänguturniir</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                   name="singles"
                                                   value="option2">
                                            <label class="form-check-label"
                                                   for="inlineCheckbox2">Üksikmänguturniir</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="doubles" style="display:none">
                                    <div class="form-group row">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-8">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="Checkbox1"
                                                       value="3" name="types[]">
                                                <label class="form-check-label"
                                                       for="inlineCheckbox1">Meespaar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="Checkbox2"
                                                       value="4" name="types[]">
                                                <label class="form-check-label"
                                                       for="inlineCheckbox2">Naispaar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="Checkbox3"
                                                       value="5" name="types[]">
                                                <label class="form-check-label"
                                                       for="inlineCheckbox2">Segapaar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="singles" style="display:none">
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
                                            <input type="text" class="form-control" name="registration_starts"
                                                   value="{{ $competition->registration_starts }}"
                                                   placeholder="Registreerimine algab"/>
                                            <div class="input-group-append bg-custom b-0"><span
                                                        class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span></div>
                                            <input type="text" class="form-control ml-4" name="registration_ends"
                                                   value="{{ $competition->registration_ends }}"
                                                   placeholder="Registreerimine lõpeb"/>
                                            <div class="input-group-append bg-custom b-0">
                            <span class="input-group-text">
                                <i class="mdi mdi-calendar"></i>
                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div style="background: red">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="modal-footer" style="border-top: none;">
                                    <button type="submit" class="btn btn-add" id="sa-success">Muuda</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <!-- end wrapper -->

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

                $(document).ready(function () {

                    // Select leagues
                    var leagues = {{ json_encode($leagues) }};

                    $('.selectpicker').val(leagues).selectpicker('refresh');


                    // Select types
                    var types = {{ json_encode($types) }};

                    // Find out if doubles
                    if (types[1] > 2) {
                        $("#inlineCheckbox1").click();

                        // Click all previously selected doubles
                        for (var i = 0; i < types.length; i++)
                            $('#doubles :input[value="' + types[i] + '"]').click();
                    } else {
                        $("#inlineCheckbox2").click();

                        // Click all previously selected singles
                        for (var i = 0; i < types.length; i++)
                            $('#singles :input[value="' + types[i] + '"]').click();
                    }
                })
            </script>
@endsection