<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Ficha do Cliente</p>
    <br>
</div>
<div style="width: 100%">
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados da Empresa</strong></p>
    @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
        <p style="margin: 0; font-size: 15px"><strong>Empresa:</strong> {{$empresa->razao}} - {{$empresa->name}}</p>
        <p style="margin: 0; font-size: 15px"><strong>CNPJ:</strong> {{$empresa->cnpj}}</p>
        <p style="margin: 0; font-size: 15px"><strong>Endereço:</strong> {{$empresa->address}}</p>
    @endforeach
    <br>
</div>
<p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados do Cliente</strong></p>
@foreach(\App\ClientsModel::all()->where('id', $produto) as $clientEdit)
<p style="margin: 0"><strong>Nome: </strong>{{$clientEdit->name}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tipo de Cadastro: </strong>@if($clientEdit->type == 0)Pessoa Física @else Pessoa Jurídica @endif</p>
<p style="margin: 0"><strong>CPF/CNPJ: </strong>{{$clientEdit->cpf}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>RG/IE: </strong>{{$clientEdit->rg}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Data de Nascimento: </strong>{{$clientEdit->nasc_date}}</p>
<p style="margin: 0"><strong>Telefone: </strong>{{$clientEdit->phone}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Celular: </strong>{{$clientEdit->cell_phone}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email: </strong>{{$clientEdit->email}}</p>
<p style="margin: 0"><strong>Endereço: </strong>{{$clientEdit->address}}, {{$clientEdit->number_address}}, {{$clientEdit->bairro}}, {{$clientEdit->city}}, {{$clientEdit->cep}}</p>
<p style="margin: 0"><strong>Ponto de Referência: </strong>{{$clientEdit->rf_point}}</p>
<p style="margin: 0"><strong>Referências comerciais: </strong>{{$clientEdit->description}}</p>
<br>

    <p style="margin: 0">Compras Realizadas pelo Cliente</p>
<div class="table-responsive">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: rgba(143,152,142,0.47);">
            <th style="border: solid;">Ref.</th>
            <th style="border: solid;">Data</th>
            <th style="border: solid;">Vendedor</th>
            <th style="border: solid;">Pagamento</th>
            <th style="border: solid;">Valor</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\SalesModel::all()->where('client_id', $clientEdit->id) as $client)
            @if($client->status==1)
                <tr>
                    <td style="border:1px solid;">{{\Carbon\Carbon::parse($client->updated_at)->format('ymd')}}{{$client->id}}</td>
                    <td style="border:1px solid;">{{\Carbon\Carbon::parse($client->updated_at)->format('d/m/y - H:i')}}</td>
                    <td style="border:1px solid;">
                        @foreach(\App\User::all()->where('id',$client->user_id) as $dado)
                            {{$dado->name}}
                        @endforeach
                    </td>
                    <td style="border:1px solid;">
                        @if($client->payment_type==0)
                            Dinheiro
                        @endif
                        @if($client->payment_type==1)
                            Crediário
                        @endif
                        @if($client->payment_type==2)
                            Cartão de Débito
                        @endif
                        @if($client->payment_type==3)
                            Cartão de Crédito
                        @endif
                        @if($client->payment_type==4)
                            Boleto
                        @endif
                    </td>
                    <td style="border:1px solid;">
                        R$ {{number_format(((str_replace(',','.',str_replace('.','',$client->final_value)))-((str_replace(',','.',str_replace('.','',$client->final_value)))*($client->discount / 100))),2,',','.')}}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>


<br>
<p style="margin: 0">Debitos em Aberto do Cliente</p>
<div class="table-responsive">
<table style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr style="background-color: rgba(143,152,142,0.47);">
        <th style="border: solid;">Compra</th>
        <th style="border: solid;">Data de Vencimento</th>
        <th style="border: solid;">Vendedor</th>
        <th style="border: solid;">Status</th>
        <th style="border: solid;">Valor</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\ClientDebitModel::all()->where('client_id', $clientEdit->id)->where('status',0) as $debit)
        <tr>

            <td style="border:1px solid;">
                @foreach(\App\SalesModel::all()->where('id',$debit->sale_id) as $dado)
                    {{($dado->created_at)->format('ymd')}}{{$dado->id}}
                @endforeach
            </td>
            <td style="border:1px solid;">{{\Carbon\Carbon::parse($debit->venc_date)->format('d/m/y')}}</td>
            <td style="border:1px solid;">
                @foreach(\App\SalesModel::all()->where('id',$debit->sale_id) as $dado)
                    @foreach(\App\User::all()->where('id',$dado->user_id) as $vend)
                        {{$vend->name}}
                    @endforeach
                @endforeach

            </td>
            <td style="border:1px solid;">
                @if($debit->venc_date < date('Y-m-d'))
                    Vencido
                @endif
                @if($debit->venc_date == date('Y-m-d'))
                    Vence Hoje
                @endif
                @if($debit->venc_date > date('Y-m-d'))
                    Em Aberto
                @endif
            </td>
            <td style="border:1px solid;">
                <strong>R$ {{\App\Http\Controllers\HomeController::valor_com((\App\Http\Controllers\HomeController::valor_sem($debit->value))-(\App\Http\Controllers\HomeController::valor_sem($debit->payment_value)))}}</strong>
                @if(\App\Http\Controllers\HomeController::valor_sem($debit->payment_value)>0)
                    &nbsp;de &nbsp;R$ {{$debit->value}}
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>

<br>
<p style="margin: 0">Pagamentos Realizados pelo Cliente</p>
<div class="table-responsive">
<table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: rgba(143,152,142,0.47);">
            <th style="border: solid;">Compra</th>
            <th style="border: solid;">Data de Pagamento</th>
            <th style="border: solid;">Valor</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\ClientDebitModel::all()->where('client_id', $clientEdit->id) as $pp)
            @foreach(\App\ClientPaymentModel::all()->where('debit_id', $pp->id) as $debit)
                <tr>

                    <td style="border:1px solid;">
                        @foreach(\App\SalesModel::all()->where('id',$pp->sale_id) as $dado)
                            Venda REF.: {{($dado->created_at)->format('ymd')}}{{$dado->id}}
                        @endforeach
                    </td>
                    <td style="border:1px solid;">{{\Carbon\Carbon::parse($debit->created_at)->format('d/m/y - H:i')}}</td>

                    <td style="border:1px solid;">
                        R$ {{$debit->value}}
                    </td>
                </tr>
            @endforeach
        @endforeach

        </tbody>
    </table>
</div>
@endforeach
</body>
</html>
