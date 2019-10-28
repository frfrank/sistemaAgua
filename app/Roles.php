<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table="roles";
    protected $fillable=['nombre','descripcion','estado'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
