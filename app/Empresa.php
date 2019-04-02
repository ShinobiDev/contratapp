<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public function control_procesos_empresa(){
    	return $this->hasMany(ControlProceso::class,'id_empresa');
    }
}
