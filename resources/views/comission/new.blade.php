@php
    $acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
@endphp

@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Comissões de Usuário</h2>
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
                        <form action="{{route('comission.view')}}" method="post">
                            {{csrf_field()}}
                            @if($acesso->crud_usuarios==1)
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                    <h6>Selecione o vendedor...</h6>
                                    <select type="text" class="form-control has-feedback-left" id="inputSuccess2" name="id" required>
                                            <option></option>
                                            <option value="0">TODOS</option>
                                        @foreach(\App\User::where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->orderBy('name', 'ASC')->get() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            @endif

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                    <p>Data Inicial</p>
                                    <input type="date" class="form-control has-feedback-left" id="inputSuccess2" name="start" required>
                                </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <p>Data Inicial</p>
                                <input type="date" class="form-control has-feedback-left" id="inputSuccess2" name="final" required>
                            </div>



                            <div style="width: 100%; padding: 5px" align="right">
                                <button type="submit" class="btn btn-success">Ver Comissão</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
