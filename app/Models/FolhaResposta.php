<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FolhaResposta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'it_id_enunciado',
        'it_id_candidato',
        'it_id_ano_lectivo'
    ];
}
