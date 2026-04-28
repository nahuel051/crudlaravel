<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'futbol';
    protected $fillable = ['nombre', 'edad', 'team_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function team()
    {
        // belongsTo define relación "muchos a uno":
        // Un jugador (Player) pertenece a un equipo (Team)
        //Varios jugadores pueden compartir el mismo team_id, indicando que pertenecen al mismo equipo
        return $this->belongsTo(Team::class);
    }
}
