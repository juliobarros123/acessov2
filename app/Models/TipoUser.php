<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome'     
    ];
    protected $dates = ['deleted_at'];
}
