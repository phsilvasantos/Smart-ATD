<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Fornecedor</p>
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
<p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados do Fornecedor</strong></p>
@foreach(\App\ProvidersModel::all()->where('id', $produto) as $clientEdit)
<p style="margin: 0"><strong>Nome Fantasia: </strong>{{$clientEdit->fantasy_name}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Razão Social: </strong>{{$clientEdit->social_name}}</p>
<p style="margin: 0"><strong>CPF/CNPJ: </strong>{{$clientEdit->cpf}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>RG/IE: </strong>{{$clientEdit->rg}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Dados Bancarios: </strong>{{$clientEdit->bank_account}}</p>
<p style="margin: 0"><strong>Telefone: </strong>{{$clientEdit->phone}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Celular: </strong>{{$clientEdit->cell_phone}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email: </strong>{{$clientEdit->email}}</p>
<p style="margin: 0"><strong>Endereço: </strong>{{$clientEdit->address}}, {{$clientEdit->number_address}}, {{$clientEdit->bairro}}, {{$clientEdit->city}}, {{$clientEdit->cep}}</p>
<p style="margin: 0"><strong>Outras Informações: </strong>{{$clientEdit->description}}</p>
<br>

    <p>Compras Realizadas ao Fornecedor</p>
<div class="table-responsive">
<table style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr style="background-color: rgba(143,152,142,0.47);">
        <th style="border: solid;">Data</th>
        <th style="border: solid;">Nota</th>
        <th style="border: solid;">Nº Ítens</th>
        <th style="border: solid;">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\PurchasesModel::all()->where('provider_id', $clientEdit->id) as $client)
        <tr>
            <td style="border:1px solid;">{{\Carbon\Carbon::parse($client->date)->format('d/m/Y')}}</td>
            <td style="border:1px solid;">{{$client->note_number}}</td>
            <td style="border:1px solid;">
                {{\App\ProductsPurchasesModel::all()->where('purchase_id',$client->id)->count()}}
            </td>
            <td style="border:1px solid;">
                @if($client->status==0)
                    Em Aberto
                @else
                    Concluída
                @endif
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>
@endforeach
</body>
</html>
