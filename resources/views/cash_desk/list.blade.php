@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Caixa Financeiro</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{route('cash_desk.close')}}" class="btn btn-success">Fechar o Caixa</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Status</th>
                            <th>Aberto em</th>
                            <th>Inicial R$</th>
                            <th>Aberto por</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $caixa)
                            @if($caixa->status==0)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($caixa->created_at)->format('ymd')}}</td>
                                <td>
                                        <span class="label label-success">Aberto</span>
                                </td>
                                <td>{{\Carbon\Carbon::parse($caixa->created_at)->format('d/m/y - H:i')}}</td>
                                <td>
                                    R$ {{$caixa->open_value}}
                                </td>
                                <td>
                                    @foreach(\App\User::all()->where('id',$caixa->open_user_id) as $vend)
                                        {{$vend->name}}
                                    @endforeach
                                </td>
                                <td align="center">
                                    <a href="{{route('movements.index',$caixa->id)}}"><i class="fa fa-search"></i></a>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                    <div class="table-responsive">

                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Status</th>
                            <th>Aberto em</th>
                            <th>Fechado em</th>
                            <th>Inicial R$</th>
                            <th>Final R$</th>
                            <th>Aberto por</th>
                            <th>Fechado por</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $caixa)
                            @if($caixa->status==1)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($caixa->created_at)->format('ymd')}}</td>
                            <td>
                                    <span class="label label-danger">Fechado</span>
                            </td>
                            <td>{{\Carbon\Carbon::parse($caixa->created_at)->format('d/m/y - H:i')}}</td>
                            <td>
                                    {{\Carbon\Carbon::parse($caixa->updated_at)->format('d/m/y - H:i')}}
                            </td>
                            <td>
                                R$ {{$caixa->open_value}}
                            </td>
                            <td>
                                    R$ {{$caixa->close_value}}
                            </td>
                            <td>
                                    @foreach(\App\User::all()->where('id',$caixa->open_user_id) as $vend)
                                        {{$vend->name}}
                                    @endforeach
                            </td>
                            <td>
                                @if($caixa->status==0)
                                    -
                                @else
                                    @foreach(\App\User::all()->where('id',$caixa->close_user_id) as $vend)
                                        {{$vend->name}}
                                    @endforeach
                                @endif
                            </td>

                            <td align="center">
                                <a href="{{route('movements.index',$caixa->id)}}" data-toggle="tooltip" data-placement="top" title="Exibir Caixa"><i class="fa fa-search"></i></a>
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
