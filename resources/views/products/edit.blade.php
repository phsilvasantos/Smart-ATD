@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Novo Produto</h2>
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
                    <div>
                        <form action="{{route('products.update', ['clientModel' => $clientEdit->id])}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                                <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Produto</h6>
                                    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" value="{{$clientEdit->name}}" placeholder="Produto" required>
                                </div>

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Referência</h6>
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="code" value="{{$clientEdit->code}}" placeholder="Referência" required>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Código de Barras</h6>
                                <input type="number" class="form-control has-feedback-left" id="inputSuccess2" name="barcode" value="{{$clientEdit->barcode}}" placeholder="Código de Barras" required>
                            </div>

                            <div class="col-md-3 col-sm-5 col-xs-11 form-group has-feedback">
                                <h6>Selecione outro grupo...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="product_group_id" required>
                                    <option value="{{$clientEdit->product_group_id}}">
                                        @foreach(\App\ProductsGroupModel::all()->where('id',$clientEdit->product_group_id) as $dado)
                                            {{$dado->name}}
                                        @endforeach
                                    </option>

                                    @foreach(\App\ProductsGroupModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('products_group.new')}}" class="btn btn-dark">+</a>
                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-11 form-group has-feedback">
                                <h6>Selecione outro fornecedor...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name=provider_id required>
                                    <option value="{{$clientEdit->provider_id}}">
                                        @foreach(\App\ProvidersModel::all()->where('id',$clientEdit->provider_id) as $dado)
                                            {{$dado->fantasy_name}}
                                        @endforeach
                                    </option>

                                    @foreach(\App\ProvidersModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $user)
                                        <option value="{{$user->id}}">{{$user->fantasy_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('providers.new')}}" class="btn btn-dark">+</a>
                            </div>

                                <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Emite NF-e?...</h6>
                                    <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nfe" required>
                                        @if($clientEdit->nfe == 0)
                                            <option value="0">Não</option>
                                            @else
                                            <option value="1">Sim</option>
                                            @endif
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>


                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Preço de Custo (R$)</h6>
                                <input type="text" class="form-control has-feedback-left" name="cost_value" id="valor_custo" placeholder="Custo R$" onKeyPress="return(moeda(this,'.',',',event));" value="{{$clientEdit->cost_value}}" onkeyup="margem();" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Impostos (%)</h6>
                                <input type="text" class="form-control has-feedback-left" name="taxes" id="imposto" placeholder="Impostos %" onkeyup="margem();" value="{{$clientEdit->taxes}}" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Margem de Lucro (%)</h6>
                                <input id="lucro" type="text" class="form-control has-feedback-left" placeholder="Lucro %" name="margin" onkeyup="margem();" value="{{$clientEdit->margin}}" required>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <h6>Preço de Venda (R$)</h6>
                                <input id="valor_venda" type="text" class="form-control has-feedback-left" name="sale_value" placeholder="Venda R$" onKeyPress="return(moeda(this,'.',',',event))" value="{{$clientEdit->sale_value}}" onkeyup="margem_percent();" required>
                            </div>


                            <div style="width: 100%; padding: 5px" align="right">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
