<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipos;

class Jugadores extends Model
{
    use HasFactory;
    protected $table = 'jugadores';

    public function equipos()
    {
        return $this->belongsTo(Equipos::class);
    }
}
