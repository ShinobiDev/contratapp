<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleUsuarioEmpresa extends Model
{
    //
    public function usuario_asignado()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'id_empresa');
    }

}
