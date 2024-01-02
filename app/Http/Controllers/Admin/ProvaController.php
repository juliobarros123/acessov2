<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prova;
use App\Models\Sala;
use App\Models\Curso;
use App\Models\Horario;
use App\Models\Periodo;
use App\Models\AnoLectivo;
use App\Models\Candidato;
use App\Models\Enunciado;
use App\Models\Pergunta;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProvaController extends Controller
{
    //
    //

    public function __construct()
    {

        $this->Logger = new Logger();
    }
    public function loggerData($mensagem)
    {

        $this->Logger->Log('info', $mensagem);
    }
    //
    public function index()
    {
        // dd(turmas_sge());
        $provas = Prova::all();
        $prova = Prova::join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->join('periodos', 'horarios.it_id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('provas.*', 'cursos.vc_nome as curso', 'periodos.vc_nome as periodo', 'horarios.inicio_prova as inicio_prova', 'horarios.termino_prova as termino_prova', 'salas.vc_nome as sala', 'salas.capacidade_total as capacidade_total', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->get();

        //dd($prova);
        // dd($tds);
        return view('admin.prova.index', ['provas' => $prova]);
        // return view('admin.pergunta.index',['salas'=>$pergunta]);
    }


    public function see($id)
    {
        $prova = Prova::all();
        $tds = DB::table('provas')
            ->join('salas', 'salas.id', 'provas.it_id_sala')
            ->join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
            ->where('salas.id', $id)
            ->select('salas.*', 'salas.vc_nome as sala', 'cursos.vc_nome as curso', 'provas.*', 'horarios.inicio_prova as inicio_prova', 'horarios.termino_prova as termino_prova', 'periodos.vc_nome as periodo')
            ->whereNull('provas.deleted_at')->get();
        // dd( $tds,"o");
        return view('admin.prova.index', ['provas' => $tds]);
        // return view('admin.pergunta.index',['salas'=>$pergunta]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cursos = Curso::all();
        $salas = Sala::all();
        $periodos = Periodo::all();

        $periodosJson = $periodos->toJson();
        //dd($periodoJson);
        $salasJson = $salas->toJson();
        $ano_lectivos = AnoLectivo::all();
        $horarios = Horario::all();
        //dd($salasJson);
        return view('admin.prova.create.index', compact('salas', 'cursos', 'ano_lectivos', 'horarios', 'salasJson', 'periodosJson'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        // $request->validate([
        //     'vc_nome' => 'required|max:1000',
        //     'it_id_sala' => 'required|max:255',
        //     'it_id_curso' => 'required|max:255',
        //     'it_id_horario' => 'required|max:255',
        //     'it_id_ano_lectivo' => 'required|max:255',
        //     'capacidade_usada' => 'required|max:255',

        // ], [
        //     'vc_nome.required' => 'A descrição é um campo obrigatório.',
        //     'it_id_sala.required' => 'Campo obrigatório.',
        //     'it_id_curso.required' => 'Campo obrigatório.',
        //     'it_id_horario.required' => 'Campo obrigatório.',
        //     'it_id_ano_lectivo.required' => 'Campo obrigatório.',
        //     'capacidade_usada.required' => 'Campo obrigatório.',
        // ]);
        $provaExistente = Prova::where('it_id_sala', $request->it_id_sala)
            ->where('it_id_horario', $request->it_id_horario)
            ->first();


        if ($provaExistente) {
            return redirect()->back()->with('prova.duplicate.error', 1);
        }
        try {


            $prova = Prova::create([
                'vc_nome' => $request->vc_nome,
                'it_id_sala' => $request->it_id_sala,
                'it_id_curso' => $request->it_id_curso,
                'it_id_horario' => $request->it_id_horario,
                'it_id_ano_lectivo' => $request->it_id_ano_lectivo,
                'capacidade_usada' => 0,
                'vc_n_candidatos' => $request->vc_n_candidatos,
                'topicos' => $request->topicos,
                'dt_data_prova' => $request->dt_data_prova
            ]);
            //dd($request->it_id_horario);
            //dd($prova);
            $this->loggerData(" Cadastrou uma prova " . $request->vc_nome . " - " . $request->it_id_sala);

            return redirect()->back()->with('prova.create.success', 1);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('prova.create.error', 1);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prova = Prova::all();
        return view('admin.prova.edit.index', ['prova' => $prova]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prova = Prova::findOrFail($id);
        $cursos = Curso::all();
        $salas = Sala::all();
        $salasJson = $salas->toJson();
        $ano_lectivos = AnoLectivo::all();
        $horarios = Horario::all();
        //dd($salasJson);
        $prova = Prova::findOrfail($id)->join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('provas.*', 'cursos.vc_nome as curso', 'horarios.inicio_prova as inicio_prova', 'horarios.termino_prova as termino_prova', 'salas.vc_nome as sala', 'salas.capacidade_total as capacidade_total', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->first();
        return view('admin.prova.edit.index', compact('salas', 'prova', 'salasJson', 'horarios', 'ano_lectivos', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // $request->validate([
        //     'vc_nome' => 'required|max:1000',
        //     'it_id_sala' => 'required|max:255',
        //     'it_id_curso' => 'required|max:255',
        //     'it_id_horario' => 'required|max:255',
        //     'it_id_ano_lectivo' => 'required|max:255',
        //     'capacidade_usada' => 'required|max:255',

        // ], [
        //     'vc_nome.required' => 'A descrição é um campo obrigatório.',
        //     'it_id_sala.required' => 'Campo obrigatório.',
        //     'it_id_curso.required' => 'Campo obrigatório.',
        //     'it_id_horario.required' => 'Campo obrigatório.',
        //     'it_id_ano_lectivo.required' => 'Campo obrigatório.',
        //     'capacidade_usada.required' => 'Campo obrigatório.',
        // ]);
        $provaExistente = Prova::where('it_id_sala', $request->it_id_sala)
            ->where('it_id_horario', $request->it_id_horario)
            ->first();


        if ($provaExistente) {
            return redirect()->back()->with('prova.duplicate.error', 1);
        }

        try {
            //code...
            $prova = Prova::find($id);

            $ano = Prova::findOrFail($id)->update([
                'vc_nome' => $request->vc_nome,
                'it_id_sala' => $request->it_id_sala,
                'it_id_curso' => $request->it_id_curso,
                'it_id_horario' => $request->it_id_horario,
                'it_id_ano_lectivo' => $request->it_id_ano_lectivo,
                'capacidade_usada' => 0,
                'vc_n_candidatos' => $request->vc_n_candidatos,
                'topicos' => $request->topicos,
                'dt_data_prova' => $request->dt_data_prova
            ]);
            $this->loggerData(" Editou a alinea.  de id, prova ($prova->id, $prova->vc_nome) para ($request->it_id_sala)");
            return redirect()->back()->with('prova.update.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('prova.update.error', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
        try {
            //code..
            $prova = Prova::findOrFail($id);
            Prova::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a prova  de id, prova ($prova->vc_nome. ' - ' .$prova->it_id_sala) ");
            return redirect()->back()->with('prova.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('prova.destroy.error', 1);
        }
    }
    public function purge($id)
    {
        //
        try {
            //code...
            $prova = Prova::findOrFail($id);
            Prova::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a alinea  de id, prova ($prova->vc_nome. ' - ' .$prova->it_id_sala) ");
            return redirect()->back()->with('prova.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('prova.purge.error', 1);
        }
    }
    public function resultados($id)
    {
        $prova = Prova::find($id);
        // dd( $prova);
        $enunciado = Enunciado::where('it_id_prova', $prova->id)->first();

        $response['candidatos'] = Candidato::join('correcaos', 'correcaos.it_id_candidato', '=', 'candidatos.id')
            ->join('enunciados', 'enunciados.id', 'correcaos.it_id_enunciado')
            ->join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')

            ->where('provas.it_id_horario', $prova->it_id_ano_lectivo)
            ->where('provas.it_id_curso', $prova->it_id_curso)
            ->select('candidatos.*', 'enunciados.codigo', 'correcaos.id as id_correcao')
            ->get();
        $response['tb'] = 0;
        $response['disciplinas'] = fh_cursos_disciplinas()->where('disciplinas.id', $enunciado->it_id_disciplina)->select('disciplinas.*')->get();
        // dd(   $response['disciplinas']);
        $response['anos'] = AnoLectivo::get();
        $response['cursos'] = Curso::get();
        $response['curso'] = Curso::find($prova->it_id_curso);
        $response['id_ano_lectivo'] = $prova->it_id_ano_lectivo;
        $response['ano_lectivo'] = AnoLectivo::find($prova->it_id_ano_lectivo)->ya_inicio . '-' . AnoLectivo::find($prova->it_id_ano_lectivo)->ya_fim;

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
}