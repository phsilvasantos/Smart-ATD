<html>
<head>

</head>
<body>

<table width="100%" align="center" style=" padding: 10px">
    <tr align="center">

        @php

                $a=3;
        @endphp
        @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
            @php
                $url='files/'.$empresa->logo;
            @endphp
        @endforeach
        @forelse(\App\ProductsModel::all()->where('id', $produto->name) as $product)
            @for($i=0; $i < $produto->code; $i++)
                <td width="30%" align="center" style="border: dashed; padding: 5px; border-radius: 25px">
                        <img src="{{ asset($url) }}" height="50px" style="margin-top: 5px">
                    <br>
                    <strong style="font-size: 20px">{{ $product->name }}</strong>
                    <br>
                    <p style="font-style: italic; margin: 0">Ref.: {{ $product->code }}/{{ str_replace(',','',$product->cost_value) }}</p>
                    R$ {{ $product->sale_value }}
                    <br>
                    <table align="center">
                        <tr align="center">
                            <td align="center">
                                @php
                                    echo \Milon\Barcode\DNS1D::getBarcodeHTML($product->barcode, "EAN13");
                                @endphp
                            </td>
                        </tr>
                    </table>

                    <p style="font-size: 12px; margin: 0">{{$product->barcode}}</p>
                </td>
                @php
                    $a--;
                    if ($a==0){
                    $a=3;
                    echo '</tr><tr>';
                    }
                @endphp
            @endfor
        @empty
            <li>Nenhum Produto Cadastrado.</li>
        @endforelse
    </tr>
</table>

</body>
</html>
