@extends('master_template')

@section('content')
    <div class="container" style="margin-top: 200px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="text-muted text-center font-18 mb-4 mt-4"><b>Logi sisse</b></h4>
                    <div class="p-3">


                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <div class="form-group row">

                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">Meiliaadress</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">Parool</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' invalid ' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">Pea mind meeles</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center mt-4 mb-3">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Logi sisse</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
