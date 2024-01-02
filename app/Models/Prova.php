<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prova extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'banco_alineas';

    protected $fillable = [
        'vc_nome',
        'it_id_sala',
        'vc_n_candidatos',
        'it_id_curso',
        'it_id_horario',
        'it_id_ano_lectivo',
        'capacidade_usada',
        'topicos',
        'dt_data_prova'

    ];

    protected $dates = ['deleted_at'];
}
