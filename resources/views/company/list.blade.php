@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Empresas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('company.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Empresa</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Razão Social</th>
                            <th>CNPJ</th>
                            <th>Cidade</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            @if($client->id==1)
                                @else
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->razao}}</td>
                            <td>{{$client->cnpj}}</td>
                            <td>{{$client->city}}</td>
                             <td align="center">
                                 <a style="margin: 5px" href="{{route('company.view', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Visualizar"><span class="glyphicon glyphicon-search"></span></a>
                                 <a style="margin: 5px" href="{{route('company.edit', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                 <a style="margin: 5px" href="{{route('users.indexall', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Usuários"><span class="glyphicon glyphicon-user"></span></a>
                                 <a style="margin: 5px" href="{{route('new_user_all', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Novo Usuário"><span class="glyphicon glyphicon-plus"></span></a>
                                 <a style="margin: 5px" href="{{route('groups.index', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Grupos de Usuários"><span class="glyphicon glyphicon-list"></span></a>
                                 <a style="margin: 5px" href="{{route('groups.new', $client->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Novo Grupo de Usuários"><span class="glyphicon glyphicon-plus-sign"></span></a>
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

