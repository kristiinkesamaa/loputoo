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
                                            class="fa fa-map-marker pr-1"></i>{{ $competition->location }}</li>
                                <li class="breadcrumb-item text-grey-light"><i
                                            class="fa fa-clock-o pr-1"></i>{{ date('H:i', $datetime) }}</li>
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

                                                    @if(Auth::check())
                                                        <a class="btn btn-change text-white"
                                                           href="/competitions/{{ $competition->id }}/edit">
                                                            Muuda
                                                        </a>
                                                    @else
                                                        @if($now < $registration_starts)
                                                            <p>Registreerimine ei ole veel alanud.</p>
                                                        @elseif($now > $registration_ends)
                                                            <p>Registreerimine on lõppenud.</p>
                                                        @else
                                                            <button type="button" class="btn btn-add"
                                                                    data-toggle="modal"
                                                                    data-target=".bd-example-modal-lg"
                                                                    id="register-btn">
                                                                Registreeru
                                                            </button>
                                                        @endif
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
                                                    <div class="table-responsive">

                                                        @if (session()->has('confirmed'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                 role="alert">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <span><strong>Hästi!</strong> Valitud võistlejad on kinnitatud.</span>
                                                            </div>
                                                        @elseif (session()->has('deleted'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                 role="alert">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <span><strong>Hästi!</strong> Valitud võistlejad on kustutatud.</span>
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
                                                <div class="table-responsive">
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
                                            @if(session()->has('subgroup_deleted'))
                                                <div class="alert alert-success alert-dismissible fade show"
                                                     role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <span><strong>Hästi!</strong> Alagrupp kustutatud.</span>
                                                </div>
                                            @endif
                                            @if(!empty($subgroups[0]))
                                                <div class="container">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-bordered">
                                                            <thead class="thead-default">
                                                            <tr>
                                                                <th>Liiga</th>
                                                                <th>
                                                                    {{ $second_person ? "Paare alagrupis" : "Mängijaid alagrupis" }}
                                                                </th>
                                                                @if(Auth::check())
                                                                    <th></th>
                                                                @endif
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($subgroups as $subgroup)
                                                                <tr>
                                                                    <td>
                                                                        <a href="/competitions/{{ $competition->id }}/subgroups/{{ $subgroup->id }}"
                                                                           class="text-grey">
                                                                            {{ $subgroup->league_name }} {{ $subgroup->short_name }}
                                                                            - {{ $subgroup->title }}
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ $subgroup->number_of_teams }}</td>
                                                                    @if(Auth::check())
                                                                        <td style="width: 2%;">
                                                                            <button class="btn btn-delete btn-delete-subgroup-modal"
                                                                                    data-subgroup_id="{{ $subgroup->id }}">
                                                                                Kustuta
                                                                            </button>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- JÄRJEKORD -->
                        <div class="tab-pane fade" id="nav-queue" role="tabpanel" aria-labelledby="nav-queue-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body pr-0 pl-0">
                                            @if(!empty($queues[0]))


                                                @if ( session()->has('queue_added') )
                                                    <div class="container-fluid">
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                         role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <span><strong>Hästi!</strong> Mäng järjekorda lisatud.</span>
                                                    </div>
                                                    </div>
                                                @elseif(session()->has('queue_deleted'))
                                                    <div class="container-fluid">
                                                        <div class="alert alert-success alert-dismissible fade show"
                                                             role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <span><strong>Hästi!</strong> Mäng järjekorrast kustutatud.</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if(Auth::check())
                                                    <div class="container-fluid">
                                                        <button class="btn btn-change text-white float-right mb-3"
                                                                type="button" data-toggle="modal"
                                                                data-target="#add-queue-modal">
                                                            <i class="fa fa-plus pr-1"></i>
                                                            Lisa uus mäng järjekorda
                                                        </button>
                                                    </div>
                                                @endif

                                                <div class="table-responsive">
                                                    <table id="datatable-buttons"
                                                           class="table dataTable table-bordered no-footer"
                                                           cellspacing="0" width="100%"
                                                           aria-describedby="datatable-buttons_info">

                                                        <thead class="thead-default">
                                                        <tr role="row">
                                                            <th>Kellaaeg</th>
                                                            <th>Liiga</th>
                                                            <th style="border-right: none;">Mängijad</th>
                                                            @if($second_person)
                                                                <th style="border-right: none;padding-right: 100px;text-align: center;"></th>
                                                                <th></th>
                                                            @endif
                                                            @if(Auth::check())
                                                                <th></th>
                                                            @endif
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1; ?>
                                                        @foreach($queues as $queue)
                                                            <tr>
                                                                <td>{{ $queue->time }}</td>
                                                                <td>
                                                                    {{ $queue->league_name }} {{ $queue->short_name }}
                                                                    - {{ $queue->game_title }}
                                                                </td>
                                                                @if($second_person)
                                                                    <td style="border-right: none;">
                                                                        <table>
                                                                            <tr>
                                                                                <td class="no-border">
                                                                                    {{ $queue->team_1_first_contestant_name }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="no-border">
                                                                                    {{ $queue->team_1_second_contestant_name }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td style="border-right: none;padding-right: 100px;text-align: center;">
                                                                        -
                                                                    </td>
                                                                    <td>
                                                                        <table>
                                                                            <tr>
                                                                                <td class="no-border">
                                                                                    {{ $queue->team_2_first_contestant_name }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="no-border">
                                                                                    {{ $queue->team_2_second_contestant_name }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        {{ $queue->team_1_name }}
                                                                        - {{ $queue->team_2_name }}
                                                                    </td>
                                                                @endif
                                                                @if(Auth::check())
                                                                    <td style="width: 3%;">
                                                                        <button class="btn btn-delete btn-delete-queue-modal"
                                                                                data-queue_id="{{ $queue->queue_id }}">
                                                                            Kustuta
                                                                        </button>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                        <select class="custom-select form-control" id="types" name="type" required>
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
                                        <select class="custom-select form-control" id="leagues" name="league" required>
                                            <option value="" selected>Vali</option>

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
                                               placeholder="Sisesta mängija nimi" autocomplete="off" name="person_1_name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first-contestant-email" class="col-sm-4 col-form-label">
                                        {{ $second_person ? "1. mängija meiliaadress" : "Mängija meiliaadress" }}
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="first-contestant-email"
                                               placeholder="Sisesta meiliaadress" autocomplete="off" name="person_1_email" required>
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


    @if(Auth::check())

        <!-- Kinnitamata mängijate kustutamise modal -->
        <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header no-border">
                        <h5 class="modal-title text-center pt-5" id="exampleModalLongTitle">
                            Kas sa soovid valitud kinnitamata mängijad kustutada?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  pl-5 pr-5 pt-5 pb-5">
                    </div>
                    <div class="modal-footer no-border">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tühista</button>

                        <button type="button" class="btn btn-delete btn-ok" id="btn-confirm-delete">Kustuta</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- uue mängu lisamise modal  -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true" id="add-queue-modal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Lisa uus mäng järjekorda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">


                                <div class="form-group row">
                                    <label for="type" class="col-sm-4 col-form-label">
                                        Mänguliik
                                    </label>
                                    <div class="col-sm-8">
                                        <select class="custom-select form-control" name="type" id="type">
                                            <option value="" selected>Vali mänguliik</option>

                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="league" class="col-sm-4 col-form-label">
                                        Liiga
                                    </label>
                                    <div class="col-sm-8">

                                        <select class="custom-select form-control" name="league" id="league"
                                                required>
                                            <option value="" selected>Vali liiga</option>

                                            @foreach($leagues as $league)
                                                <option value="{{ $league->id }}">
                                                    {{ $league->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div style="display: none" id="team-selects">
                                    <form method="post" action="/competitions/{{ $competition->id }}/queue">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="game-title" class="col-sm-4 col-form-label">Mängu
                                                pealkiri</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="game_title"
                                                       id="game-title" required>

                                            </div>
                                        </div>


                                        @if ($second_person)
                                            <div class="form-group row">
                                                <label for="team_1_id" class="col-sm-4 col-form-label">Vali esimene
                                                    tiim</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select form-control" name="team_1_id"
                                                            id="team_1_id" required>
                                                        <option value="" selected>Vali tiim</option>

                                                        @foreach($contestants as $contestant)
                                                            @if($loop->odd)
                                                                <option value="{{ $contestant->team_id }}"
                                                                        data-type_id="{{ $contestant->type_id }}"
                                                                        data-league_id="{{ $contestant->league_id }}">
                                                                    {{ $contestant->name }} &
                                                                    @else
                                                                        {{ $contestant->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="team_2_id" class="col-sm-4 col-form-label">Vali teine
                                                    tiim</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select form-control" name="team_2_id"
                                                            id="team_2_id" required>
                                                        <option value="" selected>Vali tiim</option>

                                                        @foreach($contestants as $contestant)
                                                            @if($loop->odd)
                                                                <option value="{{ $contestant->team_id }}"
                                                                        data-type_id="{{ $contestant->type_id }}"
                                                                        data-league_id="{{ $contestant->league_id }}">
                                                                    {{ $contestant->name }} &
                                                                    @else
                                                                        {{ $contestant->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <label for="team_1_id">Vali esimene tiim</label>

                                            <select name="team_1_id" id="team_1_id" required>
                                                <option value="" selected>Vali tiim</option>

                                                @foreach($contestants as $contestant)
                                                    <option value="{{ $contestant->team_id }}">
                                                        {{ $contestant->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <label for="team_2_id">Vali teine tiim</label>

                                            <select name="team_2_id" id="team_2_id" required>
                                                <option value="" selected>Vali tiim</option>

                                                @foreach($contestants as $contestant)
                                                    <option value="{{ $contestant->team_id }}">
                                                        {{ $contestant->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                        <div class="modal-footer no-border">
                                            <input type="submit" class="btn btn-add" value="Lisa mäng">
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- end modal body -->
                </div>
            </div>
        </div>

    @endif


    <!-- Alagrupi kustutamise modal -->
    <div class="modal fade delete-subgroup-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header no-border">
                    <h5 class="modal-title text-center pt-5" id="exampleModalLongTitle">
                        Kas sa soovid mängija(d) järjekorrast kustutada?
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

    <script>

        $(".btn-delete-subgroup-modal").on("click", function () {
            var subgroup_id = $(this).data("subgroup_id");
            var competition_id = '{{ $competition->id }}';

            // Give the delete form the correct action attribute
            $("#delete-form").attr("action", "/competitions/" + competition_id + "/subgroup/" + subgroup_id);

            // And show modal
            $(".delete-subgroup-modal").modal("show")
        });

        $(".btn-delete-queue-modal").on("click", function () {
            var queue_id = $(this).data("queue_id");
            var competition_id = '{{ $competition->id }}';

            // Give the delete form the correct action attribute
            $("#delete-form").attr("action", "/competitions/" + competition_id + "/queue/" + queue_id);

            // And show modal
            $(".delete-subgroup-modal").modal("show")
        });

        $(document).ready(function () {

            // Add selected tab to local storage
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = localStorage.getItem('activeTab');

            // When user navigates back to this page, the stored tab is shown
            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }

            // When delete button in competitor delete modal is clicked
            $("#btn-confirm-delete").on('click', function () {

                // Click the button that deletes
                $("#btn-delete-contestants").click()
            })
        });

        var select_values = [0, 0];


        $("#type, #league").on("change", function () {
            var type_value = $("#type").val();
            var league_value = $("#league").val();

            if (type_value !== "" && league_value !== "") {
                $("#team-selects").slideDown();

                $("#team_1_id").children('option').not(':first').show();
                $("#team_2_id").children('option').not(':first').show();

                $("#team_1_id").children('option').not(':first').each(function () {
                    if ($(this).data("type_id") != type_value || $(this).data("league_id") != league_value) {
                        $(this).hide()
                    }
                });

                $("#team_2_id").children('option').not(':first').each(function () {
                    if ($(this).data("type_id") != type_value || $(this).data("league_id") != league_value) {
                        $(this).hide()
                    }
                })

            } else {
                $("#team-selects").slideUp();

            }
        });


        $("#team_1_id").on("change", function () {
            var this_value = $(this).val();

            $('#team_2_id option[value="' + select_values[0] + '"]').show();
            if (this_value !== "") {
                $('#team_2_id option[value="' + this_value + '"]').hide();
            }

            select_values[0] = this_value;
        });

        $("#team_2_id").on("change", function () {
            var this_value = $(this).val();

            $('#team_1_id option[value="' + select_values[1] + '"]').show();
            if (this_value !== "") {
                $('#team_1_id option[value="' + this_value + '"]').hide();
            }

            select_values[1] = this_value;
        });
    </script>

@endsection