<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEmpresaUsuario extends Model
{
    //
    protected $fillable = ['id_usuario','id_empresa'];


    public function usuario(){
        return $this->belongsTo(User::class,'id_usuario');
    }    
    public function empresa(){
        return $this->belongsTo(Empresa::class,'id_empresa');
    }
}
