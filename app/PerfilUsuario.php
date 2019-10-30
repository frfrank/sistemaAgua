<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{
    
    protected $table='perfil_usuario';

    protected $fillable=['nombre','apellidos','email'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
