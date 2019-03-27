<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion_procesos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("observacion");
            $table->integer("id_usuario_observacion")->unsigned();
            $table->integer("id_control_proceso")->unsigned();
            $table->string("estado_observacion_proceso");
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
        Schema::dropIfExists('observacion_procesos');
    }
}
