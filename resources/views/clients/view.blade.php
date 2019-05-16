@extends('layouts.app')
@if($clientEdit->company_id != \Illuminate\Support\Facades\Auth::user()->company_id)
    <script language= "JavaScript">
        location.href="{{route('home')}}"
    </script>
@endif
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Dados do Cliente</h2>
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

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" placeholder="Nome Completo" value="{{$clientEdit->name}}" disabled>
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="type" placeholder="Tipo" disabled>
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
                                <input type="text" class="form-control has-feedback-left" name="cpf" id="inputSuccess2" placeholder="CPF / CNPJ" value="{{$clientEdit->cpf}}" disabled>
                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="rg" id="inputSuccess2" placeholder="RG / Inscrição Estadual" value="{{$clientEdit->rg}}" disabled>
                                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="date" class="form-control has-feedback-left" name="nasc_date" id="inputSuccess2" placeholder="Data de Nascimento" value="{{$clientEdit->nasc_date}}" disabled>
                                    <span class="fa fa-birthday-cake form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="phone" id="inputSuccess2" placeholder="Telefone Fixo" value="{{$clientEdit->phone}}" disabled>
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="cell_phone" id="inputSuccess2" placeholder="Celular" value="{{$clientEdit->cell_phone}}" disabled>
                                    <span class="fa fa-mobile-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="email" id="inputSuccess2" placeholder="Email" value="{{$clientEdit->email}}" disabled>
                                    <span class="form-control-feedback left" aria-hidden="true">@</span>
                                </div>

                                    <div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="address" id="inputSuccess2" placeholder="Rua" value="{{$clientEdit->address}}" disabled>
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="number_address" id="inputSuccess2" placeholder="Número" value="{{$clientEdit->number_address}}" disabled>
                                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="bairro" id="inputSuccess2" placeholder="Bairro" value="{{$clientEdit->bairro}}" disabled>
                                        <span class="fa fa-plus form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="city" id="inputSuccess2" placeholder="Cidade" value="{{$clientEdit->city}}" disabled>
                                        <span class="fa fa-resistance form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cep" id="inputSuccess2" placeholder="CEP" value="{{$clientEdit->cep}}" disabled>
                                        <span class="form-control-feedback left" aria-hidden="true">CEP</span>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left"  name="rf_point" id="inputSuccess2" placeholder="Ponto de Referência" value="{{$clientEdit->rf_point}}" disabled>
                                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                                    </div>


                                    <input type="hidden" class="form-control has-feedback-left"  name="status" id="inputSuccess2" placeholder="Status" value="{{$clientEdit->status}}" value="1">

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <h6>Referências Comerciais</h6>
                                        <textarea class="form-control" name="description" placeholder="Insira as referências comerciais do cliente..." disabled>{{$clientEdit->description}}</textarea>
                                    </div>

                            <div style="width: 100%; padding: 5px" align="right">
                                <a href="{{route('clients.edit', $clientEdit->id)}}" class="btn btn-dark">Editar Cliente</a>
                            </div>
                    </div>
                </div>
                <div class="x_content">
                    <h3>Compras Realizadas pelo Cliente</h3>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Data</th>
                            <th>Vendedor</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\SalesModel::all()->where('client_id', $clientEdit->id) as $client)
                            @if($client->status==1)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($client->updated_at)->format('ymd')}}{{$client->id}}</td>
                                    <td>{{\Carbon\Carbon::parse($client->updated_at)->format('d/m/y - H:i')}}</td>
                                    <td>
                                        @foreach(\App\User::all()->where('id',$client->user_id) as $dado)
                                            {{$dado->name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($client->payment_type==0)
                                            Dinheiro
                                        @endif
                                        @if($client->payment_type==1)
                                            Crediário
                                        @endif
                                        @if($client->payment_type==2)
                                            Cartão de Débito
                                        @endif
                                        @if($client->payment_type==3)
                                            Cartão de Crédito
                                        @endif
                                        @if($client->payment_type==4)
                                            Boleto
                                        @endif
                                    </td>
                                    <td>
                                        R$ {{number_format(((str_replace(',','.',str_replace('.','',$client->final_value)))-((str_replace(',','.',str_replace('.','',$client->final_value)))*($client->discount / 100))),2,',','.')}}
                                    </td>
                                    <td>
                                        <span class="label label-success">Concluída</span>
                                    </td>
                                    <td style="font-size: 15px" align="center">
                                        <a href="{{route('sales.view', $client->id)}}"  data-toggle="tooltip" data-placement="top" title="Detalhes da Venda">
                                            <i class="fa fa-search"  data-toggle="tooltip" data-placement="top" title="Exibir dados  da Venda"></i> &nbsp;&nbsp;
                                        </a>
                                        <a href="{{route('reports.sale', $client->id)}}" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Venda">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        @if($client->payment_type==1)
                                            <a target="_blank" style="margin-left: 10px" href="{{route('sales.carne', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Gerar Carnê de Pagamento">
                                                <i class="fa fa-list-alt"></i> &nbsp;&nbsp;
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="x_content" align="right">
                    <a style="margin-left: 10px" href="{{route('debit.view', $clientEdit->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Gerar Carnê de Pagamento">
                        Ver Débitos/Pagamentos do Cliente
                    </a>
                </div>
            </div>

            @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
                @if($empresa->service==1)
                    <div class="card">
                        @if(\App\ExamEyeModel::all()->where('client_id', $clientEdit->id)->count() > 0)
                            <div class="card-title">
                                <h2>Exames</h2>
                            </div>
                            @foreach(\App\ExamEyeModel::all()->where('client_id', $clientEdit->id) as $exam)

                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <strong>Data de Cadastro de Exame: &nbsp;</strong>{{\Carbon\Carbon::parse($exam->created_at)->format('d-m-Y')}}
                                            <p style="margin: 0"><strong>Diabetes?</strong> {{$exam->diabetes}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hipertensão?</strong> {{$exam->hipertensao}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Grávida?</strong> {{$exam->gravida}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Usa Óculos?</strong> {{$exam->oculos}}</p>
        <p style="margin: 0"><strong>Pio</strong> OD: {{$exam->pio_od}} &nbsp;&nbsp;&nbsp; OE: {{$exam->pio_oe}}</p>
        <p style="margin: 0"><strong>Observação:</strong> {{$exam->obs}}</p>
                                            <tr>
                                                <th></th>
                                                <th>Esférico</th>
                                                <th>Cilíndrico</th>
                                                <th>Eixo</th>
                                                <th>DNP</th>
                                                <th>Altura</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>OD</td>
                                                <td>{{$exam->esf_od}}</td>
                                                <td>{{$exam->cil_od}}</td>
                                                <td>{{$exam->eix_od}}</td>
                                                <td>{{$exam->dnp_od}}</td>
                                                <td>{{$exam->alt_od}}</td>
                                            </tr>
                                            <tr>
                                                <td>OE</td>
                                                <td>{{$exam->esf_oe}}</td>
                                                <td>{{$exam->cil_oe}}</td>
                                                <td>{{$exam->eix_oe}}</td>
                                                <td>{{$exam->dnp_oe}}</td>
                                                <td>{{$exam->alt_oe}}</td>
                                            </tr>
                                            <tr>
                                                <td>Adição</td>
                                                <td>{{$exam->adicao}}</td>
                                                <td>Responsável</td>
                                                <td>{{$exam->responsavel}}</td>
                                                <td>Tipo de Lente</td>
                                                <td>{{$exam->tipo_lente}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    @endforeach
                                    @endif
                                @endif
                            @endforeach

        </div>
    </div>

@endsection
