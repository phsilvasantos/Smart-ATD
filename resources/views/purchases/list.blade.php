@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Compras
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.purchases')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Compras"></i></a>
                        <a href="{{route('purchases.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Compra</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Data da Compra</th>
                            <th>Fornecedor</th>
                            <th>Nota</th>
                            <th>Nº Ítens</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($client->date)->format('d/m/Y')}}</td>
                            <td>
                                @foreach(\App\ProvidersModel::all()->where('id',$client->provider_id) as $dado)
                                    {{$dado->fantasy_name}}
                                @endforeach
                            </td>
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
                                <a style="margin-right: 10px" href="{{route('reports.purchase', $client->id)}}" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Compra">
                                    <i class="fa fa-print"></i>
                                </a>
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
            </div>
        </div>
    </div>
@endsection
