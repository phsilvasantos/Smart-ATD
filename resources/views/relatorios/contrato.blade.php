<html>
<head>
    <title>ATD Sistemas</title>
</head>
<body>
<div style="width: 100%" align="center">
    <p style="margin: 0; font-size: 25px">Condições Gerais do Contrato de Crediário</p>
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
<div>
    <p style="padding: 5px; width: 100%; background-color: rgba(143,152,142,0.47); margin: 0" align="center"><strong>Contrato</strong></p>
    <p style="font-size: 15px; margin: 0">
        <strong>I- Direitos e Deveres</strong>
        <br>
    <strong>a)</strong> o cliente tem o direito de exigir o recibo de pagamento no carnê;
<br>
    <strong>b)</strong> este contrato será considerado antecipadamente vencido e exigível de imediato o total da dívida se o cliente deixar de pagar quaisquer das prestações no prazo superior a 30 (trinta) dias;
        <br>
        <strong>c)</strong> Se houver atraso no pagamento de qualquer parcela, ou vencimento antecipado, o cliente pagará multa de 2% (dois por cento) ao mês sobre o valor da parcela ou sobre o saldo em aberto, respectivamente;
        <br>
        <strong>d)</strong> não há juros embutido no valor do débito, razão pela qual o pagamento antecipado não dá direito a nenhum desconto;
        <br>
        <strong>e)</strong> a assinatura deste contrato implica na prova documental da existência, liquidez e certeza da sua dívida.
        <br>
        <strong>f)</strong> A tolerância no recebimento de alguma parcela em atraso não significará renúncia, perdão, novação ou alteração do que foi aqui contratado.
        <br>
        <strong>g)</strong> o cliente está plenamente ciente e de acordo de que, na hipótese de atraso superior a 30 (trinta) dias, poderá ter seu nome lançado no Serviço Central de Proteção ao Crédito – SCPC, SERASA, bem como a qualquer outro órgão encarregado de cadastrar atraso no pagamento e descumprimento de obrigação contratual.
        <br>
        <strong>h)</strong> o pagamento da multa de 2% (dois) por cento não exime do pagamento da correção monetária (variação da inflação no período), bem como dos juros de mora, estes calculados à base de 1% (um por cento) ao mês.
        <br>
        <strong>i)</strong> Este contrato obriga, por todos os seus termos e condições, as partes, seus herdeiros e sucessores, a qualquer título que o sejam.
        <br>
    <strong>II- Prazo</strong>
        <br>
    O contrato terá vigência até que ocorra o pagamento integral do débito.
    </p>
</div>
<br>
<div align="center"><p style="margin: 0; font-size: 20px">Dados da Compra</p></div>
@foreach(\App\SalesModel::all()->where('id', $produto) as $venda)
    <div class="table-responsive">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: rgba(143,152,142,0.47);">
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
    <div style="width: 100%" align="right"><p style="margin: 0">Total: R$ {{$venda->final_value}}</p>
        <p style="margin: 0">Desconto de {{$venda->discount}}%</p>
        <p style="margin: 0">Valor Final: R$ {{number_format(((str_replace(',','.',(str_replace('.','', $venda->final_value))))-((((str_replace(',','.',(str_replace('.','', $venda->final_value))))))* $venda->discount /100)),2,',','.')}}</p></div>

    <p style="font-size: 18px">{{$venda->payment_description}}</p>
    @if(\App\ExamEyeModel::all()->where('sale_id', $venda->id)->count() > 0)
        <div class="card-title">
            <h4>Dados do Exame</h4>
        </div>
        @foreach(\App\ExamEyeModel::all()->where('sale_id', $venda->id) as $exam)
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
    <div align="center" style="margin: 0">
        @foreach(\App\ModelCompany::all()->where('id',$venda->company_id) as $dado)
            <p style="margin: 0">{{$dado->city}},
                @php
                setlocale(LC_TIME, 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d');
                echo strftime("%d de %B de %Y", strtotime($date));
                @endphp
            </p>
        @endforeach
        <br>
        ___________________________________________<br>
        @foreach(\App\ClientsModel::all()->where('id',$venda->client_id) as $dado)
            <p style="margin: 0"><strong>{{$dado->name}}</strong></p>
                <p style="margin: 0; font-size: 12px">COMPRADOR(A)</h5>
        @endforeach
    </div>

    @endforeach
</body>
</html>
