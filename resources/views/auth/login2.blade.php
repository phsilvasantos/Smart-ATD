@extends('layouts.app_login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="card" style="box-shadow: 7px 7px 10px 4px rgba(0,0,0, 0.4)">
                    <div style="width: 100%; padding: 20px" align="center">
                    </div>
                    <div class="card-header" align="center">
                        <h2 style="margin-bottom: 0px; font-size: 40px">Smart <strong style="color:#941012">ATD</strong></h2>
                        <h5>www.atdsistemas.com.br</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">

                            @csrf
                            <div class="form-group row">
                                <br>
                                <div class="col-md-12">
                                    <label for="email">{{ __('E-Mail') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password">{{ __('Senha') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0" align="right">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-danger" style="background-color: #941012">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="position: absolute; bottom: 10px; right: 10px">
        <h2 style="margin-bottom: 0px; font-size: 15px; color: #ffffff"><strong>ATD</strong> Sistemas</h2>
    </div>
@endsection
