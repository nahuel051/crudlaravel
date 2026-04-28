<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function futbol()
    {   // hasMany define relación "uno a muchos": 
        // Un equipo (Team) tiene muchos jugadores (Futbol)
        return $this->hasMany(Futbol::class);
    }
}
