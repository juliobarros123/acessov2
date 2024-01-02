<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enunciado extends Model
{
    use HasFactory;
    use SoftDeletes;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo','it_id_disciplina','vc_coordenador','it_id_prova'];
    protected $dates = ['deleted_at'];
}

