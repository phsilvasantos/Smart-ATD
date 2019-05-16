<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Pedido de Compra</p>
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
@php
$venda='';
    foreach(\App\PurchasesModel::all()->where('id', $produto) as $vend){
    $venda=$vend;
    }
@endphp
<div>
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados da Compra</strong></p>
    @foreach(\App\ProvidersModel::all()->where('id',$venda->provider_id) as $dado)
        <p style="margin: 0">Fornecedor: <strong>{{$dado->fantasy_name}}</strong> - {{$dado->social_name}}</p>
        <p style="margin: 0">Endereço: <strong>{{$dado->address}}</strong>&nbsp;&nbsp;-&nbsp;&nbsp;Contatos: <strong>{{$dado->phone}} / {{$dado->cell_phone}}</strong></p>
        <p style="margin: 0">Nota: {{$venda->note_number}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($venda->date)->format('d/m/Y')}}</p>
    @endforeach
    <br>
</div>
<div><p>Produtos:</p></div>
<div class="table-responsive">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr  style="border: solid;; background-color: rgba(143,152,142,0.47);">
            <th style="border: solid;">Código</th>
            <th style="border: solid;">Produto</th>
            <th style="border: solid;">Preço de Compra</th>
            <th style="border: solid;">Quantidade</th>
            <th style="border: solid;">Valor Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\ProductsPurchasesModel::all()->where('purchase_id', $venda->id) as $client)
            <tr>
                @foreach(\App\ProductsModel::all()->where('id',$client->product_id) as $dado)
                    <td style="border:1px solid;">{{$dado->code}}</td>
                    <td style="border:1px solid;">{{$dado->name}}</td>
                @endforeach
                <td style="border:1px solid;">{{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price))), 2, ',', '.') }}</td>
                <td style="border:1px solid;">{{$client->qtd}}</td>
                <td style="border:1px solid;">
                    {{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price)) * $client->qtd), 2, ',', '.') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    <br>

    <div align="center">

        @foreach(\App\ModelCompany::all()->where('id',$venda->company_id) as $dado)
            <p>{{$dado->city}},
                @php
                setlocale(LC_TIME, 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d');
                echo strftime("%d de %B de %Y", strtotime($date));
                @endphp
            </p>
        @endforeach

    </div>

</body>
</html>
