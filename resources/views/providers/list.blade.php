@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Fornecedores</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.providers')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Fornecedores"></i></a>
                        <a href="{{route('providers.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Fornecedor</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome / Razão</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Dados Bancários</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->fantasy_name}}/{{$client->social_name}}</td>
                            <td>{{$client->cpf}}</td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->cell_phone}}</td>
                            <td>{{$client->bank_account}}</td>
                            <td style="font-size: 15px" align="center">
                                <a href="{{route('providers.view', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Dados do Fornecedor">
                                    <i class="fa fa-search"></i> &nbsp;&nbsp;
                                </a>
                                <a href="{{route('providers.edit', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fa fa-edit" style="color: darkgoldenrod"></i> &nbsp;&nbsp;
                                </a>
                                <a style="margin-right: 10px" href="{{route('reports.provider', $client->id)}}" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Dados de Fornecedor">
                                    <i class="fa fa-print"></i>
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
