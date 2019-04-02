<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public function control_procesos(){
    	return $this->hasMany(ControlProceso::class,'id_empresa');
    }
}
