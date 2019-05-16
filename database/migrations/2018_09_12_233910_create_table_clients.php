<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//'name', 'type', 'status', 'address', 'number_address', 'bairro', 'city', 'rf_point', 'cep', 'phone', 'cell_phone', 'email', 'cpf', 'rg', 'nasc_date', 'description',

    public function up()
    {
        //
        Schema::create('clients_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
            $table->date('nasc_date');
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
        Schema::dropIfExists('clients_table');
        //
    }
}
