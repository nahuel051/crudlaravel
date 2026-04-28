<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'rol';

    protected $fillable = [
        'nombre_rol',
    ];

    public function users()
    {
        //uno a muchos: un rol puede ser asignado a varios usuarios, indicando que varios usuarios pueden compartir el mismo rol
        return $this->hasMany(Users::class, 'id_rol');
    }
}
