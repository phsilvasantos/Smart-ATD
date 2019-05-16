@extends('layouts.app')
@php
    $acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
@endphp
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vendas
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.sales')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Vendas"></i></a>
                        <a href="{{route('sales.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Venda</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            @if($client->status==0)
                                @if($client->user_id==\Illuminate\Support\Facades\Auth::user()->id || $acesso->visualizar_venda ==1)
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
                                        <span class="label label-danger">Em Aberto</span>
                                </td>
                                <td style="font-size: 15px" align="center">
                                        <a href="{{route('products_sales.new', $client->id)}}"  data-toggle="tooltip" data-placement="top" title="Detalhes da Venda">
                                            <i class="fa fa-edit" style="color: darkgoldenrod"></i> &nbsp;&nbsp;
                                        </a>
                                        <a href="{{route('sales.remove', $client->id)}}"  data-toggle="tooltip" data-placement="top" title="Excluir">
                                            <i class="fa fa-remove" style="color: darkred"></i>
                                        </a>
                                </td>
                            </tr>
                            @endif
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                    </div>
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
                        @foreach($clients as $client)
                            @if($client->status==1)
                                @if($client->user_id==\Illuminate\Support\Facades\Auth::user()->id || $acesso->visualizar_venda ==1)
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
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
