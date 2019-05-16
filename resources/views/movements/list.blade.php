@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div style="width: 100%" align="right">
                    <a style="margin-right: 10px" href="{{route('reports.cash', $clients->id)}}" class="btn btn-default" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Caixa">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <div class="x_title">
                    <h2>Movimento de Caixa</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Operação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\MovementModel::all()->where('cash_desk_id', $clients->id) as $caixa)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($caixa->created_at)->format('d/m/y - H:i')}}</td>
                            <td>{{$caixa->description}}</td>
                            <td>
                                @if($caixa->payment_type==0)
                                    <span class="label label-success">Dinheiro</span>
                                @endif
                                    @if($caixa->payment_type==1)
                                        <span class="label label-warning">Crediário</span>
                                    @endif
                                    @if($caixa->payment_type==2)
                                        <span class="label label-primary">Cartão de Débito</span>
                                    @endif
                                    @if($caixa->payment_type==3)
                                        <span class="label label-danger">Cartão de Crédito</span>
                                    @endif
                                    @if($caixa->payment_type==4)
                                        <span class="label label-default">Boleto</span>
                                    @endif
                            </td>
                            <td>
                                R$ {{$caixa->value}}
                            </td>

                            <td>
                                @if(str_replace(',','.',str_replace('.','',$caixa->value))<0)
                                    <span class="label label-danger">- &nbsp;Saída</span>
                                @else
                                    <span class="label label-success">+ &nbsp;Entrada</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div>
                        @php
                        $dinheiro=0.00;
                        $debito=0.00;
                        $credito=0.00;
                        $crediario=0.00;
                        $boleto=0.00;
                        $entrada=0.00;
                        $saida=0.00;

                        foreach (\App\MovementModel::all()->where('cash_desk_id', $clients->id) as $caixa){
                            $valor = str_replace(',','.',str_replace('.','',$caixa->value));

                            if($caixa->payment_type==0){
                                $dinheiro = $dinheiro+$valor;
                            }
                            if($caixa->payment_type==1){
                                $crediario = $crediario+$valor;
                            }
                            if($caixa->payment_type==2){
                                $debito = $debito+$valor;
                            }
                            if($caixa->payment_type==3){
                                $credito=$credito+$valor;
                            }
                            if($caixa->payment_type==4){
                                $boleto=$boleto+$valor;
                            }
                             if($valor>0){
                                $entrada=$entrada+$valor;
                            }else{
                                $saida=$saida+$valor;
                            }
                        }
                        @endphp
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Disponível em Caixa</th>
                                    <th>Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr><td>Dinheiro </td><td><strong>R$ {{number_format($dinheiro,2,',','.')}}</strong></td></tr>
                                <tr><td>Crediário </td><td><strong>R$ {{number_format($crediario,2,',','.')}}</strong></td></tr>
                                <tr><td>Cartão de Débito </td><td><strong>R$ {{number_format($debito,2,',','.')}}</strong></td></tr>
                                <tr><td>Cartão de Crédito </td><td><strong>R$ {{number_format($credito,2,',','.')}}</strong></td></tr>
                                <tr><td>Boleto </td><td><strong>R$ {{number_format($boleto,2,',','.')}}</strong></td></tr>
                                </tbody>
                            </table>
                            </div>
                            <h4>Total: <strong>R$ {{number_format($dinheiro+$credito+$debito+$crediario+$boleto, 2, ',', '.')}}</strong></h4>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr style="color: green"><td>Entrada </td><td><strong>R$ {{number_format($entrada,2,',','.')}}</strong></td></tr>
                                <tr style="color: red"><td>Saída </td><td><strong>R$ {{number_format($saida,2,',','.')}}</strong></td></tr>
                                </tbody>
                            </table>
                            </div>
                        </div>

                    </div>
                    <div style="width: 100%" align="right">
                        <a href="#" class="btn btn-default">&nbsp;Imprimir Caixa</a>
                        <br>
                    @if($clients->status==0)
                            <a href="{{route('cash_desk.close')}}" class="btn btn-lg btn-danger">&nbsp;Fechar o Caixa</a>
                        @else
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
