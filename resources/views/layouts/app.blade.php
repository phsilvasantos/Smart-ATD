<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart ATD</title>
    <link rel="shortcut icon" href="{{{ asset('assets/img/icon.png') }}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />--}}
    <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">
    <script language="javascript">
        function moeda(a, e, r, t) {
            let n = ""
                , h = j = 0
                , u = tamanho2 = 0
                , l = ajd2 = ""
                , o = window.Event ? t.which : t.keyCode;
            if (13 == o || 8 == o)
                return !0;
            if (n = String.fromCharCode(o),
            -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.length,
                     h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
                ;
            for (l = ""; h < u; h++)
                -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
            0 == (u = l.length) && (a.value = ""),
            1 == u && (a.value = "0" + r + "0" + l),
            2 == u && (a.value = "0" + r + l),
            u > 2) {
                for (ajd2 = "",
                         j = 0,
                         h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                        ajd2 += l.charAt(h),
                        j++;
                for (a.value = "",
                         tamanho2 = ajd2.length,
                         h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }

        function margem(){
            var precoa = document.getElementById("valor_custo").value.replace('.','');
            var preco =  parseFloat(precoa.replace(',','.'));
            var porcentagem =   parseFloat(document.getElementById("lucro").value.replace(',','.'));
            var porcentagem2 = parseFloat(document.getElementById("imposto").value.replace(',','.'));
            if(isNaN(preco)){
                document.getElementById("valor_custo").value = '0,00';
                preco='0.00';
            }
            if(isNaN(porcentagem)){
                document.getElementById("lucro").value = '0';
                porcentagem=0;
            }
            if(isNaN(porcentagem2)){
                document.getElementById("imposto").value = '0';
                porcentagem2=0;
            }
            var total = (preco * (porcentagem2/100))+preco;
            var total2= (total * (porcentagem/100))+total;
            document.getElementById("valor_venda").value = ((total2.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})).replace('R$','')).replace(/^\s+|\s+$/g,"");
        }
        function margem_percent(){
            var precoa = document.getElementById("valor_custo").value.replace('.','');
            var preco =  parseFloat(precoa.replace(',','.'));
            var porcentagem = parseFloat(document.getElementById("imposto").value.replace(',','.'));
            if(isNaN(porcentagem)){
                document.getElementById("imposto").value = '0';
                porcentagem=0;
            }
            var total = (preco * (porcentagem/100))+preco;

            var precob = document.getElementById("valor_venda").value.replace('.','');
            var valor =  parseFloat(precob.replace(',','.'));

            document.getElementById("lucro").value = (((valor*100)/total)-100).toFixed(2);
        }

        function calcular_preco_final_compra() {
            var precoa = document.getElementById("valor_und_compra").value.replace('.','');
            var preco =  parseFloat(precoa.replace(',','.'));
            var qtd = parseFloat(document.getElementById("qtd_compra").value.replace(',','.'));
            var total = preco * qtd;
            document.getElementById("valor_total_compra_und").value = total.toFixed(2).replace('.',',');
            var qtd2 = parseFloat(document.getElementById("qtd_compra").value.replace(',','.'));
            document.getElementById("qtd_compra").value = qtd2;
        }
    </script>
    <script src="{{ asset('Chart.js') }}"></script>
    <style>
        .load {
            background-color: rgba(255,255,255,1);
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left:-100px;
            margin-top:-100px;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("carregando").style.display = "none";
            document.getElementById("tudo").style.display = "block";
        });
    </script>
    <script type="text/javascript">
        function carregar(){
            document.getElementById("carregando").style.display = "block";
            document.getElementById("tudo").style.display = "none";
        };
    </script>
</head>
<body class="nav-md" style="font-family: K2D, sans-serif; background-color: white">
<div id="carregando" class="load" align="center">
    <h2 style="margin-bottom: 0px; font-size: 40px">Smart <strong style="color:#941012">ATD</strong></h2>
    <h5>www.atdsistemas.com.br</h5>
    <img src="{{ asset('assets/img/carregando.gif') }}" width="200px" height="200px">
</div>
@php
$acesso = \App\ModelUserType::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->user_type_id)->first();
@endphp
@if(\App\CashDeskModel::all()->where('company_id',\Illuminate\Support\Facades\Auth::user()->company_id)=='[]')
{{\App\Http\Controllers\CashDeskController::firstCash()}}
@endif
@if((\App\CashDeskModel::orderBy('id', 'desc')->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('status')->first())->status==1)
    <script language= "JavaScript">
        location.href="{{route('cash_desk.new')}}"
    </script>
@endif
@if((\App\CashDeskModel::orderBy('id', 'desc')->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('status')->first())->status==0 && date("Y-m-d H:i:s") > date_add((\App\CashDeskModel::orderBy('id', 'desc')->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('created_at')->first())->created_at, date_interval_create_from_date_string('1 day')) && \Illuminate\Support\Facades\Auth::user()->company_id!=1)
        <div class="alert-warning" role="alert" style="margin: 0; padding: 10px" align="center">
            <a href="{{route('cash_desk.close')}}" class="alert-link" style="color: white; font-size: 16px; margin: 0px">Caixa aberto a mais de 24hs, <span style="font-size: 12px; color: darkred">clique aqui para fechar o caixa atual!</span></a>
        </div>
@endif
@if(date("Y-m-d") == (\App\ModelCompany::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('licensing')->first())->licensing && \Illuminate\Support\Facades\Auth::user()->company_id != 1)
    <div class="alert-danger" role="alert" style="margin: 0; padding: 10px" align="center">
        <a class="alert-link" style="color: white; font-size: 16px; margin: 0px">Licença de Software vence hoje!, entre em contato com o administrador do sistema.</a>
    </div>
@elseif(date("Y-m-d") > (\App\ModelCompany::orderBy('id', 'desc')->where('id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('licensing')->first())->licensing && \Illuminate\Support\Facades\Auth::user()->company_id != 1)
    <script language= "JavaScript">
        location.href="{{route('licensing.expired')}}"
    </script>
@endif

<div id="tudo" style="display: none" class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
                    <a onclick="carregar()" href="{{route('home')}}"><img src="{{ asset('assets/img/fundo-min.png') }}" width="100%"></a>
                </div>

                <div class="clearfix"></div>
                <br />
                <!-- sidebar menu -->
                <br />
                <div class="profile clearfix">
                    <div style="width: 100%" align="center">
                        <div class="profile_info" style="width: 100%">
                            <span>Bem Vindo(a),</span>
                            <h2>{{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
                        </div>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="font-size: 16px; font-style: inherit">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            @if(\Illuminate\Support\Facades\Auth::user()->id == 1)
                                    <ul style="color:rgba(212,22,28,0.97)">
                                        <li style="margin-top: 5px"><a onclick="carregar()" style="color: white" href="{{route('company.index')}}">Empresas</a></li>
                                        <li style="margin-top: 5px"><a onclick="carregar()" style="color: white" href="{{route('licensing.index')}}">Licença de Software</a></li>
                                    </ul>
                            @else
                            <li><a><i class="fa fa-book"></i> Cadastros <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                        @if($acesso->crud_cliente ==1)
                                    <li><a onclick="carregar()" href="{{route('clients.index')}}">Clientes</a></li>
                                        @endif
                                        @if($acesso->crud_fornecedor ==1)
                                    <li><a onclick="carregar()" href="{{route('providers.index')}}">Fornecedores</a></li>
                                        @endif
                                        @if($acesso->crud_grupo_produtos ==1)
                                    <li><a onclick="carregar()" href="{{route('products_group.index')}}">Grupos de Produtos</a></li>
                                        @endif
                                        @if($acesso->crud_produtos ==1)
                                    <li><a onclick="carregar()" href="{{route('products.index')}}">Produtos</a></li>
                                            @endif
                                </ul>
                            </li>
                            <li><a><i class="fa fa-shopping-bag"></i> Vendas <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    @if($acesso->realizar_venda ==1)
                                    <li><a onclick="carregar()" href="{{route('sales.new')}}">Nova Venda</a></li>
                                    <li><a onclick="carregar()" href="{{route('sales.index')}}">Vendas</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li><a><i class="fa fa-connectdevelop"></i> Compras  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    @if($acesso->realizar_compra ==1)
                                    <li><a onclick="carregar()" href="{{route('purchases.index')}}">Compras</a></li>
                                    @endif
                                    @if($acesso->gerar_etiqueta ==1)
                                    <li><a onclick="carregar()" href="{{route('ticket.index')}}">Gerador de Etiquetas</a></li>
                                        @endif

                                </ul>
                            </li>
                            <li><a><i class="fa fa-dollar"></i> Financeiro  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">

                                    @if($acesso->visualizar_caixa ==1)
                                    <li><a onclick="carregar()" href="{{route('cash_desk.index')}}">Caixa</a></li>
                                    @endif
                                    @if($acesso->entrada_saida ==1)
                                    <li><a onclick="carregar()" href="{{route('inout.index')}}">Entradas e Saídas</a></li>
                                        @endif
                                        @if($acesso->contas_pagar ==1)
                                    <li><a onclick="carregar()" href="{{route('bills.index', 'pay')}}">Contas a Pagar</a></li>
                                        @endif
                                        @if($acesso->contas_receber ==1)
                                    <li><a onclick="carregar()" href="{{route('bills.index', 'receive')}}">Contas a Receber</a></li>
                                        @endif
                                        @if($acesso->debito_cliente ==1)
                                    <li><a onclick="carregar()" href="{{route('debit.index')}}">Débito de Cliente</a></li>
                                        @endif
                                        @if($acesso->fluxo_caixa ==1)
                                    <li><a onclick="carregar()" href="{{route('movements.indexsem')}}">Fluxo de Caixa</a></li>
                                        @endif

                                </ul>
                            </li>
                            <li><a><i class="fa fa-users"></i> Usuários  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">

                                    @if($acesso->crud_usuarios==1)
                                    <li><a onclick="carregar()" href="{{route('users.new')}}">Novo Usuário</a></li>
                                    <li><a onclick="carregar()" href="{{route('users.index')}}">Exibir Usuários</a></li>
                                    @endif
                                    <li><a onclick="carregar()" href="{{route('comission.index')}}">Comissões</a></li>

                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div style="width: 100%" align="center">
                    <a onclick="carregar()" href="{{route('logout')}}" style="width: 80%" class="btn btn-danger">Sair</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            @if(\Illuminate\Support\Facades\Auth::user()->company_id != 1)
                                @if($acesso->crud_cliente ==1)
                            <a onclick="carregar()" href="{{route('clients.index')}}" style="display: inline-block" data-toggle="tooltip" data-placement="bottom" title="Clientes"><span style="font-size: 15px" class="glyphicon glyphicon-user"></span></a>
                                @endif
                                @if($acesso->crud_produtos ==1)
                            <a onclick="carregar()" href="{{route('products.index')}}" style="display: inline-block"  data-toggle="tooltip" data-placement="bottom" title="Produtos"><span style="font-size: 15px" class="glyphicon glyphicon-barcode"></span></a>
                                @endif
                                @if($acesso->realizar_venda ==1)
                            <a onclick="carregar()" href="{{route('sales.new')}}" style="display: inline-block"  data-toggle="tooltip" data-placement="bottom" title="Nova Venda"><span style="font-size: 15px" class="glyphicon glyphicon-shopping-cart"></span></a>
                                @endif
                            @endif
                            <a  style="display: inline-block" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span style="font-size: 15px; color: rgba(122,12,15,0.97)" class="glyphicon glyphicon-lock"></span>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a><strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong></a></li>
                                <li><a>
                                    @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
                                        {{$empresa->name}}
                                        <br>
                                                @if($acesso->name =='administrador')
                                            <span style="color: darkred">Sua licença expira em {{\Carbon\Carbon::parse($empresa->licensing)->format('d/m/y')}}</span>
                                                @endif
                                                @endforeach
                                    </a></li>
                                <li><a><strong>{{\Illuminate\Support\Facades\Auth::user()->email}}</strong></a></li>
                                <li><a onclick="carregar()"  href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Sair do Sistema</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 1000px">
            <!-- top tiles -->
            <div class="content" style="margin-top: 70px">
                @include('flash::message')
                <main class="py-4">
                    @yield('content')
                </main>
            </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                <a href="http://atdsistemas.com.br" target="_blank"><strong>ATD</strong> Sistemas</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/DateJS/build/date.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
<script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('build/js/custom.min.js') }}"></script>
<script>
    $('#flash-overlay-modal').modal();
</script>


</body>
</html>
