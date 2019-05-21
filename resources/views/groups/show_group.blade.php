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
                                <li class="breadcrumb-item text-grey-light"><a
                                            href="/competitions/{{ $competition_id }}">Tagasi osalejate lehele</a></li>
                            </ol>
                        </div>
                        <h6 class="page-title">Jõgeva Kevad</h6>
                        <h6>{{ Auth::check() ? 'Osalejate info muutmine: ' . $title : $title }}</h6>

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
                                            <span><strong>Hästi!</strong> Tiim on kustutatud.</span>
                                        </div>
                                    @endif

                                    @if(Auth::check())
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

                                                <?php $a = 0 ?>
                                                @foreach($contestants as $contestant)
                                                    @if($a % 2 === 0)
                                                        <tr>
                                                            @endif

                                                            <td>{{ $contestant->name }}</td>
                                                            <td>{{ $contestant->email }}</td>

                                                            @if($a % 2 === 1)
                                                                <td>{{ $contestant->type_name }}</td>
                                                                <td>{{ $contestant->league_name }}</td>
                                                                <td>
                                                                    <a class="btn btn-change text-white edit"
                                                                       href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit">
                                                                        <i class="fa fa-pencil-square-o"></i>
                                                                    </a>
                                                                    <button class="btn btn-delete"
                                                                            data-team_id="{{ $contestant->team_id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                        </tr>
                                                    @endif

                                                    <?php $a++ ?>
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
                                                    <tr>
                                                        <td>{{ $contestant->name }}</td>
                                                        <td>{{ $contestant->email }}</td>
                                                        <td>{{ $contestant->type_name }}</td>
                                                        <td>{{ $contestant->league_name }}</td>
                                                        <td>
                                                            <a class="btn btn-change text-white edit"
                                                               href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                            <button class="btn btn-delete"
                                                                    data-team_id="{{ $contestant->team_id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif
                                        </table>
                                    @else
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Osaleja nimi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contestants as $contestant)
                                                <tr>
                                                    <td>{{ $contestant->name }}</td>
                                                </tr>
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

    <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header no-border">
                    <h5 class="modal-title text-center pt-5" id="exampleModalLongTitle">
                        Kas sa soovid tiimi kustutada?
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
        $(document).ready(function () {

            // When delete button next to competition is clicked
            $(".btn-delete").on("click", function () {
                var team_id = $(".btn-delete").data("team_id");
                var address = '{{ $address }}';

                // Give the delete form the correct action attribute
                $("#delete-form").attr("action", "/competitions/" + address + '/' + team_id);

                // And show modal
                $(".delete-modal").modal("show")
            });
        });
    </script>
@endsection