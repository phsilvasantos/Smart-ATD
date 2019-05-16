@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Produtos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.products')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Produtos"></i></a>
                        <a href="{{route('products.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Produto</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Preço Custo</th>
                            <th>Preço Venda</th>
                            <th>Estoque</th>
                            <th>Grupo</th>
                            <th>Código de Barras</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->code}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->cost_value}}</td>
                            <td>{{$client->sale_value}}</td>
                            <td align="center" style="font-size: 14px">
                                @php
                                    $qtdfinal = 0;
                                    $vendidos = 0;
                                @endphp
                                @foreach(\App\ProductsPurchasesModel::all()->where('product_id',$client->id) as $compras)
                                    @foreach(\App\PurchasesModel::all()->where('id',$compras->purchase_id) as $ss)
                                        @if($ss->status==1)
                                            @php($qtdfinal = $qtdfinal + $compras->qtd)
                                        @endif
                                    @endforeach
                                @endforeach
                                @foreach(\App\ProductsSalesModel::all()->where('product_id',$client->id) as $vendas)
                                    @foreach(\App\SalesModel::all()->where('id',$vendas->sale_id) as $ss)
                                        @if($ss->status==1)
                                            @php($vendidos = $vendidos + $vendas->qtd)
                                        @endif
                                    @endforeach
                                @endforeach
                                @php($qtdfinal = $qtdfinal-$vendidos)
                                @if($qtdfinal>=0)
                                    {{$qtdfinal}}
                                @else
                                    <span style="color: red">{{$qtdfinal}}</span>
                                @endif
                            </td>
                            <td>
                                @foreach(\App\ProductsGroupModel::all()->where('id',$client->product_group_id) as $dado)
                                    {{$dado->name}}
                                @endforeach
                            </td>
                            <td>{{$client->barcode}}</td>
                            <td style="font-size: 15px" align="center">
                                <a href="{{route('products.view', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Dados do Produto">
                                    <i class="fa fa-search"></i> &nbsp;&nbsp;
                                </a>
                                <a href="{{route('products.edit', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fa fa-edit" style="color: darkgoldenrod"></i> &nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
