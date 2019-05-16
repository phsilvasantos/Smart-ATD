@extends('layouts.app')
@php
    $acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
@endphp
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if('dados'=='[]')
                <h2>Sem Comissões de Usuário</h2>
                @else
            <div class="x_panel">
                <div class="x_title">
                        @php
                        $name = '';
                        @endphp
                    <h2>Comissões -
                        @foreach($dados as $dado)
                        @foreach(\App\User::all()->where('id',$dado->user_id) as $dd)
                            @php
                            $name = $dd->name;
                            @endphp
                        @endforeach
                        @endforeach
                        @php
                            echo $name;
                        @endphp
                    </h2>
                    <div class="clearfix"></div>
                    <p>
                        {{$rel}}
                    </p>
                </div>
                <div class="x_content">
                    <h3>Histórico de Comissões</h3>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Venda</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $valor_total=0;
                        @endphp
                        @foreach($dados as $dado)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($dado->created_at)->format('d/m/y - H:i')}}</td>
                                    <td>
                                        {{$dado->description}}
                                    </td>
                                    <td>

                                        <a target="_blank" href="{{route('sales.view', $dado->sale_id)}}"  data-toggle="tooltip" data-placement="top" title="Detalhes da Venda">
                                            <span class="label label-primary">Venda - {{$dado->sale_id}}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('clients.view', $dado->client_id)}}"  data-toggle="tooltip" data-placement="top" title="Dados do Cliente">
                                            <span class="label label-success">
                                        @foreach(\App\ClientsModel::all()->where('id',$dado->client_id) as $dd)
                                            {{$dd->name}}
                                        @endforeach
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        R$ {{number_format(str_replace(',', '.', $dado->value),2,',','.')}}
                                    </td>
                                </tr>
                                @php
                                    $valor_total = $valor_total + str_replace(',', '.', $dado->value);
                                @endphp
                        @endforeach
                        </tbody>
                    </table>
                        <h2>Valor Total: <strong>
                                @php
                                    echo 'R$ '. number_format(str_replace(',', '.', $valor_total),2,',','.');
                                @endphp
                            </strong></h2>
                    </div>
                </div>
            </div>
                @endif
        </div>
    </div>

@endsection
