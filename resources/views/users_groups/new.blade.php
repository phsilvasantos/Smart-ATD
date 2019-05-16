@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Novo Grupo de Usuários - <strong>Emrpesa
                        @foreach(\App\ModelCompany::all()->where('id', $id) as $empresa)
                            {{$empresa->name}}
                        @endforeach
                        </strong>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div>
                        <form action="{{route('groups.store')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="company_id" value="{{$id}}">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="name" placeholder="Nome" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="description" placeholder="Descrição" required>
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>


                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <h2>Permissões</h2>
                                <div><input style="margin-top: 3px" type="checkbox" name="crud_cliente" checked><label>&nbsp;&nbsp;Cadastrar/Editar Clientes</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="crud_fornecedor" checked><label>&nbsp;&nbsp;Cadastrar/Editar Fornecedor</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="crud_grupo_produtos" checked><label>&nbsp;&nbsp;Cadastrar/Editar Grupo de Produtos</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="crud_produtos" checked><label>&nbsp;&nbsp;Cadastrar/Editar Produtos</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="realizar_venda" checked><label>&nbsp;&nbsp;Realizar Venda</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="visualizar_venda" checked><label>&nbsp;&nbsp;Visualizar Vendas</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="excluir_venda" checked><label>&nbsp;&nbsp;Excluir Venda</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="visualizar_compra" checked><label>&nbsp;&nbsp;Visualizar Compras</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="realizar_compra" checked><label>&nbsp;&nbsp;Realizar Compra</label></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <br>
                                <br>
                                <div><input style="margin-top: 3px" type="checkbox" name="excluir_compra" checked><label>&nbsp;&nbsp;Exluir Compra</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="gerar_etiqueta" checked><label>&nbsp;&nbsp;Gerar Etiqueta</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="visualizar_caixa" checked><label>&nbsp;&nbsp;Visualizar Relatorio de Caixa</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="entrada_saida" checked><label>&nbsp;&nbsp;Entrada/Saída de Dinheiro</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="contas_pagar" checked><label>&nbsp;&nbsp;Contas a Pagar</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="contas_receber" checked><label>&nbsp;&nbsp;Contas a Receber</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="debito_cliente" checked><label>&nbsp;&nbsp;Debito de Cliente</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="fluxo_caixa" checked><label>&nbsp;&nbsp;Fluxo de Caixa</label></div>
                                <div><input style="margin-top: 3px" type="checkbox" name="crud_usuarios" checked><label>&nbsp;&nbsp;Cadastrar/Editar Usuários</label></div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <button style="width: 100%" type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
