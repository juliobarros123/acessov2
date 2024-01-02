<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AnoLectivo extends Model
{
    use HasFactory;
    use SoftDeletes;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ya_inicio',
        'ya_fim',
    ];
    protected $dates = ['deleted_at'];
}
