<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCaixa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_desk_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_value');
            $table->string('close_value')->default('0,00');
            $table->integer('status')->default(0);
            $table->integer('open_user_id')->unsigned();
            $table->foreign('open_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('close_user_id')->unsigned();
            $table->foreign('close_user_id')->references('id')->on('users')->onDelete('cascade');
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
        //
        Schema::dropIfExists('cash_desk_table');
    }
}
