@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('reports.clients')}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Relatório de Clientes"></i></a>
                        <a href="{{route('clients.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Cliente</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Situação</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>
                                @if($client->type == 0)
                                    Pessoa Física
                                @else
                                    Pessoa Jurídica
                                @endif
                            </td>
                            <td>
                                @if($client->status == 1)
                                    Ativo
                                @else
                                    Inativo
                                @endif
                            </td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->cell_phone}}</td>
                            <td style="font-size: 15px" align="center">
                                <a style="margin-right: 10px" href="{{route('reports.client', $client->id)}}" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Ficha do Cliente">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a href="{{route('clients.view', $client->id)}}"  data-toggle="tooltip" data-placement="top" title="Dados do Cliente">
                                    <i class="fa fa-search"></i> &nbsp;&nbsp;
                                </a>
                                <a href="{{route('clients.edit', $client->id)}}" data-toggle="tooltip" data-placement="top" title="Editar">
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
