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
                    <h1>
                        @php
                            $a = 1;
                        @endphp
                        @foreach($clients as $client)
                            @foreach(\App\ModelCompany::all()->where('id', $client->company_id) as $empresa)
                                @php
                                if($a==1){
                                echo $empresa->name;
                                $a=2;
                                }
                                @endphp
                            @endforeach
                        @endforeach
                    </h1>
                    <h2>Licenças de Software</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">

                        <div class="x_content">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Renovado em</th>
                                    <th>Data de Expiração</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($client->created_at)->format('d/m/y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($client->licensing)->format('d/m/y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
