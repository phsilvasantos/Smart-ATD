<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExamEye extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('exam_eye_table', function (Blueprint $table) {
            $table->increments('id');

            $table->string('esf_od')->nullable();
            $table->string('esf_oe')->nullable();
            $table->string('cil_od')->nullable();
            $table->string('cil_oe')->nullable();
            $table->string('eix_od')->nullable();
            $table->string('eix_oe')->nullable();
            $table->string('dnp_od')->nullable();
            $table->string('dnp_oe')->nullable();
            $table->string('alt_od')->nullable();
            $table->string('alt_oe')->nullable();
            $table->string('adicao')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('tipo_lente')->nullable();

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients_table')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_table')->onDelete('cascade');
            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales_table')->onDelete('cascade');
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
        Schema::dropIfExists('exam_eye_table');
    }
}
