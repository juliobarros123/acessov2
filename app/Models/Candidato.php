<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
       'vc_primeiro_nome',
       'vc_nome_meio',
       'vc_ultimo_nome',
       'it_id_classe',
       'dt_data_nascimento',
       'vc_naturalidade',
       'vc_provincia',
       'vc_nome_pai',
       'vc_nome_mae',
       'vc_deficiencia',
       'vc_estado_civil',
       'vc_genero',
       'it_telefone',
       'vc_email',
       'vc_residencia',
       'vc_bi',
       'dt_data_emissao',
       'vc_local_emissao',
       'vc_escola_anterior',
       'ya_ano_conclusao',
       //'vc_nome_curso',
       'dt_ano_candidatura',
       'it_media',
       'it_id_ano_lectivo',
       'it_idade',
       'it_id_sala',
       'it_id_periodo',
       'vc_foto',
       'vc_codigo',
       'it_id_curso'
    ];

    protected $dates = ['deleted_at'];
}
