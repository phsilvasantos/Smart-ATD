@extends('layouts.app')

@section('content')

    <script>
        function desconto(){
        var precoa = document.getElementById("total_sem_desconto").value.replace('.','');
        var preco = parseFloat(precoa.replace(',','.'));
        var porcentagem = parseFloat(document.getElementById("desconto_venda").value.replace(',','.'));
        if(isNaN(porcentagem)){
        document.getElementById("desconto_venda").value = '0';
        porcentagem=0;
        }
        var total2= preco - (preco * (porcentagem/100));
        document.getElementById("total").value = ((total2.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})).replace('R$','')).replace(/^\s+|\s+$/g,"");
        }
        function alteraPonto(valorInput) {
            $(valorInput).val(valorInput.val().replace(",", "."));
            calcular_preco_final_compra()
        }
    </script>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                    <h2 style="font-style: italic">Adicionar Ítens</h2>

                <div class="x_content">
                    <h3>Cliente:
                        @foreach(\App\ClientsModel::all()->where('id',$clientEdit->client_id) as $dado)
                            <strong>{{$dado->name}}</strong>
                        @endforeach</h3>
                    <h5>Venda: {{\Carbon\Carbon::parse($clientEdit->date)->format('Ymd')}}{{$clientEdit->id}}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Data da Compra: {{\Carbon\Carbon::parse($clientEdit->created_at)->format('d/m/Y')}}</h5>
                    <div>
                        <form action="{{route('products_sales.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                            <input type="hidden" name="sale_id" value="{{$clientEdit->id}}">
                            <div class="col-md-4 col-sm-4 col-xs-11 form-group has-feedback">
                                <h6>Selecione o Produto...</h6>
                                <select type="text" class="form-control has-feedback-left" id="selecionado" name="product_id" required>
                                    <option></option>
                                    @foreach(\App\ProductsModel::where('company_id', \Illuminate\Support\Facades\Auth::user()->company_id)->orderBy('name', 'ASC')->get() as $user)
                                        <option value="{{$user->id}}">{{$user->name}} - R$ {{$user->sale_value}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <a href="{{route('products.new')}}" class="btn btn-default" >+</a>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                <h6>Valor</h6>
                                <input id="price" type="text" class="form-control has-feedback-left" name="price" onKeyPress="return(moeda(this,'.',',',event));" required>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-6 form-group has-feedback">
                                <h6>Quantidade</h6>
                                <input type="text" class="form-control has-feedback-left" name="qtd" value="1" onkeyup="alteraPonto($(this))" required>
                            </div>

                            <input type="hidden" name="purchase_id" value="{{$clientEdit->id}}">

                            <div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
                                <h6>&nbsp;</h6>
                                <button class="btn btn-dark" style="width: 100%" type="submit">+ &nbsp;&nbsp;&nbsp;Adicionar</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\ProductsSalesModel::all()->where('sale_id', $clientEdit->id) as $client)
                            <tr>
                                @foreach(\App\ProductsModel::all()->where('id',$client->product_id) as $dado)
                                    <td>{{$dado->code}}</td>
                                    <td>{{$dado->name}}</td>
                                @endforeach
                                <td>{{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price))), 2, ',', '.') }}</td>
                                <td>{{$client->qtd}}</td>
                                <td>
                                    {{  'R$ '.number_format((str_replace(',','.',str_replace('.','',$client->price)) * $client->qtd), 2, ',', '.') }}
                                </td>
                                <td style="font-size: 15px" align="center">
                                    <a href="{{route('products_sales.remove', $client->id)}}">
                                        <i class="fa fa-remove" style="color: darkred"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>




                </div>

                @if($clientEdit->final_value=='0,00')
                    <h4>Nenhum ítem nas compras!</h4>
                @else

                        <h2 style="font-style: italic">Pagamento</h2>
                    <div class="x_content">

                        <form action="{{route('sales.update')}}" method="post">

                            <div align="right">
                                <div class="col-md-6 col-sm-6 form-group has-feedback"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>Total <strong>R$</strong></h6><input type="text" disabled id="total_sem_desconto" value="{{$clientEdit->final_value}}"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>Desconto(%)</h6><input type="text" id="desconto_venda" name="discount" value="0" onkeyup="desconto()" onkeydown="limpar()"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"><h6>A Pagar <strong>R$</strong></h6><input type="text" disabled id="total" name="total_com_desconto" value="{{$clientEdit->final_value}}"></div>
                            </div>

                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{\Illuminate\Support\Facades\Auth::user()->company_id}}">
                            <input type="hidden" name="sale_id" value="{{$clientEdit->id}}">
                            <div class="col-md-5 col-sm-5 col-xs-11 form-group has-feedback">
                                <h6>Selecione a Forma de Pagamento...</h6>
                                <select type="text" class="form-control has-feedback-left" id="tipopagamento" name="tipopagamento" required onchange="ver()">
                                    <option></option>

                                    <option value="0">À Vista</option>
                                    <option value="1">Crediário</option>
                                    <option value="2">Cartão de Débito</option>
                                    <option value="3">Cartão de Crédito</option>

                                </select>
                            </div>
                            <div id="pag"></div>

                        <div style="width: 100%" align="right">
                            <button id="confirmPag" type="submit" class="btn btn-success" style="display: none">Confirmar Pagamento</button>
                        </div>
                        </form>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        function ver() {
            document.getElementById("confirmPag").style.display="block";
            var option = document.getElementById("tipopagamento").value;
            if(option==0){
                document.getElementById("pag").innerHTML="";
                exibirAvista();
                document.getElementById("confirmPag").innerText="Finalizar Venda";
            }
            if(option==1){
                document.getElementById("pag").innerHTML="";
                exibirCrediario();
                document.getElementById("confirmPag").innerText="Gerar Carnê de Pagamento";
            }
            if(option==2){
                document.getElementById("pag").innerHTML="";
                exibirCartaoDebito();
                document.getElementById("confirmPag").innerText="Confirmar Pagamento em Débito";
            }
            if(option==3){
                document.getElementById("pag").innerHTML="";
                exibirCartaoCredito();
                document.getElementById("confirmPag").innerText="Confirmar Pagamento com Cartão de Crédito";
            }
        }
        function limpar() {
            document.getElementById("pag").innerHTML="";
            document.getElementById("tipopagamento").value='';
        }
        function exibirCrediario() {
            var nova = document.getElementById("pag");
            var novadiv = document.createElement("div");
            novadiv.innerHTML = "<div id='ent_vl' class='col-md-3 col-sm-3 col-xs-12 form-group has-feedback'>\n<h6>Valor da Entrada</h6>\n<input type='text' class='form-control has-feedback-left' value='0,00' onKeyPress=\"return(moeda(this,'.',',',event));\" onkeyup='calcular_parcelas()' name='valor_entrada' id='valor_entrada' /></div>" +
                "<div id='qtd_pcl' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Nº de Parcelas</h6>\n<select type=\"text\" class=\"form-control has-feedback-left\" id=\"qtd_parcelas\" name=\"qtd_parcelas\" required onchange=\"calcular_parcelas()\"><option value='1'>1x</option><option value='2'>2x</option><option value='3'>3x</option><option value='4'>4x</option><option value='5'>5x</option><option value='6'>6x</option><option value='7'>7x</option><option value='8'>8x</option><option value='9'>9x</option><option value='10'>10x</option><option value='11'>11x</option><option value='12'>12x</option></select></div>" +
                "<div id='pcl_vl' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Valor da Parcela</h6>\n<input type='text' class='form-control has-feedback-left' value='0,00' name='valor_parcela' id='valor_parcela' disabled/></div>";

            nova.appendChild(novadiv);
            calcular_parcelas();
        }
        function exibirAvista() {
            var nova = document.getElementById("pag");
            var novadiv = document.createElement("div");
            novadiv.innerHTML = "<div id='av' class='col-md-7 col-sm-7 col-xs-12 form-group has-feedback'><br><h3><strong>Forma de Pagamento à vista</strong></h3>\n</div>";
            nova.appendChild(novadiv);
        }
        function exibirCartaoCredito() {
            var nova = document.getElementById("pag");
            var novadiv = document.createElement("div");
            novadiv.innerHTML = "<div id='cc' class='col-md-3 col-sm-3 col-xs-12 form-group has-feedback'>\n<h6>Valor da Entrada</h6>\n<input type='text' class='form-control has-feedback-left' value='0,00' onKeyPress=\"return(moeda(this,'.',',',event));\" onkeyup='calcular_parcelas()' name='valor_entrada' id='valor_entrada' /></div>" +
                "<div id='cc1' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Nº Parc.</h6>\n<select type=\"text\" class=\"form-control has-feedback-left\" id=\"qtd_parcelas\" name=\"qtd_parcelas\" required onchange=\"calcular_parcelas()\"><option value='1'>1x</option><option value='2'>2x</option><option value='3'>3x</option><option value='4'>4x</option><option value='5'>5x</option><option value='6'>6x</option><option value='7'>7x</option><option value='8'>8x</option><option value='9'>9x</option><option value='10'>10x</option><option value='11'>11x</option><option value='12'>12x</option></select></div>" +
                "<div id='cc2' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Bandeira</h6>\n<select type=\"text\" class=\"form-control has-feedback-left\" name=\"bandeira\" required onchange=\"calcular_parcelas()\"><option value='Visa'>Visa</option><option value='MasterCard'>MasterCard</option><option value='Elo'>Elo</option><option value='Hipercard'>Hipercard</option><option value='American Express'>American Express</option><option value='Outro'>Outro</option></select></div>" +
                "<div id='cc3' style='width: 100%' align='right'>\n<h6>Valor da Parcela</h6>\n<input class='col-md-2 col-sm-2 col-xs-12 col-md-offset-10 col-sm-offset-10 form-group has-feedback' type='text' class='form-control has-feedback-left' value='0,00' name='valor_parcela' id='valor_parcela' disabled/></div>";
            nova.appendChild(novadiv);
            calcular_parcelas();
        }
        function exibirCartaoDebito() {
            var nova = document.getElementById("pag");
            var novadiv = document.createElement("div");
            novadiv.innerHTML = "<div id='cc' class='col-md-3 col-sm-3 col-xs-12 form-group has-feedback'>\n<h6>Valor em Espécie</h6>\n<input type='text' class='form-control has-feedback-left' value='0,00' onKeyPress=\"return(moeda(this,'.',',',event));\" onkeyup='calcular_parcelas()' name='valor_entrada' id='valor_entrada' /></div>" +
                "\n<input type='hidden' value='1' id='qtd_parcelas'>" +
                "<div id='cc2' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Bandeira</h6>\n<select type=\"text\" class=\"form-control has-feedback-left\" name=\"bandeira\" required onchange=\"calcular_parcelas()\"><option value='Visa'>Visa</option><option value='MasterCard'>MasterCard</option><option value='Elo'>Elo</option><option value='Hipercard'>Hipercard</option><option value='American Express'>American Express</option><option value='Outro'>Outro</option></select></div>" +
                "<div id='cc3' class='col-md-2 col-sm-2 col-xs-12 form-group has-feedback'>\n<h6>Valor em Débito</h6>\n<input type='text' class='form-control has-feedback-left' value='0,00' name='valor_parcela' id='valor_parcela' disabled/></div>";
            nova.appendChild(novadiv);
            calcular_parcelas();
        }

        function calcular_parcelas() {
            var total = document.getElementById("total").value.replace('.','');
            var preco =  parseFloat(total.replace(',','.'));
            var total1 = document.getElementById("valor_entrada").value.replace('.','');
            var preco1 =  parseFloat(total1.replace(',','.'));
            var divisao =   parseFloat(document.getElementById("qtd_parcelas").value);

            var total2 = (preco-preco1)/divisao;
            document.getElementById("valor_parcela").value = ((total2.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})).replace('R$','')).replace(/^\s+|\s+$/g,"");
        }

        var select = document.getElementById('selecionado');
        select.addEventListener('change', function() {
            var option = this.selectedOptions[0];
            var texto = option.textContent;
            var frase_array = texto.split('$');
            document.getElementById("price").value = frase_array[1] = frase_array[1].replace(/^\s*/, "").replace(/\s*$/, "");
        });

    </script>
@endsection
