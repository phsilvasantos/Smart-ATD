<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Caixa</p>
    <br>
</div>
@foreach(\App\CashDeskModel::all()->where('id', $produto) as $clientEdit)

    <div style="width: 100%">
        <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados da Empresa</strong></p>
        @foreach(\App\ModelCompany::all()->where('id', $clientEdit->company_id) as $empresa)
            <p style="margin: 0; font-size: 15px"><strong>Empresa:</strong>{{$empresa->razao}} - {{$empresa->name}}</p>
            <p style="margin: 0; font-size: 15px"><strong>CNPJ:</strong>{{$empresa->cnpj}}</p>
            <p style="margin: 0; font-size: 15px"><strong>Endereço:</strong>{{$empresa->address}}</p>
        @endforeach
        <br>
    </div>
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados do Caixa</strong></p>
    <p style="margin: 0"><strong>Data: </strong>{{\Carbon\Carbon::parse($clientEdit->created_at)->format('d/m/y - H:i')}}</p>
<p style="margin: 0">
    <strong>Aberto por: </strong>@foreach(\App\User::all()->where('id', $clientEdit->open_user_id) as $user)
    {{$user->name}}
    @endforeach</p>
    <p style="margin: 0">
    <strong>Fechado por: </strong>@if($clientEdit->status == 0)- @else
        @foreach(\App\User::all()->where('id', $clientEdit->close_user_id) as $user)
            {{$user->name}}
        @endforeach
    @endif</p>
<p style="margin: 0"><strong>Valor de Abertura: </strong>R$ {{$clientEdit->open_value}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Valor de Fechamento: </strong>@if($clientEdit->status == 0)- @else R$ {{$clientEdit->close_value}} @endif</p>
<br>

    <p>Movimentações</p>
    <div class="table-responsive">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: rgba(143,152,142,0.47);">
            <th style="border: solid;">Data/Hora</th>
            <th style="border: solid;">Descrição</th>
            <th style="border: solid;">Tipo</th>
            <th style="border: solid;">Valor</th>
            <th style="border: solid;">Operação</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\MovementModel::all()->where('cash_desk_id', $clientEdit->id) as $caixa)
            <tr>
                <td style="border:1px solid;">{{\Carbon\Carbon::parse($caixa->created_at)->format('d/m/y - H:i')}}</td>
                <td style="border:1px solid;">{{$caixa->description}}</td>
                <td style="border:1px solid;">
                    @if($caixa->payment_type==0)
                        Dinheiro
                    @endif
                    @if($caixa->payment_type==1)
                        Crediário
                    @endif
                    @if($caixa->payment_type==2)
                        Cartão de Débito
                    @endif
                    @if($caixa->payment_type==3)
                        Cartão de Crédito
                    @endif
                    @if($caixa->payment_type==4)
                        Boleto
                    @endif
                </td>
                <td style="border:1px solid;">
                    R$ {{$caixa->value}}
                </td>

                <td style="border:1px solid;">
                    @if(str_replace(',','.',str_replace('.','',$caixa->value))<0)
                        - &nbsp;Saída
                    @else
                        + &nbsp;Entrada
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>


<br>
    <div class="table-responsive">
    <table width="100%">
        @php
            $dinheiro=0.00;
            $debito=0.00;
            $credito=0.00;
            $crediario=0.00;
            $boleto=0.00;
            $entrada=0.00;
            $saida=0.00;

            foreach (\App\MovementModel::all()->where('cash_desk_id', $clientEdit->id) as $caixa){
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
        <tr style="vertical-align: top"><td width="50%">
            <table  style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="background-color: rgba(143,152,142,0.47);">
                    <th style="border: solid;">Disponível em Caixa</th>
                    <th style="border: solid;">Valor</th>
                </tr>
                </thead>
                <tbody>
                <tr><td style="border:1px solid;">Dinheiro </td><td style="border:1px solid;"><strong>R$ {{number_format($dinheiro,2,',','.')}}</strong></td></tr>
                <tr><td style="border:1px solid;">Crediário </td><td style="border:1px solid;"><strong>R$ {{number_format($crediario,2,',','.')}}</strong></td></tr>
                <tr><td style="border:1px solid;">Cartão de Débito </td><td style="border:1px solid;"><strong>R$ {{number_format($debito,2,',','.')}}</strong></td></tr>
                <tr><td style="border:1px solid;">Cartão de Crédito </td><td style="border:1px solid;"><strong>R$ {{number_format($credito,2,',','.')}}</strong></td></tr>
                <tr><td style="border:1px solid;">Boleto </td><td style="border:1px solid;"><strong>R$ {{number_format($boleto,2,',','.')}}</strong></td></tr>
                </tbody>
            </table>
            <p style="font-size: 20px">Total: <strong>R$ {{number_format($dinheiro+$credito+$debito+$crediario+$boleto, 2, ',', '.')}}</strong></p>
            </td><td width="50%">
                <table style="width: 100%">
                    <thead>
                    <tr style="background-color: rgba(143,152,142,0.47);">
                        <th style="border: solid;">Operação</th>
                        <th style="border: solid;">Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr><td  style="border:1px solid;">Entrada </td><td style="border:1px solid;"><strong>R$ {{number_format($entrada,2,',','.')}}</strong></td></tr>
                    <tr><td  style="border:1px solid;">Saída </td><td style="border:1px solid;"><strong>R$ {{number_format($saida,2,',','.')}}</strong></td></tr>
                    </tbody>
                </table>
            </td></tr>

    </table>
    </div>
@endforeach
</body>
</html>
