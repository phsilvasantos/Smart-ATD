@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Gerador de Etiquetas</h2>
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
                        <form action="{{route('pdf')}}" method="post" target="_blank">
                            {{csrf_field()}}
                            <div class="col-md-6 col-sm-6 col-xs-11 form-group has-feedback">
                                <h6>Selecione o Produto...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="produto" required>

                                    @foreach(\App\ProductsModel::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-11 form-group has-feedback">
                                <h6>Tipo de Etiqueta...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="tipo" required>
                                        {{--<option value="0">Etiqueta de Produto (Folha 80mm)</option>--}}
                                        {{--<option value="1">Etiqueta de Produto (Folha A4 - 2 Colunas)</option>--}}
                                        <option value="2">Etiquetas em Folhas A4 (3x3)</option>
                                        <option value="3">Etiquetas em Folhas A4 (4x3)</option>
                                        <option value="4">Etiquetas em Folhas A4 (5x4)</option>
                                </select>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-6 form-group has-feedback">
                                <h6>Quantidade</h6>
                                <input id="qtd_compra" type="number" class="form-control has-feedback-left" name="qtd" required>
                            </div>


                            <div class="col-md-3 col-sm-3 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <button class="btn btn-dark" type="submit">Gerar Etiqueta</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
