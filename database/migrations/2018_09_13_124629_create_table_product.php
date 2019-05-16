<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('products_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('barcode');
            $table->integer('nfe');
            $table->string('taxes');
            $table->string('margin');
            $table->string('sale_value');
            $table->string('cost_value');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers_table')->onDelete('cascade');
            $table->integer('product_group_id')->unsigned();
            $table->foreign('product_group_id')->references('id')->on('products_group_table')->onDelete('cascade');
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
        Schema::dropIfExists('products_table');
    }
}
