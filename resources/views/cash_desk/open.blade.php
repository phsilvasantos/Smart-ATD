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
                        @php
                            $acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
                        @endphp
                        @if($acesso->entrada_saida ==1)
                        <form action="{{route('cash_desk.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" align="center">
                                <h6>Seu caixa será aberto com o valor  de <strong style="font-size: 25px; color:#941012 ">R$ {{$client->close_value}}</strong> registrado no ultimo fechamento de caixa!</h6>
                            </div>
                            <input type="hidden" name="open_value" value="{{$client->close_value}}"/>
                            <input type="hidden" name="close_value" value="0,00"/>
                            <input type="hidden" name="open_user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}"/>
                            <input type="hidden" name="close_user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}"/>
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}"/>
                            <input type="hidden" name="status" value="0"/>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" align="center">
                                <h6>&nbsp;</h6>
                                <button type="submit" class="btn btn-success">Confirmar Abertura</button>
                                <br> <a href="{{route('logout')}}" class="btn btn-dark">Sair do Sistema</a>
                            </div>
                        </form>
                            @else
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" align="center">
                                <h6>Caixa está <strong style="font-size: 25px; color:#941012 ">Fechado</strong>, aguarde abertura do caixa!</h6>
                                <br> <a href="{{route('logout')}}" class="btn btn-dark">Sair do Sistema</a>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
