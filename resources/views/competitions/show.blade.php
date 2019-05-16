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
                                <li class="breadcrumb-item text-grey-light"><i
                                            class="ti-location-pin pr-1"></i>{{ $competition->location }}</li>
                                <li class="breadcrumb-item text-grey-light"><i
                                            class="ti-time pr-1"></i>{{ date('H:i', $datetime) }}</li>
                            </ol>
                        </div>
                        <h6 class="page-title">{{ $competition->title }}</h6>
                    </div>
                </div>
            </div>

            <!-- Page-Title -->
            <div class="row mb-5" id="changeRow">
                <div class="col-sm-12 mb-2">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info"
                               role="tab" aria-controls="nav-info" aria-selected="true">Info</a>

                            @if(Auth::check())
                                <a class="nav-item nav-link" id="nav-new-participants-tab" data-toggle="tab"
                                   href="#nav-new-participants" role="tab" aria-controls="nav-new-participants"
                                   aria-selected="false">Kinnitamata</a>
                            @endif

                            <a class="nav-item nav-link" id="nav-participants-tab" data-toggle="tab"
                               href="#nav-participants" role="tab" aria-controls="nav-participants"
                               aria-selected="false">Osalejad</a>
                            <a class="nav-item nav-link" id="nav-subgroups-tab" data-toggle="tab" href="#nav-subgroups"
                               role="tab" aria-controls="nav-subgroups" aria-selected="false">Alagrupid</a>
                            <a class="nav-item nav-link" id="nav-queue-tab" data-toggle="tab" href="#nav-queue"
                               role="tab"
                               aria-controls="nav-queue" aria-selected="false">Järjekord</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-info" role="tabpanel"
                             aria-labelledby="nav-info-tab">
                            <div class="row" id="customRow">
                                <div class="col-md-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="container">

                                                @if ( session()->has('registered') )
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                         role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <span><strong>Hästi!</strong> Oled registreeritud.</span>
                                                    </div>
                                                @endif

                                                <div class="container">
                                                    <div class="row justify-content-start text-center">
                                                        <div class="col-12">
                                                            <h3>
                                                                {{ $competition->title }}
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Võistluse kuupäev:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">{{ date('d.m.Y', $datetime) }}</p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 text-left">
                                                        <p class="text-black-strong">Võistluse algus:</p>
                                                    </div>
                                                    <div class="col-md-3 text-left">
                                                        <p class="text-black-light">{{ date('H:i', $datetime) }}</p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Võistluse toimumise koht:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">{{ $competition->location }}</p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Mänguliigid:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">
                                                            @foreach ($types as $type){{ $loop->first ? '' : ', ' }}{{ $type->name }}@endforeach
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Liigad:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">
                                                            @foreach ($leagues as $league){{ $loop->first ? '' : ', ' }}{{ $league->name }}@endforeach
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Võistluse juhend:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">
                                                            <a class="text-grey"
                                                               href="{{ asset('storage/competition_instructions/' . $competition->instructions) }}">
                                                                {{ $competition->instructions }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        <p class="text-black-strong">Registreerimine:</p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <p class="text-black-light">{{ date('d.m.Y',$registration_starts) }}
                                                            - {{ date('d.m.Y',$registration_ends) }}</p>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    @if($now < $registration_starts)
                                                        <p>Registreerimine ei ole veel alanud.</p>
                                                    @elseif($now > $registration_ends)
                                                        <p>Registreerimine on lõppenud.</p>
                                                    @else
                                                        <button type="button" class="btn btn-add" data-toggle="modal"
                                                                data-target=".bd-example-modal-lg" id="register-btn">
                                                            Registreeru
                                                        </button>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- KINNITAMATA -->
                        @if(Auth::check())
                            <div class="tab-pane fade" id="nav-new-participants" role="tabpanel"
                                 aria-labelledby="nav-new-participants-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="table-responsive-sm">

                                                        @if ( session()->has('confirmed') )
                                                        <div class="alert alert-success alert-dismissible fade show"
                                                             role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <span><strong>Hästi!</strong> Valitud tiimid on kinnitatud.</span>
                                                        </div>
                                                        @endif

                                                        @if($second_person)
                                                            @include('partials/doubles_confirm_table')
                                                        @else
                                                            @include('partials/singles_confirm_table')
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif


                    <!-- OSALEJAD -->
                        <div class="tab-pane fade" id="nav-participants" role="tabpanel"
                             aria-labelledby="nav-participants-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="table-responsive-sm">
                                                    @if($second_person)
                                                        @include('partials/doubles_table')
                                                    @else
                                                        @include('partials/singles_table')
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- ALAGRUPID -->
                        <div class="tab-pane fade" id="nav-subgroups" role="tabpanel"
                             aria-labelledby="nav-subgroups-tab">
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
                                                            <td><a class="text-grey" href="">Esiliiga XD - A
                                                                    alagrupp</a>
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

                        <!-- JÄRJEKORD -->
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
                                                            <td><a class="text-grey" href="">Esiliiga XD - A
                                                                    alagrupp</a>
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
             aria-hidden="true" id="register-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Registreeru võistlusele {{ $competition->title }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">

                                <form method="post" action="/competitions/{{ $competition->id }}/register">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="types" class="col-sm-4 col-form-label">Vali mänguliik</label>
                                        <div class="col-sm-8">
                                            <select class="custom-select form-control" id="types" name="type">
                                                <option value="" selected>Vali</option>

                                                @foreach ($types as $type)
                                                    <option class="competition-type"
                                                            value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="leagues" class="col-sm-4 col-form-label">Vali liiga</label>
                                        <div class="col-sm-8">
                                            <select class="custom-select form-control" id="leagues">
                                                <option selected>Vali</option>

                                                @foreach($leagues as $league)
                                                    <option class="competition-league"
                                                            value="{{ $league->id }}">{{ $league->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="first-contestant-name" class="col-sm-4 col-form-label">
                                            {{ $second_person ? "1. mängija nimi" : "Mängija nimi" }}
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="first-contestant-name"
                                                   placeholder="Sisesta mängija nimi" name="person_1_name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="first-contestant-email" class="col-sm-4 col-form-label">
                                            {{ $second_person ? "1. mängija meiliaadress" : "Mängija meiliaadress" }}
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="first-contestant-email"
                                                   placeholder="Sisesta meiliaadress" name="person_1_email">
                                        </div>
                                    </div>

                                    @if($second_person)
                                        @include("partials/second_person")
                                    @endif

                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-add" value="Registreeru">
                                    </div>

                                </form>

                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div><!-- end modal body -->
                </div>
            </div>
        </div> <!-- end modal -->
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

    <script>
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = localStorage.getItem('activeTab');

            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>

@endsection