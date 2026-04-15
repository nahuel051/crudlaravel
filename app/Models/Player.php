<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'futbol';
    protected $fillable = ['nombre', 'edad'];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
