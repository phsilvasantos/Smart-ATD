@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nova Compra</h2>
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
                        <form action="{{route('purchases.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                            <div class="col-md-4 col-sm-4 col-xs-11 form-group has-feedback">
                                <h6>Selecione o fornecedor...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="provider_id" required>

                                    @foreach(\App\ProvidersModel::where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->orderBy('fantasy_name', 'ASC')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->fantasy_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('providers.new')}}" class="btn btn-dark">+</a>
                            </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Data da Compra</h6>
                                    <input type="date" class="form-control has-feedback-left" name="date" required>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                                    <h6>Nº da Nota</h6>
                                    <input type="text" class="form-control has-feedback-left" name="note_number" required>
                                </div>

                            <div style="width: 100%; padding: 5px" align="right">
                                <button type="submit" class="btn btn-success">Adicionar Ítens</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
