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
                                    <a href="/competitions/{{ $competition_id }}">Tagasi alagruppide lehele</a>
                                </li>
                            </ol>
                        </div>
                        <h6 class="page-title">{{ $title }}</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="container">

                                @if($subgroup->number_of_teams === 3)

                                    <h3>{{ $subgroup->title }}</h3>

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
                                            <th scope="row" class="text-center">1</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 1)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="bg-dark dt-height"></td>
                                            <td class="dt-height"></td>
                                            <td class="dt-height"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">2</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 2)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height"></td>
                                            <td class="bg-dark dt-height"></td>
                                            <td class="dt-height"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">3</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 3)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height"></td>
                                            <td class="dt-height"></td>
                                            <td class="bg-dark dt-height"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    @if(Auth::check())
                                        <table class="table table-sm table-bordered subgroup-3">
                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif

                                @elseif($subgroup->number_of_teams === 4)
                                    <h3>{{ $subgroup->title }}</h3>

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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 1)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="bg-dark dt-height-4"></td>
                                            <td class="dt-height"></td>
                                            <td class="dt-height"></td>
                                            <td class="dt-height"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">2</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 2)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height-4"></td>
                                            <td class="bg-dark dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">3</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 3)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                            <td class="bg-dark dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-center">4</th>
                                            <th>
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 4)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                            <td class="dt-height-4"></td>
                                            <td class="bg-dark dt-height-4"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    @if(Auth::check())
                                        <table class="table table-sm table-bordered subgroup-4">
                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif

                                @else
                                    <h3>{{ $subgroup->title }}</h3>

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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 1)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 2)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 3)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 4)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
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
                                                @foreach($subgroup_contestants as $contestant)
                                                    @if($contestant->subgroup_order === 5)
                                                        <p>{{ $contestant->name }}</p>
                                                    @endif
                                                @endforeach
                                            </th>
                                            <td class="dt-height-5"></td>
                                            <td class="dt-height-5"></td>
                                            <td class="dt-height-5"></td>
                                            <td class="dt-height-5"></td>
                                            <td class="bg-dark dt-height-5"></td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    @if(Auth::check())
                                        <table class="table table-sm table-bordered subgroup-5">
                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 5 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 5 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 5 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 3 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 1 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 2 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php $i = 4 ?>
                                                @include('partials/subgroup_td')

                                                <?php $i = 5 ?>
                                                @include('partials/subgroup_td')

                                                <td>
                                                    <button>Lisa</button>
                                                </td>
                                            </tr>
                                        </table>

                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection