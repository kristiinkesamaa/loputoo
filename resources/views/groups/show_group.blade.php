@extends("master_template")

@section("content")
    <div class="wrapper" id="page-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group pull-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item text-grey-light"><a href="/competitions">Tagasi osalejate lehele</a></li>
                            </ol>
                        </div>
                        <h6 class="page-title">Jõgeva Kevad</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="container">
                                <div class="table-responsive-sm">

                                    @if ( session()->has('updated') )
                                    @elseif ( session()->has('deleted') )
                                        <div class="alert alert-success alert-dismissible fade show"
                                             role="alert">
                                            <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <span><strong>Hästi!</strong>Osaleja on kustutatud.</span>
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
                                                                    <form action="/competitions/{{ $address }}/{{ $contestant->team_id }}">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <a class="btn btn-change text-white edit"
                                                                           href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit"><i
                                                                                    class="fa fa-pencil-square-o"></i></a>
                                                                        <button class="btn btn-delete"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                    </form>
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
                                                    <th></th>
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
                                                            <a class="btn btn-change"
                                                               href="/competitions/{{ $address }}/{{ $contestant->team_id }}/edit">
                                                                Muuda
                                                            </a>

                                                            <form action="/competitions/{{ $address }}/{{ $contestant->team_id }}"
                                                                  method="post">
                                                                @method('delete')
                                                                @csrf

                                                                <button class="btn btn-delete">Kustuta</button>
                                                            </form>
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
@endsection