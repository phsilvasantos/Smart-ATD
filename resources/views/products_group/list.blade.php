@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grupos de Produtos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.products_groups')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Grupos"></i></a>
                        <a href="{{route('products_group.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Grupo</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Descrição</th>
                            <th>Quantidade de Ítens</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->description}}</td>
                            <td>
                                @php
                                    $qtd=0;
                                    foreach(\App\ProductsModel::all()->where('product_group_id', $client->id) as $group){
                                    $qtd=$qtd+1;
                                    }
                                    echo $qtd;
                                @endphp
                            </td>
                            <td style="font-size: 15px" align="center">
                                <a href="{{route('products_group.edit', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Editar">
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
