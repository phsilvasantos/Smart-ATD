<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_type_table', function($table)
        {
            $table->boolean('crud_cliente')->default(false);
            $table->boolean('crud_fornecedor')->default(false);
            $table->boolean('crud_grupo_produtos')->default(false);
            $table->boolean('crud_produtos')->default(false);
            $table->boolean('realizar_venda')->default(false);
            $table->boolean('visualizar_venda')->default(false);
            $table->boolean('excluir_venda')->default(false);
            $table->boolean('visualizar_compra')->default(false);
            $table->boolean('realizar_compra')->default(false);
            $table->boolean('excluir_compra')->default(false);
            $table->boolean('gerar_etiqueta')->default(false);
            $table->boolean('visualizar_caixa')->default(false);
            $table->boolean('entrada_saida')->default(false);
            $table->boolean('contas_pagar')->default(false);
            $table->boolean('contas_receber')->default(false);
            $table->boolean('debito_cliente')->default(false);
            $table->boolean('fluxo_caixa')->default(false);
            $table->boolean('crud_usuarios')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
