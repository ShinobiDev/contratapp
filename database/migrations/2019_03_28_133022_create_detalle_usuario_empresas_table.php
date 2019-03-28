<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleUsuarioEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_usuario_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_usuario")->unsigned();
            $table->integer("id_empresa")->unsigned();
            $table->integer("id_rol")->unsigned();
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
        Schema::dropIfExists('detalle_usuario_empresas');
    }
}
