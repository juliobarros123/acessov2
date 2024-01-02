<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Prova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvaController extends Controller
{
    //
    public function sala_por_prova($it_id_prova){
        $prova=Prova::where('id',$it_id_prova)->get();
        return response()->json($prova);

    }
    public function prova_por_ano($it_id_ano_lectivo){
    
        $provas = DB::table('provas')
            ->join('salas', 'salas.id', 'provas.it_id_sala')
            ->join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
            ->where('provas.it_id_ano_lectivo', $it_id_ano_lectivo)
            ->select('salas.*', 'salas.vc_nome as sala','cursos.vc_nome as curso', 'provas.*','horarios.inicio_prova as inicio_prova','horarios.termino_prova as termino_prova','periodos.vc_nome as periodo')
            ->whereNull('provas.deleted_at')->get();
            return response()->json($provas);
        
    }
}
