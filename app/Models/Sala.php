<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'salas';

     protected $fillable = [
        'vc_nome','capacidade_total'
    ];

    protected $dates = ['deleted_at'];
}
