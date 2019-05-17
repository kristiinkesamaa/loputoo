@extends("master_template")

@section("content")
    <script src="{{ url('js/jquery.min.js') }}"></script>

    <div class="wrapper" id="page-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="container">
                                <div class="table-responsive">
                                    <form method="post" action="/competitions/{{ $address }}/{{ $team_id }}">
                                        @method('patch')
                                        @csrf

                                        <div class="form-group row">
                                            <label for="types" class="col-sm-4 col-form-label">Vali mänguliik</label>
                                            <div class="col-sm-8">
                                                <select class="custom-select form-control" id="types" name="type" required>
                                                    <option value="" selected>Vali</option>

                                                    @foreach ($competition_types as $type)
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
                                                    <option selected>Vali</option>

                                                    @foreach($competition_leagues as $league)
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
                                                       value="{{ $contestants[0]->name }}" required
                                                       placeholder="Sisesta mängija nimi" name="person_1_name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="first-contestant-email" class="col-sm-4 col-form-label">
                                                {{ $second_person ? "1. mängija meiliaadress" : "Mängija meiliaadress" }}
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="first-contestant-email"
                                                       value="{{ $contestants[0]->email }}" required
                                                       placeholder="Sisesta meiliaadress" name="person_1_email">
                                            </div>
                                        </div>

                                        @if($second_person)
                                            @include("partials/second_person_edit")
                                        @endif

                                        <div class="modal-footer no-border">
                                            <input type="submit" class="btn btn-add" value="Muuda">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Select type
            var type = {{ json_encode($team_type) }};
            $('#types').val(type);

            // Select league
            var league = {{ json_encode($team_league) }};
            $('#leagues').val(league);
        })
    </script>
@endsection