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
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

    <!-- Plugins css -->
    <link href="public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="public/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet"/>

    <!-- App css -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/custom.css" rel="stylesheet" type="text/css"/>


</head>
<body>

<?php include('header.php'); ?>

<div class="wrapper" id="page-wrap">
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row mb-5 mt-3" id="changeRow">
            <div class="col-sm-12 mb-2">
                <nav class="pt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info"
                           role="tab" aria-controls="nav-info" aria-selected="true">Info</a>
                        <a class="nav-item nav-link" id="nav-participants-tab" data-toggle="tab"
                           href="#nav-participants" role="tab" aria-controls="nav-participants" aria-selected="false">Osalejad</a>
                        <a class="nav-item nav-link" id="nav-subgroups-tab" data-toggle="tab" href="#nav-subgroups"
                           role="tab" aria-controls="nav-subgroups" aria-selected="false">Alagrupid</a>
                        <a class="nav-item nav-link" id="nav-queue-tab" data-toggle="tab" href="#nav-queue" role="tab"
                           aria-controls="nav-queue" aria-selected="false">Järjekord</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                        <div class="row" id="customRow">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="container">

                                                <div class="row justify-content-start text-center">
                                                    <div class="col-12">
                                                        <p class="text-black-strong">
                                                            <img src="assets/images/sulgpall.png" width="40">
                                                            Jõgeva sügis 2018
                                                            <img src="assets/images/sulgpall2.png" width="40">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3"><p class="text-black-strong">Võistluse
                                                        aeg:</p></div>
                                                <div class="col-md-3"><p class="text-black-light">12/11/2018</p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3 text-left"><p class="text-black-strong">
                                                        Võistluse algus:</p></div>
                                                <div class="col-md-3 text-left"><p class="text-black-light">
                                                        10:00</p></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3"><p class="text-black-strong">Võistluse
                                                        toimumise koht:</p></div>
                                                <div class="col-md-3"><p class="text-black-light">Jõgeva
                                                        Spordikeskus Virtus</p></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3"><p class="text-black-strong">
                                                        Mänguliigid:</p></div>
                                                <div class="col-md-3"><p class="text-black-light">Nais-, mees- ja
                                                        segapaarid</p></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3"><p class="text-black-strong">Liigad:</p>
                                                </div>
                                                <div class="col-md-3"><p class="text-black-light">Meistriliiga -
                                                        4.liiga</p></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-3"><p class="text-black-strong">Võistluse
                                                        juhend:</p></div>
                                                <div class="col-md-3"><p class="text-black-light"><a
                                                                class="text-grey" href="#">juhend.pdf</a></p></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                    <button type="button" class="btn btn-add"
                                                            data-toggle="modal" data-target=".bd-example-modal-lg">
                                                        Registreeru
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-participants" role="tabpanel"
                         aria-labelledby="nav-participants-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="table-responsive-sm">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Liiga</th>
                                                        <th>Paare kokku</th>
                                                        <th>Osalejaid kokku</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga MD</a></td>
                                                        <td>18</td>
                                                        <td>36</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga WD</a></td>
                                                        <td>6</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga XD</a></td>
                                                        <td>8</td>
                                                        <td>16</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Esiliiga MD</a></td>
                                                        <td>15</td>
                                                        <td>30</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Esiliiga WD</a></td>
                                                        <td>13</td>
                                                        <td>26</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Esiliiga XD</a></td>
                                                        <td>5</td>
                                                        <td>10</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga MD</a></td>
                                                        <td>5</td>
                                                        <td>10</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga WD</a></td>
                                                        <td>6</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga XD</a></td>
                                                        <td>5</td>
                                                        <td>10</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-subgroups" role="tabpanel" aria-labelledby="nav-subgroups-tab">
                        <div class="row" id="customRow">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="table-responsive-sm">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Liiga</th>
                                                        <th>Alagrupp</th>
                                                        <th>Paare alagrupis</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga MD - A
                                                                alagrupp</a></td>
                                                        <td>A</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga MD - B
                                                                alagrupp</a></td>
                                                        <td>B</td>
                                                        <td>4</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - A
                                                                alagrupp</a></td>
                                                        <td>A</td>
                                                        <td>3</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - B
                                                                alagrupp</a></td>
                                                        <td>B</td>
                                                        <td>3</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - C
                                                                alagrupp</a></td>
                                                        <td>C</td>
                                                        <td>3</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">Esiliiga XD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>10</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga MD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>10</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga WD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>12</td>
                                                    </tr>
                                                    <tr>
                                                        <td><a class="text-grey" href="">2.liiga XD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>10</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-queue" role="tabpanel" aria-labelledby="nav-queue-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th class="width">Järjekord</th>
                                                        <th>Liiga</th>
                                                        <th>Alagrupp</th>
                                                        <th>Mängijad</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="width">1</td>
                                                        <td><a class="text-grey" href="">Meistriliiga MD - A
                                                                alagrupp</a></td>
                                                        <td>A</td>
                                                        <td>Jüri Kask<br>
                                                            Koit Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">2</td>
                                                        <td><a class="text-grey" href="">Meistriliiga MD - B
                                                                alagrupp</a></td>
                                                        <td>B</td>
                                                        <td>Jüri Kask<br>
                                                            Koit Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">3</td>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - A
                                                                alagrupp</a></td>
                                                        <td>A</td>
                                                        <td>Marta Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">4</td>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - B
                                                                alagrupp</a></td>
                                                        <td>B</td>
                                                        <td>Marta Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">5</td>
                                                        <td><a class="text-grey" href="">Meistriliiga WD - C
                                                                alagrupp</a></td>
                                                        <td>C</td>
                                                        <td>Marta Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">5</td>
                                                        <td><a class="text-grey" href="">Esiliiga XD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>Jüri Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">6</td>
                                                        <td><a class="text-grey" href="">2.liiga MD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>Jüri Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">7</td>
                                                        <td><a class="text-grey" href="">2.liiga WD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>Marta Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="width">8</td>
                                                        <td><a class="text-grey" href="">2.liiga XD - A alagrupp</a>
                                                        </td>
                                                        <td>A</td>
                                                        <td>Jüri Kask<br>
                                                            Laura Kuusk
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-results" role="tabpanel" aria-labelledby="nav-results-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="container">
                                            tulemused

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- registreeru võistlusele Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Registreeru võistlusele Jõgeva Sügis 2018</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Naispaar või meespaar?</label>
                                <div class="col-sm-8">
                                    <select class="custom-select form-control">
                                        <option selected>Vali</option>
                                        <option value="1">Naispaar</option>
                                        <option value="2">Meespaar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Vali liiga</label>
                                <div class="col-sm-8">
                                    <select class="custom-select form-control">
                                        <option selected>Vali</option>
                                        <option value="1">Esiliiga</option>
                                        <option value="2">2.liiga</option>
                                        <option value="2">3.liiga</option>
                                        <option value="2">4.liiga</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="competition-name" class="col-sm-4 col-form-label">1. mängija nimi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="contest-name"
                                           placeholder="Sisesta mängija nimi" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="competition-name" class="col-sm-4 col-form-label">2. mängija nimi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="competition-name"
                                           placeholder="Sisesta mängija nimi" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="competition-name" class="col-sm-4 col-form-label">1. mängija
                                    meiliaadress</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="competition-name"
                                           placeholder="Sisesta meiliaadress" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="competition-name" class="col-sm-4 col-form-label">2. mängija
                                    meiliaadress</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="competition-name"
                                           placeholder="Sisesta meiliaadress" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-add" value="Registreeru">
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div><!-- end modal body -->
            </div>
        </div>
    </div> <!-- end modal -->

    <?php include('footer.php'); ?>
</div>

</body>
</html>
