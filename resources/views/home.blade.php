@php
    $acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
@endphp
@extends('layouts.app')
@if(\Illuminate\Support\Facades\Auth::user()->id!=1)
@section('content')
    @php
        setlocale(LC_TIME, 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    @if($acesso->entrada_saida ==1)
                    <h2>Resumo Financeiro <small></small></h2>
                    @else
                        <h2>Bem vindo ao Sistema!</h2>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        @if($acesso->entrada_saida ==1)
                        <canvas id="myChart"></canvas>
                        <script>
                            //line
                            var ctxL = document.getElementById("myChart").getContext('2d');
                            var myLineChart = new Chart(ctxL, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo \App\Http\Controllers\CashDeskController::pegarUltimasDatas()?>],
                                    datasets: [{
                                        label: "Dinheiro",
                                        data: [<?php echo \App\Http\Controllers\CashDeskController::pegarUltimasVendasDinheiro()?>],
                                        backgroundColor: [
                                            'rgba(195, 17, 17, .1)',
                                        ],
                                        borderColor: [
                                            'rgba(195, 17, 17, 1)',
                                        ],
                                        borderWidth: 3
                                    },
                                        {
                                            label: "Cartão",
                                            data: [<?php echo \App\Http\Controllers\CashDeskController::pegarUltimasVendasCartao()?>],
                                            backgroundColor: [
                                                'rgba(25, 11, 121, .1)',
                                            ],
                                            borderColor: [
                                                'rgba(25, 11, 121, 1)',
                                            ],
                                            borderWidth: 3
                                        },

                                        {
                                            label: "Crediário",
                                            data: [<?php echo \App\Http\Controllers\CashDeskController::pegarUltimasVendasCrediario()?>],
                                            backgroundColor: [
                                                'rgba(39, 152, 17, .1)',
                                            ],
                                            borderColor: [
                                                'rgba(39, 152, 17, 1)',
                                            ],
                                            borderWidth: 3
                                        }
                                    ]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            stacked: true
                                        }]
                                    },
                                    responsive: true

                                }
                            });
                        </script>
                            @else

                            <h1>Olá <strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong></h1>
                        @endif
                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        @if($acesso->contas_pagar ==1)
                        <div>
                            <div class="x_title">
                                <h2>Próximas Contas a Pagar</h2>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">

                                @foreach(\App\BillsModel::orderBy('venc_date','asc')->where('type',1)->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->where('status', 0)->take(3)->get() as $dado)
                                    <li class="media event">
                                    <div class="media-body">
                                        <a class="title" href="{{route('bills.index','pay')}}">{{$dado->description}}</a>
                                        <p><strong>Valor: </strong> R$ {{$dado->value}} </p>
                                        <p> <small>Date de Vencimento:
                                                @php
                                                    $date = $dado->venc_date;
                                                    echo strftime("%d de %B", strtotime($date));
                                                @endphp</small>
                                        </p>
                                        <div style="width: 100%" align="right"><a href="{{route('bills.pay',$dado->id)}}"><span class="label label-danger" style="margin: 5px">Pagar</span></a></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{route('bills.index','pay')}}" class="btn btn-default" style="width: 100%">Ver Todas as Contas</a>
                        </div>
                            @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Vendas em Aberto
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
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
                        @foreach(\App\SalesModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->where('status', 0) as $client)
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
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@else
    @section('content')
        <script language= "JavaScript">
            location.href="{{route('company.index')}}"
        </script>
    @endsection
@endif
