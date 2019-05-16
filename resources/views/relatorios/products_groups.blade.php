<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Grupos de Produtos</p>
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
        <td style="border: 2px solid"><strong>Grupo</strong></td>
        <td style="border: 2px solid"><strong>Descrição</strong></td>
        <td style="border: 2px solid"><strong>Quntidade de Ítens</strong></td>
    </tr>
    <tbody>
        @foreach(\App\ProductsGroupModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $product)
            <tr>
                <td width="40%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->name}}
                </td>
                <td  width="40%" style="border: 1px solid black; border-collapse: collapse;">
                    {{$product->description}}
                </td>
                <td width="20%" style="border: 1px solid black; border-collapse: collapse;">
                    @php
                    $qtd=0;
                    foreach(\App\ProductsModel::all()->where('product_group_id', $product->id) as $group){
                    $qtd=$qtd+1;
                    }
                    echo $qtd;
                    @endphp
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</body>
</html>
