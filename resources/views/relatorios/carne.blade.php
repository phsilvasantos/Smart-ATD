<html>
<head>
    <title>Carnê de Pagamento</title>
</head>
<body>
@php
    $compra='';
    $qtd=0;
    $i=1;

foreach(\App\ProductsSalesModel::all()->where('sale_id', $produto) as $sale){
    $compra = $compra . \App\ProductsModel::orderBy('id', 'asc')->where('id', $sale->product_id)->first()->name .' - ';
}
    $size = strlen($compra);
    $compra=substr($compra,0, $size-3);
foreach(\App\ClientDebitModel::all()->where('sale_id', $produto) as $product){
 $qtd++;
}
@endphp

<table width="100%" align="center" style="padding: 10px">
        @foreach(\App\ClientDebitModel::all()->where('sale_id', $produto) as $product)
            <tr>
                <td width="30%" style="border: solid;border-right: none">
                    <table style="width: 100%">
                        <tr>
                            <td style="border-bottom: solid; width: 100%">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="{{asset('files/'.\App\ModelCompany::orderBy('id','asc')->where('id', \Illuminate\Support\Facades\Auth::user()->company_id)->first()->logo)}}" height="20px" style="margin: 0">
                                        </td>
                                        <td>
                                            <strong style="font-size: 18px">{{\App\ModelCompany::orderBy('id','asc')->where('id', $product->company_id)->first()->name}}</strong>
                                            <br>Venda: <strong>{{\Carbon\Carbon::parse($product->venc_date)->format('Ymd')}}{{$product->sale_id}}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </td></tr>
                        <tr><td>
                                Parcela: {{$i}}/{{$qtd}}
                            </td></tr>
                        <tr><td>
                                Vencimento <strong>{{\Carbon\Carbon::parse($product->venc_date)->format('d/m/y')}}</strong>
                            </td></tr>
                        <tr><td>
                                Valor: <strong>R$ {{\App\Http\Controllers\HomeController::valor_com((\App\Http\Controllers\HomeController::valor_sem($product->value))-\App\Http\Controllers\HomeController::valor_sem($product->payment_value))}}</strong>
                            </td></tr>
                        <tr><td>
                                Pagamento ____ /____ /______
                            </td></tr>
                        <tr><td>
                                Valor Pago: R$ ____________
                            </td></tr>
                    </table>
                </td>
                <td width="43%" style="border: solid; border-left: dashed; vertical-align: top">
                    <table style="width: 100%">
                        <tr><td style="border-bottom: solid; width: 100%">
                               <strong>{{\App\ClientsModel::orderBy('id','asc')->where('id', $product->client_id)->first()->name}}</strong> - {{\App\ClientsModel::orderBy('id','asc')->where('id', $product->client_id)->first()->phone}}
                            </td></tr>
                        <tr><td>
                                <strong>Endereço: </strong> {{\App\ClientsModel::orderBy('id','asc')->where('id', $product->client_id)->first()->address}}
                            </td></tr>
                        <tr><td>
                                <strong>Detalhes da Compra: </strong> {{$compra}}
                            </td></tr>
                        <tr><td align="center">
                                @if($product->status==1)
                                    <h1 style="color: red; margin: 0">PAGO</h1> em {{\Carbon\Carbon::parse($product->updated_at)->format('d/m/y')}}
                                    @endif
                            </td></tr>
                    </table>
                </td>
                <td width="22%" style="border: solid; border-left: none">
                    <table style="width: 100%">
                        <tr><td>
                                Parcela: {{$i}}/{{$qtd}}
                                @php($i++)
                            </td></tr>
                        <tr><td>
                                Vencimento <strong>{{\Carbon\Carbon::parse($product->venc_date)->format('d/m/y')}}</strong>
                            </td></tr>
                        <tr><td>
                                Valor: <strong>R$ {{\App\Http\Controllers\HomeController::valor_com((\App\Http\Controllers\HomeController::valor_sem($product->value))-\App\Http\Controllers\HomeController::valor_sem($product->payment_value))}}</strong>
                            </td></tr>
                        <tr><td>
                                Pagamento
                            </td></tr>
                        <tr><td>
                                ____ /____ /______
                            </td></tr>
                        <tr><td>
                                Valor Pago:
                            </td></tr>
                        <tr><td>
                                R$ ____________
                            </td></tr>
                    </table>
                </td>
            </tr>
        @endforeach
</table>
</body>
</html>
