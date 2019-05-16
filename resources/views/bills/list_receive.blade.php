@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Contas a Receber</h2>
                    <ul class="nav navbar-right panel_toolbox">
                            <a href="{{route('bills.new')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Nova Conta</a>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Descrição</th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Receber</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $bill)
                            @if($bill->status==0)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($bill->venc_date)->format('ymd')}}</td>
                            <td>{{$bill->description}}</td>
                            <td>{{\Carbon\Carbon::parse($bill->venc_date)->format('d/m/y')}}</td>
                            <td>R$ {{$bill->value}}</td>
                            <td>
                                @if($bill->status==0)
                                    @if($bill->venc_date < date('Y-m-d'))
                                        <span class="label label-danger">Vencido</span>
                                    @endif
                                    @if($bill->venc_date == date('Y-m-d'))
                                        <span class="label label-warning">Vence Hoje</span>
                                    @endif
                                    @if($bill->venc_date > date('Y-m-d'))
                                        <span class="label label-primary">A Receber</span>
                                    @endif
                                    @elseif($bill->status==1)
                                    <span class="label label-success">Recebido</span>
                                    @endif
                            </td>
                            @if($bill->status==0)
                            <td align="center">
                                <a href="{{route('bills.pay',$bill->id)}}"><span class="label label-default">Receber</span></a>
                                <a href="{{route('bills.remove', $bill->id)}}"><span class="label label-danger">Excluir</span></a>
                            </td>
                            @elseif($bill->status==1)
                                <td align="center">
                                    Recebido em {{\Carbon\Carbon::parse($bill->pay_date)->format('d/m/y')}}
                                </td>
                            @endif
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Contas Recebidas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Ref.</th>
                            <th>Descrição</th>
                            <th>Vencimento</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Receber</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $bill)
                            @if($bill->status==1)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($bill->venc_date)->format('ymd')}}</td>
                                    <td>{{$bill->description}}</td>
                                    <td>{{\Carbon\Carbon::parse($bill->venc_date)->format('d/m/y')}}</td>
                                    <td>R$ {{$bill->value}}</td>
                                    <td>
                                        @if($bill->status==0)
                                            @if($bill->venc_date < date('Y-m-d'))
                                                <span class="label label-danger">Vencido</span>
                                            @endif
                                            @if($bill->venc_date == date('Y-m-d'))
                                                <span class="label label-warning">Vence Hoje</span>
                                            @endif
                                            @if($bill->venc_date > date('Y-m-d'))
                                                <span class="label label-primary">A Receber</span>
                                            @endif
                                        @elseif($bill->status==1)
                                            <span class="label label-success">Recebido</span>
                                        @endif
                                    </td>
                                    @if($bill->status==0)
                                        <td align="center">
                                            <a href="{{route('bills.pay',$bill->id)}}"><span class="label label-default">Receber</span></a>
                                            <a href="{{route('bills.remove', $bill->id)}}"><span class="label label-danger">Excluir</span></a>
                                        </td>
                                    @elseif($bill->status==1)
                                        <td align="center">
                                            Recebido em {{\Carbon\Carbon::parse($bill->pay_date)->format('d/m/y')}}
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
