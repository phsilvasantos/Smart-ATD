@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Usuários</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('users.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Novo Usuário</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->name}}</td>
                            <td>{{$client->email}}</td>
                            <td>
                                @foreach(\App\ModelUserType::all()->where('id', $client->user_type_id) as $tipo)
                                    {{$tipo->name}}
                                @endforeach
                            </td>
                            <td style="font-size: 15px" align="center">
                                @if(\Illuminate\Support\Facades\Auth::user()->id == $client->id)
                                    <span class="label label-success">Usuário Logado</span>
                                @else
                                    @if($client->email=='-')
                                        Desativado&nbsp;
                                        <a href="{{route('users.enable', $client->id)}}">
                                            <span class="label label-danger">Ativar?</span>
                                        </a>
                                        @else
                                        <a href="{{route('users.disable', $client->id)}}">
                                            <span class="label label-default">Desativar Usuário</span>
                                        </a>
                                        @endif
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
