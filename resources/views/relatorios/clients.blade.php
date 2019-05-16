<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Clientes</p>
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
<table width="100%" style="border: 1px solid black; border-collapse: collapse;">
    <thead></thead>
    <tr style="background-color: rgba(143,152,142,0.47);">
        <td style="border: 2px solid"><strong>NOME</strong></td>
        <td style="border: 2px solid"><strong>CPF</strong></td>
        <td style="border: 2px solid"><strong>ENDEREÇO</strong></td>
        <td style="border: 2px solid"><strong>CONTATOS</strong></td>
    </tr>
    <tbody>
        @foreach(\App\ClientsModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $product)
            <tr>
                <td width="40%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->name}}
                </td>
                <td  width="20%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->cpf}}
                </td>
                <td width="30%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->address}}
                </td>
                <td width="10%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->phone}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</body>
</html>
