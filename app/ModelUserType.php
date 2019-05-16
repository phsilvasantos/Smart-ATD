<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelUserType extends Model
{
    //
    protected $table = 'user_type_table';

    protected $fillable = [
        'name', 'description', 'company_id','crud_cliente',
        'crud_fornecedor',
        'crud_grupo_produtos',
        'crud_produtos',
        'realizar_venda',
        'visualizar_venda',
        'excluir_venda',
        'visualizar_compra',
        'realizar_compra',
        'excluir_compra',
        'gerar_etiqueta',
        'visualizar_caixa',
        'entrada_saida',
        'contas_pagar',
        'contas_receber',
        'debito_cliente',
        'fluxo_caixa',
        'crud_usuarios',
    ];
}
