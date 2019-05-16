
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
</head>

<body class="nav-md" style="font-family: K2D, sans-serif">
@if(\App\CashDeskModel::all()->where('company_id',\Illuminate\Support\Facades\Auth::user()->company_id)=='[]')
{{\App\Http\Controllers\CashDeskController::firstCash()}}
@endif
@if((\App\CashDeskModel::orderBy('id', 'desc')->where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->select('status')->first())->status==1)
    <script language= "JavaScript">
        location.href="{{route('cash_desk.new')}}"
    </script>
@endif

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
                    <a href="{{route('home')}}"><img src="{{ asset('assets/img/fundo-min.png') }}" width="100%"></a>
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
                            @if(\Illuminate\Support\Facades\Auth::user()->email == 'atd@atdsistemas.com.br')
                                <li><a><i class="fa fa-users"></i> ATD Sistemas  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('company.index')}}">Empresas</a></li>
                                        <li><a href="{{route('groups.index')}}">Grupos de Usuarios</a></li>
                                        <li><a href="{{route('users.indexall')}}">Usuários</a></li>
                                    </ul>
                                </li>
                            @else
                            <li><a><i class="fa fa-book"></i> Cadastros <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('clients.index')}}">Clientes</a></li>
                                    <li><a href="{{route('providers.index')}}">Fornecedores</a></li>
                                    <li><a href="{{route('products_group.index')}}">Grupos de Produtos</a></li>
                                    <li><a href="{{route('products.index')}}">Produtos</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-shopping-bag"></i> Vendas  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('sales.new')}}">Nova Venda</a></li>
                                    <li><a href="{{route('sales.index')}}">Vendas</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-connectdevelop"></i> Compras  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('purchases.index')}}">Compras</a></li>
                                    <li><a href="{{route('ticket.index')}}">Gerador de Etiquetas</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-dollar"></i> Financeiro  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('cash_desk.index')}}">Caixa</a></li>
                                    <li><a href="{{route('inout.index')}}">Entradas e Saídas</a></li>
                                    <li><a href="{{route('bills.index', 'pay')}}">Contas a Pagar</a></li>
                                    <li><a href="{{route('bills.index', 'receive')}}">Contas a Receber</a></li>
                                    <li><a href="{{route('debit.index')}}">Débito de Cliente</a></li>
                                    <li><a href="{{route('movements.indexsem')}}">Fluxo de Caixa</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-users"></i> Usuários  <span style="float: right" class="glyphicon glyphicon-menu-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('users.new')}}">Novo Usuário</a></li>
                                    <li><a href="{{route('users.index')}}">Exibir Usuários</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div style="width: 100%" align="center">
                    <a href="{{route('logout')}}" style="width: 80%" class="btn btn-danger">Sair</a>
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
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a>
                                    @foreach(\App\ModelCompany::all()->where('id', \Illuminate\Support\Facades\Auth::user()->company_id) as $empresa)
                                        {{$empresa->name}}
                                        @endforeach
                                    </a></li>
                                <li><a><strong>{{\Illuminate\Support\Facades\Auth::user()->email}}</strong></a></li>
                                <li><a  href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Sair do Sistema</a></li>
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
</body>
</html>
