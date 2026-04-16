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
        return $this->belongsTo(Team::class);
    }
}
