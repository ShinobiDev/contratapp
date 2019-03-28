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
            $table->string("numero_proceso");
            $table->string("link_proceso",512);
            $table->string("entidad");
            $table->string("objeto");
            $table->string("dpto_ciudad");
            $table->string("cuantia");
            $table->date("fecha_apertura");  
            $table->integer("id_empresa")->unsigned();
            $table->integer("id_detalle_usuario_empresa_asignado")->unsigned();
            $table->date("fecha_cierre")->nullable();
            $table->enum("tipo_proceso",['Licitación Pública','Selección Abreviada Menos Cuantia','Subasta','Contratación minima Cuantia','Selección Abreviada Servicios de Salud','Concurso de Méritos con Lista Corta','Concurso de Méritos con Lista Multiusos','Concurso de Méritos Abierto','Lista Multiusos','Contratación Directa','Régimen Especial','Contratación Directa Menor Cuantia','Otras formas de Contratación Directa','Selección abreviada Literal h','Asociación Público Privada','Iniciativa Privada sin Recursos Públicos','Licitación Obra Pública','Contratos y Convenios con más de dos partes']);
            $table->enum("estado_proceso",['Borrador','Convocado','Adjudicado','Celebrado','Liquidado','Descartado','Terminado Anormalmente después de Convocado','Terminado sin Liquidar']);
             $table->enum("gestion_comercial",['Encontrado','No cumplimos','Pendiente Propuesta','Propuesta Presentada','Adjudicado','No Adjudicado']);
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
