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

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Hästi!</strong> Võistlus on kustutatud.
            </div>
            <!-- end page title end breadcrumb -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            @if($competitions->count() < 1)
                                <span>Võistlusi pole</span>
                            @else
                                @foreach ($competitions as $competition)
                                    <div class="container">
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
                                                    <li>Mänguliigid:</li>
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
                                                        <button type="button" class="btn btn-add btn-block btn-width"
                                                                data-toggle="modal" data-target=".register-modal">
                                                            Registreeru
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container -->

        <!-- registreeru võistlusele Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Registreeru võistlusele Jõgeva Sügis
                            2018</h5>
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
                                    <label for="competition-name" class="col-sm-4 col-form-label">1. mängija
                                        nimi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="contest-name"
                                               placeholder="Sisesta mängija nimi" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="competition-name" class="col-sm-4 col-form-label">2. mängija
                                        nimi</label>
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