<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacionProceso extends Model
{
    //
    protected $fillable = [
        'observacion','id_usuario_observacion','id_control_proceso','tipo_observacion' 
    ];


    public function proceso(){
    	return $this->belongsTo(ControlProceso::class,'id_control_proceso');
    }
    public function usuario_observaciones(){
        return $this->belongsTo(User::class,'id_usuario_observacion');
    }


}
