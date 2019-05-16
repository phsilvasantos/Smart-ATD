@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div style="width: 100%;" align="right">
                    <a style="margin-right: 10px" href="{{route('reports.purchase', $clientEdit->id)}}" class="btn btn-default" target="_blank"  data-toggle="tooltip" data-placement="top" title="Imprimir Compra">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <div class="x_content">
                    <h3>Fornecedor:
                        @foreach(\App\ProvidersModel::all()->where('id',$clientEdit->provider_id) as $dado)
                            <strong>{{$dado->fantasy_name}}</strong>
                        @endforeach</h3>
                    <h5>Número da Nota: {{$clientEdit->note_number}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($clientEdit->date)->format('d/m/Y')}}</h5>
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Preço Custo</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\ProductsPurchasesModel::all()->where('purchase_id', $clientEdit->id) as $client)
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
                                <td style="font-size: 15px" align="center">
                                    <a href="{{route('products_purchases.remove', $client->id)}}">
                                        <i class="fa fa-remove" style="color: darkred"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
