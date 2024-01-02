<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlineaGerada;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Enunciado;
use App\Models\AnoLectivo;
use App\Models\BancoAlinea;
use App\Models\BancoPergunta;
use App\Models\Candidato;
use App\Models\CandidatoFolhaResposta;
use App\Models\Disciplina;
use App\Models\Periodo;
use App\Models\Logger;
use App\Models\Pergunta;
use App\Models\Prova;
use App\Models\Sala;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EnunciadoController extends Controller
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

    public function gerar(Request $request)
    {
        // dd( $request);
        $alineas = ['a', 'b', 'c', 'd', 'f', 'g', 'h'];
        $contAliania = 0;
        $contOrdemPergunta = 1;

        for ($i = 0; $i < $request->n_enunciados; $i++) {
            $enunciado = Enunciado::create([
                'codigo' => $i,
                'id_ano_lectivo' =>  $request->it_id_ano_lectivo,
                'it_id_disciplina' => $request->it_id_disciplina,
                'id_periodo' => $request->id_periodo,
                'it_id_sala' => $request->id_sala,
                'it_id_prova' => $request->id_prova,
                'vc_coordenador' => $request->coordenador
            ]);
            $ya_fim = AnoLectivo::find($request->it_id_ano_lectivo)->ya_fim;
            Enunciado::find($enunciado->id)->update([
                'codigo' => "$enunciado->id$request->it_id_disciplina$ya_fim",
            ]);
            // if (CandidatoFolhaResposta::where(
            //     'it_id_enunciado',
            //     $request->id_enunciado
            // )->whereYear('created_at',date('Y'))->count()) {
            //   return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Candidato já tem enunciado para este ano lectivo!']);
            // }
            $candidatos =  Candidato::where('it_id_sala', $request->id_sala)->get();

            // dd($candidatos);
            foreach ($candidatos as $candidato) {
                $c = CandidatoFolhaResposta::join('enunciados', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
                    ->join('salas', 'salas.id', 'enunciados.it_id_sala')
                    ->where('enunciados.it_id_sala', $request->id_sala)
                    ->where('candidato_folha_respostas.it_id_candidato', $candidato->id)
                    ->where('enunciados.it_id_disciplina', $request->it_id_disciplina)
                    ->whereYear('candidato_folha_respostas.created_at', date('Y'))
                    ->count();
                    // dd(  $c);
                if (!$c) {
                    CandidatoFolhaResposta::create([
                        'it_id_enunciado' => $enunciado->id,
                        'it_id_candidato' => $candidato->id
                    ]);
                    break;
                }
            }

            $bps =  BancoPergunta::inRandomOrder()->limit($request->it_n_pergunta)->where('it_id_disciplina', $request->it_id_disciplina)->get();
            foreach ($bps as $bp) {
                $pergunta = Pergunta::create([
                    'descricao' => $bp->vc_descricao_bp,
                    'ch_alinea' => 1,
                    'it_numero' => $contOrdemPergunta,
                    'it_id_banco_pergunta' => $bp->id,
                    'it_id_enunciado' => $enunciado->id,
                    'it_cotacao' => $request->it_cotacao
                ]);
                $bas =  BancoAlinea::where('it_id_banco_pergunta', $bp->id)->inRandomOrder()->limit(10)->get();
                foreach ($bas as $ba) {
                    AlineaGerada::create([
                        'alinea' => $alineas[$contAliania],
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $ba->id
                    ]);
                    $contAliania++;
                }
                $contAliania = 0;
                $contOrdemPergunta++;
            }
            $contOrdemPergunta = 1;
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Enunciados gerados com sucesso!']);
    }
    public function gerar_por_disciplina($id_disciplina)
    {

        $alineas = ['a', 'b', 'c', 'd', 'f', 'g', 'h'];
        $contAliania = 0;
        $contOrdemPergunta = 1;
        for ($i = 0; $i < 3; $i++) {
            $enunciado = Enunciado::create([
                'codigo' => $i,
                'id_ano_lectivo' => AnoLectivo::orderBy('id', 'desc')->first()->id,
                'it_id_disciplina' => 1,
                'id_periodo' => 1,
            ]);

            $bps =  BancoPergunta::inRandomOrder()->limit(4)->where('it_id_disciplina', $id_disciplina)->get();
            foreach ($bps as $bp) {
                $pergunta = Pergunta::create([
                    'descricao' => $bp->vc_descricao_bp,
                    'ch_alinea' => 1,
                    'it_numero' => $contOrdemPergunta,
                    'it_id_banco_pergunta' => $bp->id,
                    'it_id_enunciado' => $enunciado->id
                ]);
                $bas =  BancoAlinea::where('it_id_banco_pergunta', $bp->id)->inRandomOrder()->limit(10)->get();
                foreach ($bas as $ba) {
                    AlineaGerada::create([
                        'alinea' => $alineas[$contAliania],
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $ba->id
                    ]);
                    $contAliania++;
                }
                $contAliania = 0;
                $contOrdemPergunta++;
            }
            $contOrdemPergunta = 1;
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Enunciados gerados com sucesso!']);
    }
    public function imprimir($id_enunciado)
    {
        $response['enunciado'] = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'salas.vc_nome as sala', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->find($id_enunciado);


        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html =  view('admin.enunciado.imprimir.index',  $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("Enunciado.pdf", "I");

        // return view('admin.enunciado.imprimir.index',  $response);
    }
 

    public function enunciado_tem_pergunta($id_enunciado, $id_pb)
    {
        return   Pergunta::where('it_id_banco_pergunta', $id_enunciado)
            ->where('it_id_enunciado', $id_pb)->count();
    }
    public function index()
    {
        $response['disciplinas'] = Disciplina::all();
        $response['periodos'] = Periodo::all();
        $response['salas'] = Sala::all();
        $response['ano'] = AnoLectivo::all();
        $response['salas'] = Sala::all();
        $response['provas'] = Prova::all();
        $response['enunciados'] = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
            ->select('enunciados.*', 'salas.vc_nome as sala', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->get();
        return view('admin.enunciado.index', $response);
        // dd("ola");
    }

    public function imprimir_folha_resposta_post(Request $request)
    {
        $response['enunciado'] =  Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'salas.vc_nome as sala', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->find($request->id_enunciado);

        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);


        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);
        // if (CandidatoFolhaResposta::where(
        //     'it_id_enunciado',
        //     $request->id_enunciado
        // )->whereYear('created_at',date('Y'))->count()) {
        //   return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Candidato já tem enunciado para este ano lectivo!']);
        // }
        CandidatoFolhaResposta::create([
            'it_id_enunciado' => $request->id_enunciado,
            'it_id_candidato' => $request->id_candidato
        ]);
        $response['candidato'] = Candidato::find($request->id_candidato);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html =  view('admin.enunciado.gabarito.index',  $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta.pdf", "I");
    }


    /**
     * Show the form for creating o new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $anos = AnoLectivo::all();
        $periodos = Periodo::all();
        return view('admin.enunciado.create.index', compact('periodos', 'anos'));
    }

    /**
     * Store o newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $codigo = Str::random(6);
        while (Enunciado::where('codigo', $codigo)->exists()) {
            $codigo = Str::random(6);
        };
        $request->validate([
            'id_ano' => 'required|max:255',
            'id_periodo' => 'required|max:255'
        ], [
            'id_ano.required' => 'O ano lectivo do enunciado é um campo obrigatório.',
            'id_periodo.required' => 'O nome do enunciado é um campo obrigatório.',
        ]);

        try {
            // dd( $request->id_sala);
            $enunciado = Enunciado::create([
                'codigo' => $codigo,
                'id_ano_lectivo' => $request->id_ano,
                'id_periodo' => $request->id_periodo,
                'it_id_sala' => $request->id_sala,
            ]);
            $this->loggerData(" Cadastrou o enunciado " . $codigo);
            return redirect()->back()->with('enunciado.create.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.create.error', 1);
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
        $enunciado = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->get();
        return view('admin.enunciado.edit.index', ['enunciado' => $enunciado]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $enunciado = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->findOrFail($id);
        $anos = AnoLectivo::all();
        $periodos = Periodo::all();
        return view('admin.enunciado.edit.index', compact('periodos', 'anos', 'enunciado'));
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
        //
        //
        //dd($request);
        $request->validate([
            'id_ano' => 'required|max:255',
            'id_periodo' => 'required|max:255'
        ], [
            'id_ano.required' => 'O ano lectivo do enunciado é um campo obrigatório.',
            'id_periodo.required' => 'O nome do enunciado é um campo obrigatório.',
        ]);

        try {
            //code...

            $enunciado = Enunciado::findOrFail($id)->update([
                'id_ano_lectivo' => $request->id_ano_lectivo,
                'id_periodo' => $request->id_periodo,
            ]);

            $this->loggerData(" Editou o enunciado.  de id, enunciado ($enunciado->id, $enunciado->id_ano_lectivo,$enunciado->id_periodo) para ($request->id_ano_lectivo,$request->id_periodo)");
            return redirect()->back()->with('enunciado.update.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.update.error', 1);
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
            //code...
            $enunciado = Enunciado::findOrFail($id);
            Enunciado::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o enunciado  de id, fisciplina ($enunciado->codigo) ");
            return redirect()->back()->with('enunciado.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $enunciado = Enunciado::findOrFail($id);
            Enunciado::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o enunciado  de id, enunciado ($enunciado->codigo) ");
            return redirect()->back()->with('enunciado.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.purge.error', 1);
        }
    }
}
