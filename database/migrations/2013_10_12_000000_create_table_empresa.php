<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->string('razao');
            $table->string('address');
            $table->string('city');
            $table->string('cnpj');
            $table->timestamps();
            // Insert some stuff

        });
        \Illuminate\Support\Facades\DB::table('company_table')->insert(
            array(
                'name' => 'ATD Sistemas',
                'logo' => 'bitcode.png',
                'razao' => 'Frederyk Antunnes de Sousa Alves',
                'address' => 'Rua Hermes Maia, 118, Maia, Princesa Isabel-PB',
                'cnpj' => '28.483.231/0001-12',
                'city' => 'Princesa Isabel',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_table');
    }
}
