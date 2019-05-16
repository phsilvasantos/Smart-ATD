<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Relatório de Produtos</p>
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
        <td style="border: 2px solid"><strong>REF.</strong></td>
        <td style="border: 2px solid"><strong>NOME</strong></td>
        <td style="border: 2px solid"><strong>CUSTO</strong></td>
        <td style="border: 2px solid"><strong>VENDA</strong></td>
        <td style="border: 2px solid"><strong>ESTOQUE</strong></td>
    </tr>
    <tbody>
    @foreach(\App\ProductsModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $product)
        <tr>
            <td width="10%" style="border: 1px solid black; border-collapse: collapse;">
                {{$product->code}}
            </td>
            <td width="40%" style="border: 1px solid black; border-collapse: collapse;">
                {{$product->name}}
            </td>
            <td  width="25%" style="border: 1px solid black; border-collapse: collapse;">
                R$ {{$product->cost_value}}
            </td>
            <td width="25%" style="border: 1px solid black; border-collapse: collapse;">
                R$ {{$product->sale_value}}
            </td>
            <td style="border: 1px solid black; border-collapse: collapse;">
                @php
                    $qtdfinal = 0;
                    $vendidos = 0;
                @endphp
                @foreach(\App\ProductsPurchasesModel::all()->where('product_id',$product->id) as $compras)
                    @foreach(\App\PurchasesModel::all()->where('id',$compras->purchase_id) as $ss)
                        @if($ss->status==1)
                            @php($qtdfinal = $qtdfinal + $compras->qtd)
                        @endif
                    @endforeach
                @endforeach
                @foreach(\App\ProductsSalesModel::all()->where('product_id',$product->id) as $vendas)
                    @foreach(\App\SalesModel::all()->where('id',$vendas->sale_id) as $ss)
                        @if($ss->status==1)
                            @php($vendidos = $vendidos + $vendas->qtd)
                        @endif
                    @endforeach
                @endforeach
                @php($qtdfinal = $qtdfinal-$vendidos)
                @if($qtdfinal>=0)
                    {{$qtdfinal}}
                @else
                    <span style="color: red">{{$qtdfinal}}</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</body>
</html>
