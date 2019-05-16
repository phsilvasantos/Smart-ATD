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
                <div style="width: 100%" align="right">
                    <a style="margin-right: 10px" href="{{route('reports.provider', $clientEdit ->id)}}" class="btn btn-default" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Dados de Fornecedor">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <div class="x_title">
                    <h2>Dados do Fornecedor</h2>
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
                        <form action="{{route('providers.update', ['clientModel' => $clientEdit->id])}}" method="post">
                            {{csrf_field()}}
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="fantasy_name" value="{{$clientEdit->fantasy_name}}" placeholder="Nome Fantasia" disabled>
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="social_name" value="{{$clientEdit->social_name}}" placeholder="Rasão Social" disabled>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
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
                                <input type="text" class="form-control has-feedback-left" name="cpf" id="inputSuccess2" value="{{$clientEdit->cpf}}" placeholder="CPF / CNPJ" disabled>
                                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="rg" id="inputSuccess2" value="{{$clientEdit->rg}}" placeholder="RG / Inscrição Estadual" disabled>
                                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="phone" id="inputSuccess2" value="{{$clientEdit->phone}}" placeholder="Telefone Fixo" disabled>
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="cell_phone" id="inputSuccess2" value="{{$clientEdit->cell_phone}}" placeholder="Celular" disabled>
                                    <span class="fa fa-mobile-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="email" id="inputSuccess2" value="{{$clientEdit->email}}" placeholder="Email" disabled>
                                    <span class="form-control-feedback left" aria-hidden="true">@</span>
                                </div>

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="bank_account" id="inputSuccess2" value="{{$clientEdit->bank_account}}" placeholder="Dados Bancários" disabled>
                                <span class="fa fa-bank form-control-feedback left" aria-hidden="true"></span>
                            </div>

                                    <div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="address" id="inputSuccess2" value="{{$clientEdit->address}}" placeholder="Rua" disabled>
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="number_address" id="inputSuccess2" value="{{$clientEdit->number_address}}" placeholder="Número" disabled>
                                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="bairro" id="inputSuccess2" value="{{$clientEdit->bairro}}" placeholder="Bairro" disabled>
                                        <span class="fa fa-plus form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="city" id="inputSuccess2" value="{{$clientEdit->city}}" placeholder="Cidade" disabled>
                                        <span class="fa fa-resistance form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cep" id="inputSuccess2" value="{{$clientEdit->cep}}" placeholder="CEP" disabled>
                                        <span class="form-control-feedback left" aria-hidden="true">CEP</span>
                                    </div>

                                    <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left"  name="rf_point" id="inputSuccess2" value="{{$clientEdit->rf_point}}" placeholder="Ponto de Referência" disabled>
                                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                                    </div>


                                    <input type="hidden" class="form-control has-feedback-left"  name="status" id="inputSuccess2" value="{{$clientEdit->status}}" placeholder="Status" value="1">

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <h6>Referências Comerciais</h6>
                                        <textarea class="form-control" name="description" placeholder="Mais informações..." disabled>{{$clientEdit->description}}</textarea>
                                    </div>

                            <div style="width: 100%; padding: 5px" align="right">
                                <a href="{{route('providers.edit', $clientEdit->id)}}" class="btn btn-success">Editar</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="x_content">
                    <h3>Compras ao Fornecedor</h3>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nota</th>
                            <th>Nº Ítens</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\PurchasesModel::all()->where('provider_id', $clientEdit->id) as $client)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($client->date)->format('d/m/Y')}}</td>
                                <td>{{$client->note_number}}</td>
                                <td>
                                    {{\App\ProductsPurchasesModel::all()->where('purchase_id',$client->id)->count()}}
                                </td>
                                <td>
                                    @if($client->status==0)
                                        <span class="label label-danger">Em Aberto</span>
                                    @else
                                        <span class="label label-success">Concluída</span>
                                    @endif
                                </td>
                                <td style="font-size: 15px" align="center">

                                    @if($client->status==0)
                                        <a href="{{route('products_purchases.new', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i class="fa fa-edit" style="color: darkgoldenrod"></i> &nbsp;&nbsp;
                                        </a>
                                        <a href="{{route('purchases.remove', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Remover">
                                            <i class="fa fa-remove" style="color: darkred"></i>
                                        </a>
                                    @else
                                        <a href="{{route('purchases.view', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Detalhes da Compra">
                                            <i class="fa fa-search"></i> &nbsp;&nbsp;
                                        </a>
                                    @endif


                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="x_content" align="right">
                    <a href="{{route('purchases.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Compra</a>
                </div>
            </div>
        </div>
    </div>

@endsection
