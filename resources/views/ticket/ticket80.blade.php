<html>
<head>

</head>
<body>

@foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
    @php
        $url='files/'.$empresa->logo;
    @endphp
@endforeach

<table width="100%" align="center" style=" padding: 10px">

        @forelse(\App\ProductsModel::all()->where('id', $produto->name) as $product)
            @for($i=0; $i < $produto->code; $i++)
            <tr align="center">
                <td width="30%" align="center" style="border: dashed;">
                    {{asset($url)}}
                    <strong style="font-size: 20px">{{ $product->name }}</strong>
                    <br>
                    <p style="font-style: italic; margin: 0">Ref.: {{ $product->code }}</p>
                    R$ {{ $product->sale_value }}
                </td>
            </tr>
            @endfor
        @empty
            <li>Nenhum Produto Cadastrado.</li>
        @endforelse
</table>

<script>
    window.print();
</script>
</body>
</html>
