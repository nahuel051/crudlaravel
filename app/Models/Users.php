<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'password',
        'id_rol',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'id_rol');
    }
}
