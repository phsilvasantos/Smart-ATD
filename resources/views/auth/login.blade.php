@extends('layouts.app_login')
@section('content')
    <script type="text/javascript">
        function login(){
            document.getElementById("logar").innerText = "Carregando...";
            document.getElementById("logar").disabled = "true";
            document.getElementById("form").submit();

        };
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 col-lg-4">
                <div class="card">
                    <div style="width: 100%; padding: 0px; margin-top: -35px; padding: 15px" align="center">
                        {{--<img style="border-radius: 20px" src="{{ asset('assets/img/fundo-min.png') }}" width="100%">--}}
                    </div>
                    <div class="card-header" align="center">
                        <br>
                        <br>
                        <h2 style="margin-bottom: 0px; font-size: 40px">Smart <strong style="color:#941012">ATD</strong></h2>
                        <h5>www.atdsistemas.com.br</h5><br>
                    </div>
                    <br><br>
                    <div class="card-body" style="margin-top: -50px; margin-left: 10px; margin-right: 10px">
                        <form id="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group row">
                                <br>
                                <div class="col-md-12">
                                    <label for="email" style="margin: 0px"><strong>{{ __('Usuário') }}</strong></label>
                                    <input id="email" style="border-radius: 5px; background:rgba(220,225,214,0.97)" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>Erro nas credenciais, tente novamente!</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" style="margin: 0px"><strong>{{ __('Senha') }}</strong></label>
                                    <input id="password" style="border-radius: 5px; background:rgba(220,225,214,0.97)" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                                    <button id="logar" onclick="login()" type="submit" style="width: 100%; background-color: #941012" class="btn btn-danger">
                                        {{ __('ENTRAR') }}
                                    </button>
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
