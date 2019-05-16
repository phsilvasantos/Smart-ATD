@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Débito do Cliente - <strong>{{$client->name}}</strong></h2>
                    <br>
                    <div class="clearfix">
                    </div>
                </div>
                <h5>{{$client->address}}</h5>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Compra</th>
                            <th>Data de Vencimento</th>
                            <th>Vendedor</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\ClientDebitModel::all()->where('client_id', $client->id)->where('status',0) as $debit)
                        <tr>

                            <td>
                                @foreach(\App\SalesModel::all()->where('id',$debit->sale_id) as $dado)
                                    <a href="{{route('sales.view', $dado->id)}}">Venda REF.: {{($dado->created_at)->format('ymd')}}{{$dado->id}}</a>
                                @endforeach
                            </td>
                            <td>{{\Carbon\Carbon::parse($debit->venc_date)->format('d/m/y')}}</td>
                            <td>
                                @foreach(\App\SalesModel::all()->where('id',$debit->sale_id) as $dado)
                                    @foreach(\App\User::all()->where('id',$dado->user_id) as $vend)
                                        {{$vend->name}}
                                    @endforeach
                                @endforeach

                            </td>
                            <td>
                                    @if($debit->venc_date < date('Y-m-d'))
                                    <span class="label label-danger">Vencido</span>
                                    @endif
                                        @if($debit->venc_date == date('Y-m-d'))
                                            <span class="label label-warning">Vence Hoje</span>
                                        @endif
                                        @if($debit->venc_date > date('Y-m-d'))
                                            <span class="label label-success">Em Aberto</span>
                                        @endif
                            </td>
                            <td>
                                <strong>R$ {{\App\Http\Controllers\HomeController::valor_com((\App\Http\Controllers\HomeController::valor_sem($debit->value))-(\App\Http\Controllers\HomeController::valor_sem($debit->payment_value)))}}</strong>
                                @if(\App\Http\Controllers\HomeController::valor_sem($debit->payment_value)>0)
                                    &nbsp;de &nbsp;R$ {{$debit->value}}
                                    @endif
                            </td>
                            <td style="font-size: 15px" align="center">
                                <form action="{{route('debit.pay', ['clientModel' => $debit->id])}}" method="post">
                                    {{csrf_field()}}
                                        R$ <input type="text" name="pagar" value="{{\App\Http\Controllers\HomeController::valor_com((\App\Http\Controllers\HomeController::valor_sem($debit->value))-(\App\Http\Controllers\HomeController::valor_sem($debit->payment_value)))}}" onKeyPress="return(moeda(this,'.',',',event));">
                                    <button class="btn-dark" type="submit">Receber</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pagamentos Realizados</strong></h2>
                    <br>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Compra</th>
                            <th>Data de Pagamento</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\ClientDebitModel::all()->where('client_id', $client->id) as $pp)
                            @foreach(\App\ClientPaymentModel::all()->where('debit_id', $pp->id) as $debit)
                            <tr>

                                <td>
                                    @foreach(\App\SalesModel::all()->where('id',$pp->sale_id) as $dado)
                                        <a href="{{route('sales.view', $dado->id)}}">Venda REF.: {{($dado->created_at)->format('ymd')}}{{$dado->id}}</a>
                                    @endforeach
                                </td>
                                <td>{{\Carbon\Carbon::parse($debit->created_at)->format('d/m/y - H:i')}}</td>

                                <td>
                                    R$ {{$debit->value}}
                                </td>
                            </tr>
                        @endforeach
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
