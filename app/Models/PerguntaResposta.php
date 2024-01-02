<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerguntaResposta extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'it_id_correcao',
        'it_id_pergunta',
        'it_id_banco_alinea',
        'chave'
    ];
}
