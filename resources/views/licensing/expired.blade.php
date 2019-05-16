@extends('layouts.app_login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div style="width: 100%; padding: 20px" align="center">
                    </div>
                    <div class="card-header" align="center">
                        <h2 style="margin-bottom: 0px; font-size: 40px"><strong style="color:#941012">ATD</strong> Sistemas</h2>
                        <h5>www.atdsistemas.com.br</h5>
                    </div>
                    <div class="card-body">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" align="center">
                                <h5>SUA LICENÇA DE SOFTWARE VENCEU, ENTRE EM CONTATO COM O ADMINISTRADOR DO SISTEMA</h5>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" align="center">
                                <h6>&nbsp;</h6>
                                <br> <a href="{{route('logout')}}" class="btn btn-dark">Sair do Sistema</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
