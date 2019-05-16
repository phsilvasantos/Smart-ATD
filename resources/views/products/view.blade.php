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
                    <h2>Dados do Produto</h2>
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
                        <form action="{{route('products.update', ['clientModel' => $clientEdit->id])}}" method="post">
                            {{csrf_field()}}
                                <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Produto</h6>
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" value="{{$clientEdit->name}}" placeholder="Produto" disabled>
                                </div>

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Referência</h6>
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="code" value="{{$clientEdit->code}}" placeholder="Referência" disabled>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Código de Barras</h6>
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="barcode" value="{{$clientEdit->barcode}}" placeholder="Código de Barras" disabled>
                            </div>

                            <div class="col-md-3 col-sm-5 col-xs-11 form-group has-feedback">
                                <h6>Selecione outro grupo...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="product_group_id" disabled>
                                    <option value="{{$clientEdit->product_group_id}}">
                                        @foreach(\App\ProductsGroupModel::all()->where('id',$clientEdit->product_group_id) as $dado)
                                            {{$dado->name}}
                                        @endforeach
                                    </option>

                                    @foreach(\App\ProductsGroupModel::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('products_group.new')}}" class="btn btn-dark">+</a>
                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-11 form-group has-feedback">
                                <h6>Selecione outro fornecedor...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name=provider_id disabled>
                                    <option value="{{$clientEdit->provider_id}}">
                                        @foreach(\App\ProvidersModel::all()->where('id',$clientEdit->provider_id) as $dado)
                                            {{$dado->fantasy_name}}
                                        @endforeach
                                    </option>

                                    @foreach(\App\ProvidersModel::all() as $user)
                                        <option value="{{$user->id}}">{{$user->fantasy_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('providers.new')}}" class="btn btn-dark">+</a>
                            </div>

                                <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Emite NF-e?...</h6>
                                    <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nfe" disabled>
                                        @if($clientEdit->nfe == 0)
                                            <option value="0">Não</option>
                                            @else
                                            <option value="1">Sim</option>
                                            @endif
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>


                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Preço de Custo (R$)</h6>
                                <input type="text" class="form-control has-feedback-left" name="cost_value" id="valor_custo" placeholder="Custo R$" onKeyPress="return(moeda(this,'.',',',event));" value="{{$clientEdit->cost_value}}" onkeyup="margem();" disabled>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Impostos (%)</h6>
                                <input type="text" class="form-control has-feedback-left" name="taxes" id="imposto" placeholder="Impostos %" onkeyup="margem();" value="{{$clientEdit->taxes}}" disabled>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Margem de Lucro (%)</h6>
                                <input id="lucro" type="text" class="form-control has-feedback-left" placeholder="Lucro %" name="margin" onkeyup="margem();" value="{{$clientEdit->margin}}" disabled>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Preço de Venda (R$)</h6>
                                <input id="valor_venda" type="text" class="form-control has-feedback-left" name="sale_value" placeholder="Venda R$" onKeyPress="return(moeda(this,'.',',',event))" value="{{$clientEdit->sale_value}}" onkeyup="margem_percent();" disabled>
                            </div>


                            <div style="width: 100%; padding: 5px" align="right">
                                <a class="btn btn-dark" href="{{route('products.edit', $clientEdit->id)}}">
                                    Editar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="x_content">
                    <h3>Vendas do Produto</h3>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach(\App\ProductsSalesModel::all()->where('product_id', $clientEdit->id) as $client2)
                        @foreach(\App\SalesModel::all()->where('id', $client2->sale_id) as $client)
                            @if($client->status==1)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($client->updated_at)->format('ymd')}}{{$client->id}}</td>
                                    <td>{{\Carbon\Carbon::parse($client->updated_at)->format('d/m/y - H:i')}}</td>
                                    <td>
                                        @foreach(\App\ClientsModel::all()->where('id',$client->client_id) as $dado)
                                            {{$dado->name}}
                                        @endforeach
                                    </td>
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
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
