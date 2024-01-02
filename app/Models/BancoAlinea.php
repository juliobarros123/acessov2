<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BancoAlinea extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'banco_alineas';

    protected $fillable = [
        'it_id_banco_pergunta',
        'description',
        'chave',
        'vc_imagem_ba',
        'vc_codigo_ba'
    ];

    protected $dates = ['deleted_at'];

}
