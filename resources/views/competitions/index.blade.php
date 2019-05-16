@extends("master_template")

@section("content")
    <script src="{{ url('js/jquery.min.js') }}"></script>

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                    </div>
                </div>
            </div>

            @if ( session()->has('deleted') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Hästi!</strong> Võistlus on kustutatud.</span>
                </div>

            @elseif ( session()->has('updated') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Hästi!</strong> Võistlus on muudetud.</span>
                </div>

            @elseif ( session()->has('registered') )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Hästi!</strong> Oled registreeritud.</span>
                </div>
        @endif
        <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            @if($competitions->count() < 1)
                                <span>Eesolevaid võistlusi pole.</span>
                            @else
                                @foreach ($competitions as $competition)
                                    <div class="container pt-1 pb-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <img class="myImg"
                                                     src="{{ asset('storage/competition_images/' . $competition->image) }}"
                                                     alt="Võistluse pilt" style="width: 100%; max-width: 250em;">
                                                <div id="image-show-modal" class="modal">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="close-modal">&times;</span>
                                                    </button>
                                                    <img class="modal-content">
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <h5>
                                                    <a class="text-grey-dark"
                                                       href="/competitions/{{ $competition->id }}">
                                                        {{ $competition->title }}
                                                    </a>
                                                </h5>
                                                <ul>
                                                    <li>Koht: {{ $competition->location }}</li>
                                                    <li>Aeg: {{ $competition->datetime }}</li>
                                                    <li>Juhend:<a class="text-grey"
                                                                  href="{{ asset('storage/competition_instructions/' . $competition->instructions) }}">
                                                            {{ $competition->instructions }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="p-1">
                                                    <a class="btn btn-change btn-block text-white btn-width"
                                                       href="/competitions/{{ $competition->id }}">Vaata infot</a>
                                                </div>
                                                @if(Auth::check())
                                                    <div class="p-1">
                                                        <a href="/competitions/{{ $competition->id }}/edit"
                                                           class="btn btn-add btn-block btn-width">
                                                            Muuda
                                                        </a>
                                                    </div>
                                                    <div class="p-1">
                                                        <button type="button"
                                                                class="btn btn-block btn-delete btn-width"
                                                                data-competition_id="{{ $competition->id }}">
                                                            Kustuta
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="p-1">
                                                        @if($now < $competition->registration_starts)
                                                            <p>Registreerimine ei ole veel alanud.</p>
                                                        @elseif($now > $competition->registration_ends)
                                                            <p>Registreerimine on lõppenud.</p>
                                                        @else
                                                            <button type="button"
                                                                    class="btn btn-add btn-block btn-width"
                                                                    data-toggle="modal"
                                                                    data-target="#register-modal-{{ $competition->id }}">
                                                                Registreeru
                                                            </button>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container -->

    @if(!$competitions->count() < 1)
        @foreach($competitions as $competition)
            <!-- registreeru võistlusele Modal -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true" id="register-modal-{{ $competition->id }}">
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
                                                <label for="types" class="col-sm-4 col-form-label">Vali
                                                    mänguliik</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select form-control" id="types" name="type"
                                                            required>
                                                        <option value="" selected>Vali liik</option>

                                                        @foreach ($competition->types as $type)
                                                            <option class="competition-type" value="{{ $type->id }}">
                                                                {{ $type->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="leagues" class="col-sm-4 col-form-label">Vali liiga</label>
                                                <div class="col-sm-8">
                                                    <select class="custom-select form-control" id="leagues" name="league">
                                                        <option selected>Vali</option>

                                                        @foreach($competition->leagues as $league)
                                                            <option class="competition-league"
                                                                    value="{{ $league->id }}">{{ $league->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="first-contestant-name" class="col-sm-4 col-form-label">
                                                    {{ $competition->second_person ? "1. mängija nimi" : "Mängija nimi" }}
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="first-contestant-name"
                                                           placeholder="Sisesta mängija nimi" name="person_1_name"
                                                           required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="first-contestant-email" class="col-sm-4 col-form-label">
                                                    {{ $competition->second_person ? "1. mängija meiliaadress" : "Mängija meiliaadress" }}
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" id="first-contestant-email"
                                                           placeholder="Sisesta meiliaadress" name="person_1_email"
                                                           required>
                                                </div>
                                            </div>

                                            @if(@$competition->second_person)
                                                @include("partials/second_person")
                                            @endif

                                            <div class="modal-footer no-border">
                                                <input type="submit" class="btn btn-add" value="Registreeru">
                                            </div>

                                        </form>

                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div><!-- end modal body -->
                        </div>
                    </div>
                </div> <!-- end modal -->
        @endforeach
    @endif

    <!-- kustuta võistlus modal -->
        <div class="modal fade delete-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header no-border">
                        <h5 class="modal-title text-center pt-5" id="exampleModalLongTitle">Kas sa soovid selle
                            võistluse kustutada?</h5>
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
    </div>

    <script>

        // Get the image and insert it inside the modal
        $(".myImg").on("click", function () {
            var imageSrc = $(this).attr("src");
            var modal = $("#image-show-modal");

            modal.modal("show");
            modal.find("img").attr("src", imageSrc);
        });

        // When delete button next to competition is clicked
        $(".btn-delete").on("click", function () {
            var competition_id = $(".btn-delete").data("competition_id");

            // Give the delete form the correct action attribute
            $("#delete-form").attr("action", "/competitions/" + competition_id);

            // And show modal
            $(".delete-modal").modal("show")
        });
    </script>

@endsection