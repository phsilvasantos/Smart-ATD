@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Movimento de Caixa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('inout.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Movimentação</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Data/Hora</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Valor R$</th>
                            <th>Usuário</th>
                            <th>Caixa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $inout)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($inout->created_at)->format('ymd')}}</td>
                            <td>{{\Carbon\Carbon::parse($inout->created_at)->format('d/m/y - H:i')}}</td>
                            <td>
                                @if(str_replace(',','.',str_replace('.','',$inout->value))>=0)
                                    <span class="label label-success"> + Entrada </span>
                                @else
                                    <span class="label label-danger"> - Saída </span>
                                @endif
                            </td>
                            <td>{{$inout->description}}</td>
                            <td>
                                R$ {{$inout->value}}
                            </td>
                            <td>
                                @foreach(\App\User::all()->where('id',$inout->user_id) as $vend)
                                    {{$vend->name}}
                                @endforeach
                            </td>
                            <td align="center">
                                <a href="{{route('movements.index',$inout->cash_desk_id)}}"><i class="fa fa-search"></i></a>
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
