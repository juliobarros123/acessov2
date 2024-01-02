<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordenadaRespotaEnunciado extends Model
{
    use HasFactory;


    protected $fillable = [
        'it_id_enunciado',
        'x',
        'y'

    ];
}
