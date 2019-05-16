<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório Compras</p>
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

<div class="table-responsive">
<table style="border: 1px solid black; border-collapse: collapse;" width="100%">
    <thead>
    <tr style="border: 1px solid black; border-collapse: collapse;; background-color: rgba(143,152,142,0.47);">
        <th style="border: 1px solid black; border-collapse: collapse;">Data</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Fornecedor</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Nota</th>
        <th style="border: 1px solid black; border-collapse: collapse;">Nº Ítens</th>

    </tr>
    </thead>
    <tbody>
    @foreach(\App\PurchasesModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $client)
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse;">{{\Carbon\Carbon::parse($client->date)->format('d/m/Y')}}</td>
            <td style="border: 1px solid black; border-collapse: collapse;">
                @foreach(\App\ProvidersModel::all()->where('id',$client->provider_id) as $dado)
                    {{$dado->fantasy_name}}
                @endforeach
            </td>
            <td style="border: 1px solid black; border-collapse: collapse;">{{$client->note_number}}</td>
            <td style="border: 1px solid black; border-collapse: collapse;">
                {{\App\ProductsPurchasesModel::all()->where('purchase_id',$client->id)->count()}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>
</body>
</html>
