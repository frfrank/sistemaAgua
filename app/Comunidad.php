<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table='comunidades';

    protected $fillable=['nombre','descripcion','estado'];
    
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
