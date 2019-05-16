@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Adicionar Ítens</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h3>Fornecedor:
                        @foreach(\App\ProvidersModel::all()->where('id',$clientEdit->provider_id) as $dado)
                            <strong>{{$dado->fantasy_name}}</strong>
                        @endforeach</h3>
                    <h5>Número da Nota: {{$clientEdit->note_number}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($clientEdit->date)->format('d/m/Y')}}</h5>
                    <div>
                        <form action="{{route('products_purchases.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                            <div class="col-md-4 col-sm-4 col-xs-11 form-group has-feedback">
                                <h6>Selecione o Produto...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="product_id" required>

                                    @foreach(\App\ProductsModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $user)
                                        <option value="{{$user->id}}">{{$user->name}}  ►  {{$user->code}} • {{$user->barcode}} ► R$ {{$user->sale_value}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('products.new')}}" class="btn btn-default" >+</a>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-6 form-group has-feedback">
                                <h6>Preço de Compra (R$)</h6>
                                <input id="valor_und_compra" type="text" class="form-control has-feedback-left" value="0,00" onKeyPress="return(moeda(this,'.',',',event));" onkeyup="calcular_preco_final_compra()" name="price" required>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-6 form-group has-feedback">
                                <h6>Quantidade</h6>
                                <input id="qtd_compra" type="number" class="form-control has-feedback-left" name="qtd" value="0" onkeyup="calcular_preco_final_compra()" onclick="calcular_preco_final_compra()" required>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-6 form-group has-feedback">
                                <h6>Total (R$)</h6>
                                <input id="valor_total_compra_und" type="text" class="form-control has-feedback-left" value="0,00" disabled>
                            </div>
                            <input type="hidden" name="purchase_id" value="{{$clientEdit->id}}">

                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <button class="btn btn-dark" type="submit">+</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
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
                    <a class="btn btn-dark" href="{{route('purchases.update', $clientEdit->id)}}">Concluir Compra</a>
                </div>
            </div>
        </div>
    </div>

@endsection
