<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClientMovement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 0 dinheiro ,1 debito ,2 cretito ,3 boleto
     */
    public function up()
    {
        Schema::create('movement_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->string('description');
            $table->integer('payment_type');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_table')->onDelete('cascade');
            $table->integer('cash_desk_id')->unsigned();
            $table->foreign('cash_desk_id')->references('id')->on('cash_desk_table')->onDelete('cascade');
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
        //
        Schema::dropIfExists('movement_table');
    }
}
