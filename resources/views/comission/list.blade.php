@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Comissões</h2>
                    <div class="clearfix"></div>
                    <p>
                        Início: {{\Carbon\Carbon::parse($start)->format('d/m/Y')}}  -   Fim: {{\Carbon\Carbon::parse($final)->format('d/m/Y')}}
                    </p>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Valor Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\User::all()->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id) as $dado)
                        <tr>
                            <td>{{$dado->name}}</td>

                            @php
                                $valores =  \App\ComissaoModel::where('user_id', $dado->id)->whereBetween('created_at', array($start.' 00:00:00', $final.' 23:59:59'))->get();
                                $finalvalor=0;
                            foreach ($valores as $valor){
                                $finalvalor = $finalvalor + str_replace(',','.',$valor->value);
                            }
                            @endphp

                            <td>
                                @php
                                echo 'R$ '. number_format(str_replace(',', '.', $finalvalor),2,',','.');
                                @endphp
                            </td>
                            <td style="font-size: 15px" align="center">
                                <form action="{{route('comission.view')}}" method="post" target="_blank">
                                    {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$dado->id}}">
                                        <input type="hidden" name="start" value="{{$start}}">
                                        <input type="hidden" name="final" value="{{$final}}">
                                        <button type="submit" class="btn btn-success">Detalhes</button>
                                </form>
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
