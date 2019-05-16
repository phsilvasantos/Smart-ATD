@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->company_id !=1)
        <script language= "JavaScript">
            location.href="{{route('home')}}"
        </script>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Licenças de Software</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nome / Razão Social</th>
                            <th>Data de Expiração</th>
                            <th>Renovar Licença</th>
                            <th>Histórico</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            @if($client->id==1)
                                @else
                        <tr>
                            <td>{{$client->name}} / {{$client->razao}}</td>
                            <td>{{\Carbon\Carbon::parse($client->licensing)->format('d/m/y')}}</td>
                                <form action="{{route('licensing.update', ['licensing' => $client->id])}}" method="post">
                            {{csrf_field()}}
                            <td>
                                <input type="hidden" class="form-control" value="{{$client->id}}" name="company_id">
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <input type="date" class="form-control" name="licensing">
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i></button>
                                    </div>
                                </div>
                            </td>
                            </form>
                            <td align="center">
                                <a href="{{route('licensing.all', $client->id)}}"><i style="font-size: 15px; margin-top: 13px" class="glyphicon glyphicon-search"></i></a></td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
