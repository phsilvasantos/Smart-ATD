<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('providers_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fantasy_name');
            $table->string('social_name');
            $table->integer('type');
            $table->integer('status');
            $table->string('address');
            $table->string('number_address');
            $table->string('bairro');
            $table->string('city');
            $table->string('rf_point');
            $table->string('cep');
            $table->string('phone');
            $table->string('cell_phone');
            $table->string('email');
            $table->string('cpf');
            $table->string('rg');
            $table->string('bank_account');
            $table->text('description');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_table')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers_table');
        //
    }
}
