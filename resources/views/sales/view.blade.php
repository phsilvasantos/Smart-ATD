@extends('layouts.app')
@if($clientEdit->company_id != \Illuminate\Support\Facades\Auth::user()->company_id)
    <script language= "JavaScript">
        location.href="{{route('home')}}"
    </script>
@endif
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-11 col-sm-11 col-xs-11">
                            <h3>Cliente:
                                @foreach(\App\ClientsModel::all()->where('id',$clientEdit->client_id) as $dado)
                                    <strong>{{$dado->name}}</strong>
                                @endforeach</h3>
                            <h5>Venda: {{\Carbon\Carbon::parse($clientEdit->date)->format('Ymd')}}{{$clientEdit->id}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($clientEdit->created_at)->format('d/m/Y')}}</h5>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1" align="right">
                            <a href="{{route('reports.sale', $clientEdit->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Imprimir Venda"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered" disabled="true">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\ProductsSalesModel::all()->where('sale_id', $clientEdit->id) as $client)
                            <tr>
                                @foreach(\App\ProductsModel::all()->where('id',$client->product_id) as $dado)
                                    <td>{{$dado->code}}</td>
                                    <td>{{$dado->name}}</td>
                                @endforeach
                                <td>{{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price))), 2, ',', '.') }}</td>
                                <td>{{$client->qtd}}</td>
                                <td>
                                    {{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price)) * $client->qtd), 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

                        @if(\App\ExamEyeModel::all()->where('sale_id', $clientEdit->id)->count() > 0)
                        <div class="card-title">
                            <h2>Dados do Exame (Preencher se Necessário)</h2>
                        </div>
                            @foreach(\App\ExamEyeModel::all()->where('sale_id', $clientEdit->id) as $exam)
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Esférico</th>
                                                <th>Cilíndrico</th>
                                                <th>Eixo</th>
                                                <th>DNP</th>
                                                <th>Altura</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>OD</td>
                                                <td>{{$exam->esf_od}}</td>
                                                <td>{{$exam->cil_od}}</td>
                                                <td>{{$exam->eix_od}}</td>
                                                <td>{{$exam->dnp_od}}</td>
                                                <td>{{$exam->alt_od}}</td>
                                            </tr>
                                            <tr>
                                                <td>OE</td>
                                                <td>{{$exam->esf_oe}}</td>
                                                <td>{{$exam->cil_oe}}</td>
                                                <td>{{$exam->eix_oe}}</td>
                                                <td>{{$exam->dnp_oe}}</td>
                                                <td>{{$exam->alt_oe}}</td>
                                            </tr>
                                            <tr>
                                                <td>Adição</td>
                                                <td>{{$exam->adicao}}</td>
                                                <td>Responsável</td>
                                                <td>{{$exam->responsavel}}</td>
                                                <td>Tipo de Lente</td>
                                                <td>{{$exam->tipo_lente}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    @endforeach
                                    @endif

                </div>
                            <div align="right">
                                <div class="col-md-6 col-sm-6 form-group has-feedback"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>Total <strong>R$</strong></h6><input type="text" disabled id="total_sem_desconto" value="{{$clientEdit->final_value}}"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>Desconto(%)</h6><input type="text" id="desconto_venda" name="discount" value="{{$clientEdit->discount}}" disabled></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>Pago <strong>R$</strong></h6><input type="text" disabled id="total" name="total_com_desconto" value="{{number_format(((str_replace(',','.',(str_replace('.','', $clientEdit->final_value))))-((((str_replace(',','.',(str_replace('.','', $clientEdit->final_value))))))* $clientEdit->discount /100)),2,',','.')}}"></div>
                            </div>
                            <div id="pag" align="right">
                                <h3><span class="label label-default">{{$clientEdit->payment_description}}</span></h3>
                                <br>
                                @if($clientEdit->payment_type==0)
                                    <a href="{{route('reports.sales')}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Imprimir Comprovante de Pagamento"></i>&nbsp;&nbsp;&nbsp;Comprovante de Pagamento</a>
                                @endif
                                @if($clientEdit->payment_type==1)
                                    <a href="{{route('reports.contrato', $clientEdit->id)}}" target="_blank" class="btn btn-success"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Inprimir Contrato de Parcelamento"></i>&nbsp;&nbsp;&nbsp;Contrato</a>
                                    <a href="{{route('sales.carne', $clientEdit->id)}}" target="_blank" class="btn btn-primary"><i class="fa fa-print"  data-toggle="tooltip" data-placement="top" title="Gerar Carnê de Pagamento"></i>&nbsp;&nbsp;&nbsp;Gerar Carnê</a>
                                @endif
                            </div>
            </div>
        </div>
    </div>
@endsection
