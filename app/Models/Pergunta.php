<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pergunta extends Model
{
    use HasFactory;
    use SoftDeletes;

    // pattern="([aA-zZ]+)"

    protected $fillable = [ 'descricao',
                            'ch_alinea',
                            'it_numero',
                            'it_id_banco_pergunta',
                            'it_id_enunciado',
                            'it_cotacao'
                        ];

    protected $dates = ['deleted_at'];
}
