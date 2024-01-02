<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    //
    public function index($it_id_curso){
        $c_d=fh_cursos_disciplinas()->where('cursos.id',$it_id_curso)->get();
        return response()->json($c_d);

    }
}
