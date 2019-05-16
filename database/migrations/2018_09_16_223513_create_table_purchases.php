<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('purchases_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note_number');
            $table->date('date');
            $table->integer('status')->default(0);
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers_table')->onDelete('cascade');
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
        Schema::dropIfExists('purchases_table');
    }
}
