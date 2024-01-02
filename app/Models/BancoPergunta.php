<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BancoPergunta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'vc_descricao_bp',
        'it_cotacao',
        'it_id_disciplina',
        'it_id_ano_lectivo',
        'vc_imagem_bp',
        'vc_codigo_bp'
    ];

    protected $dates = ['deleted_at'];
}
