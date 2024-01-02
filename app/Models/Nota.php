<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use HasFactory;
    use SoftDeletes;

    // pattern="([aA-zZ]+)"

    protected $fillable = [
        'nota',
        'it_id_candidato',
        'it_id_enunciado'

    ];

}
