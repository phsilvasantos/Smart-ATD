<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Pedido de Venda</p>
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
    foreach(\App\SalesModel::all()->where('id', $produto) as $vend){
    $venda=$vend;
    }
@endphp
<div>
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0"><strong>Dados da Venda</strong></p>
    @foreach(\App\ClientsModel::all()->where('id',$venda->client_id) as $dado)
        <p style="margin: 0">Cliente: <strong>{{$dado->name}}</strong></p>
        <p style="margin: 0">Endereço: <strong>{{$dado->address}}</strong>&nbsp;&nbsp;-&nbsp;&nbsp;Contatos: <strong>{{$dado->phone}} / {{$dado->cell_phone}}</strong></p>
        <p style="margin: 0">Venda: {{\Carbon\Carbon::parse($venda->created_at)->format('Ymd')}}{{$venda->id}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($venda->created_at)->format('d/m/Y')}}</p>
    @endforeach
    <br>
</div>
<div><p>Produtos:</p></div>
<div class="table-responsive">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr  style="border: solid;;background-color: rgba(143,152,142,0.47);">
            <th style="border: solid;">Código</th>
            <th style="border: solid;">Produto</th>
            <th style="border: solid;">Preço</th>
            <th style="border: solid;">Quantidade</th>
            <th style="border: solid;">Valor Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\ProductsSalesModel::all()->where('sale_id', $venda->id) as $client)
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
<p style="margin: 0">Informações Adicionais da Venda: <strong>{{$venda->informacoes}}</strong></p>
    <br>
    <div style="width: 100%" align="right">
        <p style="margin: 0">Total: R$ {{$venda->final_value}}</p>
        <p style="margin: 0">Desconto de {{$venda->discount}}%</p>
        <p style="margin: 0">Valor Final: R$ {{number_format(((str_replace(',','.',(str_replace('.','', $venda->final_value))))-((((str_replace(',','.',(str_replace('.','', $venda->final_value))))))* $venda->discount /100)),2,',','.')}}</p></div>

    <p style="font-size: 20px">Detalhes do Pagamento: <strong>{{$venda->payment_description}}</strong></p>

@if(\App\ExamEyeModel::all()->where('sale_id', $venda->id)->count() > 0)
    <div class="card-title">
        <h4>Dados do Exame</h4>
    </div>
    @foreach(\App\ExamEyeModel::all()->where('sale_id', $venda->id) as $exam)
        <p style="margin: 0"><strong>Diabetes?</strong> {{$exam->diabetes}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hipertensão?</strong> {{$exam->hipertensao}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Grávida?</strong> {{$exam->gravida}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Usa Óculos?</strong> {{$exam->oculos}}</p>
        <p style="margin: 0"><strong>Pio</strong> OD: {{$exam->pio_od}} &nbsp;&nbsp;&nbsp; OE: {{$exam->pio_oe}}</p>
        <p style="margin: 0"><strong>Observação:</strong> {{$exam->obs}}</p>
                <table width="100%" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="border:1px solid;"></th>
                        <th style="border:1px solid;">Esférico</th>
                        <th style="border:1px solid;">Cilíndrico</th>
                        <th style="border:1px solid;">Eixo</th>
                        <th style="border:1px solid;">DNP</th>
                        <th style="border:1px solid;">Altura</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="border:1px solid;">OD</td>
                        <td style="border:1px solid;">{{$exam->esf_od}}</td>
                        <td style="border:1px solid;">{{$exam->cil_od}}</td>
                        <td style="border:1px solid;">{{$exam->eix_od}}</td>
                        <td style="border:1px solid;">{{$exam->dnp_od}}</td>
                        <td style="border:1px solid;">{{$exam->alt_od}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid;">OE</td>
                        <td style="border:1px solid;">{{$exam->esf_oe}}</td>
                        <td style="border:1px solid;">{{$exam->cil_oe}}</td>
                        <td style="border:1px solid;">{{$exam->eix_oe}}</td>
                        <td style="border:1px solid;">{{$exam->dnp_oe}}</td>
                        <td style="border:1px solid;">{{$exam->alt_oe}}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid;">Adição</td>
                        <td style="border:1px solid;">{{$exam->adicao}}</td>
                        <td style="border:1px solid;">Responsável</td>
                        <td style="border:1px solid;">{{$exam->responsavel}}</td>
                        <td style="border:1px solid;">Tipo de Lente</td>
                        <td style="border:1px solid;">{{$exam->tipo_lente}}</td>
                    </tr>
                    </tbody>
                </table>
    @endforeach
@endif
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
