<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'usuario',
        'password',
        'id_rol',
    ];

    public function rol()
    {
        //muchos a uno: varios usuarios pueden compartir el mismo id_rol, indicando que tienen el mismo rol
        return $this->belongsTo(Roles::class, 'id_rol');
    }
}
