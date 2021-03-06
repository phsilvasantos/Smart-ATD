@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Novo Cliente</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <form action="{{route('clients.update', ['clientModel' => $clientEdit->id])}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" placeholder="Nome Completo" value="{{$clientEdit->name}}" required>
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="type" placeholder="Tipo" required>
                                        @if($clientEdit->type == 0)
                                            <option value="0">Pessoa Física</option>
                                            <option value="1">Pessoa Jurídica</option>
                                        @else
                                            <option value="1">Pessoa Jurídica</option>
                                            <option value="0">Pessoa Física</option>
                                        @endif
                                    </select>
                                    <span class="fa fa-user-plus form-control-feedback left" aria-hidden="true"></span>
                                </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="cpf" id="inputSuccess2" placeholder="CPF / CNPJ" value="{{$clientEdit->cpf}}" required>
                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="rg" id="inputSuccess2" placeholder="RG / Inscrição Estadual" value="{{$clientEdit->rg}}" required>
                                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="date" class="form-control has-feedback-left" name="nasc_date" id="inputSuccess2" placeholder="Data de Nascimento" value="{{$clientEdit->nasc_date}}" required>
                                    <span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="phone" id="inputSuccess2" placeholder="Telefone Fixo" value="{{$clientEdit->phone}}" required>
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="cell_phone" id="inputSuccess2" placeholder="Celular" value="{{$clientEdit->cell_phone}}" required>
                                    <span class="fa fa-mobile-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="email" id="inputSuccess2" placeholder="Email" value="{{$clientEdit->email}}" required>
                                    <span class="form-control-feedback left" aria-hidden="true">@</span>
                                </div>

                                    <div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="address" id="inputSuccess2" placeholder="Rua" value="{{$clientEdit->address}}" required>
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="number_address" id="inputSuccess2" placeholder="Número" value="{{$clientEdit->number_address}}" required>
                                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="bairro" id="inputSuccess2" placeholder="Bairro" value="{{$clientEdit->bairro}}" required>
                                        <span class="fa fa-plus form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="city" id="inputSuccess2" placeholder="Cidade" value="{{$clientEdit->city}}" required>
                                        <span class="fa fa-resistance form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cep" id="inputSuccess2" placeholder="CEP" value="{{$clientEdit->cep}}" required>
                                        <span class="form-control-feedback left" aria-hidden="true">CEP</span>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left"  name="rf_point" id="inputSuccess2" placeholder="Ponto de Referência" value="{{$clientEdit->rf_point}}" required>
                                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                                    </div>


                                    <input type="hidden" class="form-control has-feedback-left"  name="status" id="inputSuccess2" placeholder="Status" value="{{$clientEdit->status}}" value="1">

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <h6>Referências Comerciais</h6>
                                        <textarea class="form-control" name="description" placeholder="Insira as referências comerciais do cliente..." required>{{$clientEdit->description}}</textarea>
                                    </div>

                            <div style="width: 100%; padding: 5px" align="right">
                                <button type="submit" class="btn btn-success">Salvar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
