<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable=
    ['idcomunidad','nombre',
    'apellido','tipoDocumento',
    'cedula','edad','direccion',
    'descripcion','telefono','estado'
];

public function comunidad()
{
    return $this->hasOne('App\Comunidad');
}

    public function user()
    {
        return $this->hasOne('App\User');
    }

}

