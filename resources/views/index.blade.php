@extends("master_template")

@section("content")

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->


            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="mini-stat clearfix bg-white border-green">
                        <span class="mini-stat-icon bg-light"><i class="fa fa-check text-green"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter text-green">13</span>
                            Toimunud võistlust kokku
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="mini-stat clearfix bg-white border-pink">
                        <span class="mini-stat-icon bg-light"><i class="fa fa-trophy text-pink"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter text-pink">6</span>
                            Võistlust tulemas
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="mini-stat clearfix bg-white border-orange">
                        <span class="mini-stat-icon bg-light"><i class="fa fa-users text-orange"></i></span>
                        <div class="mini-stat-info text-right text-muted">
                            <span class="counter text-orange">500</span>
                            Võistlejat osalenud kokku
                        </div>
                    </div>
                </div>
                <!---
                <div class="col-md-6 col-xl-3">
                    <a href="#">
                        <div class="mini-stat clearfix bg-add" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <span class="mini-stat-icon bg-light"><i class="fa fa-plus text-add"></i></span>
                        <div class="mini-stat-info text-right text-light">
                            <h6 class="button-text">Lisa uus võistlus</h6>
                        </div>
                    </div>
                    </a>
                </div>
                -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Võistlused</h4>
                            <div class="competition">
                                <ul>
                                    <li class="competition"><a class="text-grey" href="competitions/1">Jõgeva Sügis
                                            2018, Jõgeva Spordikeskus Virtus, M-IV liiga, 01/09/18 </a></li>
                                    <li class="competition"><a class="text-grey" href="competitions/1">Jõgeva Sügis
                                            2018, Jõgeva Spordikeskus Virtus, M-IV liiga, 01/09/18 </a></li>
                                    <li class="competition"><a class="text-grey" href="competitions/1">Jõgeva Sügis
                                            2018, Jõgeva Spordikeskus Virtus, M-IV liiga, 01/09/18 </a></li>
                                    <li class="competition"><a class="text-grey" href="competitions/1">Jõgeva Sügis
                                            2018, Jõgeva Spordikeskus Virtus, M-IV liiga, 01/09/18 </a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- end container -->


        <!-- add new competition Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
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
                                <div class="form-group row">
                                    <label for="competition-name" class="col-sm-4 col-form-label">Võistluse nimi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="competition-name"
                                               placeholder="Sisesta võistluse nimi" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="competition-place" class="col-sm-4 col-form-label">Võistluse koht ja
                                        aeg</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="competition-place"
                                               placeholder="Sisesta võistluse koht" required/>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" data-date-start-date="+1d"
                                                   placeholder="Vali kuupäev" id="datepicker-autoclose">
                                            <div class="input-group-append bg-custom b-0"><span
                                                        class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span></div>
                                        </div><!-- input-group -->
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customFile" class="col-sm-4 col-form-label">Võistluse juhend</label>
                                    <div class="col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <small id="guideHelp" class="form-text text-muted">Lisa siia võistluse
                                                juhendi
                                                pdf fail.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                   value="option1" onclick="myFunction()">
                                            <label class="form-check-label"
                                                   for="inlineCheckbox1">Paarismänguturniir</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                   value="option2" onclick="mySecondFunction()">
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
                                                       value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1">Meespaar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="Checkbox2"
                                                       value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Naispaar</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="Checkbox3"
                                                       value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Segapaar</label>
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
                                                       value="option1" onclick="myFunction()">
                                                <label class="form-check-label" for="inlineCheckbox1">Meesüksik</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxWomen2"
                                                       value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Naisüksik</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function myFunction() {
                                        // Get the checkbox
                                        var checkBox = document.getElementById("inlineCheckbox1");
                                        // Get the output text
                                        var text = document.getElementById("doubles");

                                        // If the checkbox is checked, display the output text
                                        if (checkBox.checked == true) {
                                            text.style.display = "block";
                                        } else {
                                            text.style.display = "none";
                                        }
                                    }

                                    function mySecondFunction() {
                                        // Get the checkbox
                                        var checkBox = document.getElementById("inlineCheckbox2");
                                        // Get the output text
                                        var text = document.getElementById("singles");

                                        // If the checkbox is checked, display the output text
                                        if (checkBox.checked == true) {
                                            text.style.display = "block";
                                        } else {
                                            text.style.display = "none";
                                        }
                                    }
                                </script>

                                <div class="form-group row">
                                    <label for="date-range" class="col-sm-4 col-form-label">Registreerimine</label>
                                    <div class="col-sm-8">
                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="text" class="form-control" name="start"
                                                   placeholder="Registreerimine algab"/>
                                            <div class="input-group-append bg-custom b-0"><span
                                                        class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span></div>
                                            <input type="text" class="form-control ml-4" name="end"
                                                   placeholder="Registreerimine lõppeb"/>
                                            <div class="input-group-append bg-custom b-0"><span
                                                        class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-add" value="Lisa võistlus">
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- end modal body -->
                </div>
            </div>
        </div>
    </div>


@endsection