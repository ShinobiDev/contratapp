<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public function control_procesos_empresa(){
    	return $this->hasMany(ControlProceso::class,'id_empresa');
    }
    public function detalle_empresa_usuario(){
    	return $this->hasMany(DetalleEmpresaUsuario::class,'id_empresa');
    }
}
