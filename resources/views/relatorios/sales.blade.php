<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Vendas</p>
    <br>
</div>
<div style="width: 100%">
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47);  margin: 0"><strong>Dados da Empresa</strong></p>
    @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
        <p style="margin: 0; font-size: 15px"><strong>Empresa:</strong> {{$empresa->razao}} - {{$empresa->name}}</p>
        <p style="margin: 0; font-size: 15px"><strong>CNPJ:</strong> {{$empresa->cnpj}}</p>
        <p style="margin: 0; font-size: 15px"><strong>Endereço:</strong> {{$empresa->address}}</p>
    @endforeach
    <br>
</div>
<div class="table-responsive">
<table style="border: 1px solid black; border-collapse: collapse;" width="100%">
    <thead>
    <tr style="border: 1px solid black; border-collapse: collapse;; background-color: rgba(143,152,142,0.47);">
        <th style="border: 1px solid black; border-collapse: collapse;">Ref.</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Data</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Cliente</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Vendedor</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Pagamento</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Valor</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\SalesModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $client)
        @if($client->status==1)
            <tr style="border: 1px solid black; border-collapse: collapse;">
                <td style="border: 1px solid black; border-collapse: collapse;">{{\Carbon\Carbon::parse($client->updated_at)->format('ymd')}}{{$client->id}}</td>
                <td style="border: 1px solid black; border-collapse: collapse;">{{\Carbon\Carbon::parse($client->updated_at)->format('d/m/y - H:i')}}</td>
                <td style="border: 1px solid black; border-collapse: collapse;">
                    @foreach(\App\ClientsModel::all()->where('id',$client->client_id) as $dado)
                        {{$dado->name}}
                    @endforeach
                </td>
                <td style="border: 1px solid black; border-collapse: collapse;">
                    @foreach(\App\User::all()->where('id',$client->user_id) as $dado)
                        {{$dado->name}}
                    @endforeach
                </td>
                <td style="border: 1px solid black; border-collapse: collapse;">
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
                <td style="border: 1px solid black; border-collapse: collapse;">
                    R$ {{number_format(((str_replace(',','.',str_replace('.','',$client->final_value)))-((str_replace(',','.',str_replace('.','',$client->final_value)))*($client->discount / 100))),2,',','.')}}
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</div>
</body>
</html>
