<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Candidato;
use App\Models\Correcao;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Enunciado;
use App\Models\Prova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadoController extends Controller
{
    //
    public function index()
    {
        $response['cursos'] = Curso::get();
        $response['candidatos'] = Candidato::join('correcaos', 'correcaos.it_id_candidato', '=', 'candidatos.id')
            ->join('enunciados', 'enunciados.id', '=', 'correcaos.it_id_enunciado')
            ->select('candidatos.*', 'enunciados.codigo', 'correcaos.id as id_correcao')
            ->get();
        $response['disciplinas'] = Disciplina::get();
        $response['anos'] = AnoLectivo::get();

        return view('admin.resultado.index', $response);
    }
    public function individual()
    {
        $response['cursos'] = Curso::get();
        $response['candidatos'] = Candidato::all();
        $response['disciplinas'] = Disciplina::all();
        return view('admin.resultado.individual.index', $response);
    }
    public function apresentar(Request $request)
    {

        $respostas = [];
        $ids_perguntas = [];

        $candidato = Candidato::find($request->id_candidato);
        // dd( $candidato);
        $correcao = Correcao::where('it_id_candidato', $candidato->id)->first();
        if (!$correcao) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Candidato não tem nota para esta disciplina!']);
        }
        $response['respostas'] = notas($candidato->vc_codigo, $request->id_disciplina, $correcao->id);

        // dd( $correcao   );
        $response['enunciado'] =  Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

               ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->join('correcaos', 'correcaos.it_id_enunciado', '=', 'enunciados.id')

            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->where('enunciados.id',  $correcao->it_id_enunciado)
            ->where('enunciados.it_id_disciplina',  $request->id_disciplina)
            ->first();
        // dd($response['enunciado']);
        if (!$response['enunciado']) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Não existe  resultado para esta disciplina!']);
        }
        return view('admin.resultado.individual.apresentar.index', $response);
    }
    // public function imprimir()
    // {

    //     $response['candidatos'] = Candidato::join('correcaos', 'correcaos.it_id_candidato', '=', 'candidatos.id')
    //         ->join('enunciados', 'enunciados.id', '=', 'correcaos.it_id_enunciado')
    //         ->select('candidatos.*', 'enunciados.codigo', 'correcaos.id as id_correcao')
    //         ->get();

    // }

  
    public function imprimir()
    {

        $response['cursos'] = Curso::get();
        $response['candidatos'] = Candidato::join('correcaos', 'correcaos.it_id_candidato', '=', 'candidatos.id')
            ->join('enunciados', 'enunciados.id', '=', 'correcaos.it_id_enunciado')
            ->select('candidatos.*', 'enunciados.codigo', 'correcaos.id as id_correcao')
            ->get();
        $response['disciplinas'] = Disciplina::get();
        $response['anos'] = AnoLectivo::get();

        return view('admin.resultado.imprimir.index', $response);
    }
    public function por_prova(){
        $response['anos_lectivo'] =AnoLectivo::all();
        // $response['anos_lectivo'] =AnoLectivo::all();
        return view('admin.resultado.por-prova.index', $response);

    }
    public function post_imprimir(Request $request)
    {
  
        $response['candidatos']  = $response['candidatos'] =Candidato::join('cursos', 'cursos.id', '=', 'candidatos.it_id_curso')
        ->where('candidatos.it_id_ano_lectivo',$request->it_id_ano_lectivo)
        ->where('cursos.id',$request->it_id_curso)
        ->get();
        $response['tb'] = 0;
        $response['disciplinas'] = fh_cursos_disciplinas()->where('cursos.id', $request->it_id_curso)->select('disciplinas.*')->get();

        $response['anos'] = AnoLectivo::get();
        $response['cursos'] = Curso::get();
        $response['curso'] = Curso::find($request->it_id_curso);
        $response['id_ano_lectivo'] = $request->it_id_ano_lectivo;
        $response['ano_lectivo'] = AnoLectivo::find($request->it_id_ano_lectivo)->ya_inicio . '-' . AnoLectivo::find($request->it_id_ano_lectivo)->ya_fim;

        // $response['disciplinas'] = Disciplina::get();
        // dd($response['candidatos'] );;
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view("admin.pdfs.resultado.index", $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("lista de resultados.pdf", "I");
    }

    public function por_prova_imprimir(Request $request)
    {
        // dd($request);
         $response['candidatos'] =Candidato::join('cursos', 'cursos.id', '=', 'candidatos.it_id_curso')
        ->where('candidatos.it_id_ano_lectivo',$request->it_id_ano_lectivo)
        ->join('provas', 'cursos.id', '=', 'provas.it_id_curso')
        ->where('provas.it_id_ano_lectivo', $request->it_id_ano_lectivo)
        ->where('provas.id', $request->it_id_prova)
        ->get();
        //    dd( $response['candidatos']);
             
            $response['prova']=  DB::table('provas')
            ->join('salas', 'salas.id', 'provas.it_id_sala')
            ->join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
            ->where('provas.id', $request->it_id_prova)
            ->select('salas.*', 'salas.vc_nome as sala','cursos.vc_nome as curso', 'provas.*','horarios.inicio_prova as inicio_prova','horarios.termino_prova as termino_prova','periodos.vc_nome as periodo')
            ->whereNull('provas.deleted_at')->get()->first();
        // dd(  $response['prova']);
         $disciplinas=   Enunciado::join('disciplinas', 'disciplinas.id','enunciados.it_id_disciplina')
            ->select('disciplinas.*')
            ->where('it_id_prova',$request->it_id_prova)->distinct()->get();
            // dd($disciplinas);
        $response['tb'] = 0;
        $response['disciplinas'] =   $disciplinas;

        // $response['anos'] = AnoLectivo::get();
        // $response['cursos'] = Curso::get();
        // $response['curso'] = Curso::find($request->it_id_curso);
        // $response['id_ano_lectivo'] = $request->it_id_ano_lectivo;
        $response['ano_lectivo'] = AnoLectivo::find($request->it_id_ano_lectivo)->ya_inicio . '/' . AnoLectivo::find($request->it_id_ano_lectivo)->ya_fim;

        // $response['disciplinas'] = Disciplina::get();
        // dd($response['candidatos'] );;
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view("admin.resultado.por-prova.imprimir.index", $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("lista de resultados.pdf", "I");
    }
    
    public function filtrar(Request $request)
    {
        // dd($request);
        $response['candidatos'] =Candidato::join('cursos', 'cursos.id', '=', 'candidatos.it_id_curso')
        ->where('candidatos.it_id_ano_lectivo',$request->it_id_ano_lectivo)
        ->where('cursos.id',$request->it_id_curso)
        ->get();
       
        $response['tb'] = 0;
        $response['disciplinas'] = fh_cursos_disciplinas()->where('cursos.id', $request->it_id_curso)->select('disciplinas.*')->get();
        // dd(    $response['disciplinas'] );
        $response['anos'] = AnoLectivo::get();
        $response['cursos'] = Curso::get();
        $response['id_ano_lectivo'] = $request->it_id_ano_lectivo;
        $response['ano_lectivo'] = AnoLectivo::find($request->it_id_ano_lectivo)->ya_inicio . '-' . AnoLectivo::find($request->it_id_ano_lectivo)->ya_fim;

        return view('admin.resultado.index', $response);
    }
}
