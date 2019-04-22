<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  
    public function control_procesos_usuario(){
        return $this->hasMany(ControlProceso::class,'id_usuario_asignado');
    }
    public function detalle_empresa_usuario(){
        return $this->hasMany(DetalleEmpresaUsuario::class,'id_usuario');
    }
    
}
