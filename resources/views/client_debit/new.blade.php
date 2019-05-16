@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Débito de Cliente</h2>
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
                        <form action="{{route('debit.search')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                                <h6>Selecione o Cliente...</h6>
                                <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="client_id" required>
                                    @foreach(\App\ClientsModel::where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->orderBy('name', 'ASC')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}} - {{$user->cpf}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback"align="right">
                                <h6>&nbsp;</h6>
                                <button type="submit" class="btn btn-success">Listar Débitos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
