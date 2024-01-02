<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlineaGerada extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'alinea',
        'it_id_pergunta',
        'it_id_banco_alinea'

    ];
}
