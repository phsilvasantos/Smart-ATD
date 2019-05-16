<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('sales_table', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(0);
            $table->integer('discount')->default(0);
            $table->string('final_value')->default("0,00");
            $table->string('payment_description')->default("Nenhum");
            $table->integer('payment_type')->default(0);
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients_table')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('sales_table');
    }
}
