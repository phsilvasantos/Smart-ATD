<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_eye_table', function($table)
        {
            $table->text('diabetes');
            $table->text('hipertensao');
            $table->text('gravida');
            $table->text('cirurgia');
            $table->text('oculos');
            $table->text('pio_od')->nullable();
            $table->text('pio_oe')->nullable();
            $table->text('obs')->nullable();
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
