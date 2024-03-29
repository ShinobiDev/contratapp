<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_procesos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("numero_proceso",512);
            $table->string("link_proceso",512);
            $table->string("entidad",512);
            $table->string("objeto",2048);
            $table->string("dpto_ciudad",512);
            $table->string("cuantia");
            $table->date("fecha_apertura");  
            $table->integer("id_usuario_asignado")->unsigned();
            $table->integer("id_empresa")->unsigned();
            $table->date("fecha_cierre")->nullable();
            $table->string("tipo_proceso");
            /*$table->enum("tipo_proceso",['Licitación Pública','Selección Abreviada Menos Cuantia','Subasta','Contratación minima Cuantia','Selección Abreviada Servicios de Salud','Concurso de Méritos con Lista Corta','Concurso de Méritos con Lista Multiusos','Concurso de Méritos Abierto','Lista Multiusos','Contratación Directa','Régimen Especial','Contratación Directa Menor Cuantia','Otras formas de Contratación Directa','Selección abreviada Literal h','Asociación Público Privada','Iniciativa Privada sin Recursos Públicos','Licitación Obra Pública','Contratos y Convenios con más de dos partes']);*/
            /*$table->enum("estado_proceso",['Borrador','Convocado','Adjudicado','Celebrado','Liquidado','Descartado','Terminado Anormalmente después de Convocado','Terminado sin Liquidar']);*/
            $table->string("estado_proceso");
             $table->enum("gestion_comercial",['Encontrado','No cumplimos','Pendiente Propuesta','Propuesta Presentada','Adjudicado','No Adjudicado'])->default('Encontrado');
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
        Schema::dropIfExists('control_procesos');
    }
}
