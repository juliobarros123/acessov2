<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Correcao;
use App\Models\Enunciado;
use App\Models\PerguntaResposta;
use Illuminate\Http\Request;

class CorrecaoController extends Controller
{
    //
    public function corregir()
    {



        return view('admin.corregir.corregir.index');
    }
    public function folha_esposta(Request $request)
    {
        // dd("ol");
        $response['enunciado'] =
            Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')
    ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->where('enunciados.codigo', $request->vc_codigo_enunciado)
            ->first();
        $response['vc_codigo_estudande'] = $request->vc_codigo_estudande;
        $candidato = Candidato::where('vc_codigo', $request->vc_codigo_estudande)->first();

        if (!$response['enunciado']) {
            return redirect()->route('admin.correcoes.corregir')->with('feedback', ['type' => 'error', 'sms' => 'Enunciado não existe!']);
        }

        if (Correcao::where(
            'it_id_enunciado',
            $response['enunciado']->id
        )
            ->where(
                'it_id_candidato',
                $candidato->id
            )->count()
        ) {
            return redirect()->route('admin.correcoes.corregir')->with('feedback', ['type' => 'error', 'sms' => 'Candidato já tem correção para este enunciado!']);
        }
        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);

        return view('admin.corregir.folha_esposta.index',  $response);
    }
    // public function proximo_old(Request $request)
    // {
    //     $respostas = [];
    //     $ids_perguntas = [];
    //     $response['enunciado'] = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')

    //         ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
    //         ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
    //         ->where('enunciados.codigo', $request->vc_codigo_enunciado)
    //         ->first();
    //     foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta) {
    //         foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea) {
    //             $name = $pergunta->id . '_' . banco_alinea($alinea->it_id_banco_alinea)->id;

    //             if (isset($request[$name]) && banco_alinea($alinea->it_id_banco_alinea)->chave) {
    //                 array_push($respostas, $name);
    //                 array_push($ids_perguntas, $pergunta->id);
    //             }
    //         }
    //     }
    //     // dd($respostas);
    //     $response['enunciado'] = $enunciado;

    //     $response['respostas'] = $respostas;
    //     $response['ids_perguntas'] = $ids_perguntas;

    //     // dd($response);
    //     // ->find($id_enunciado);
    //     // dd(perguntas());
    //     // dd($response['enunciado']);

    //     return view('admin.corregir.proximo.index',  $response);
    //     // dd( $response['enunciado'] );

    // }
    public function proximo(Request $request)
    {
        dd($request);
        $respostas = [];
        $ids_perguntas = [];
        $enunciado =  Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

               ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->where('enunciados.codigo', $request->vc_codigo_enunciado)
            ->first();
        // $candidato = Candidato::where('vc_codigo',)->first();
        $correcao = Correcao::create([
            'it_id_enunciado' => $enunciado->id,
            'it_id_candidato' => 2
        ]);
        foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta) {
            foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea) {
                $name = $pergunta->id . '_' . banco_alinea($alinea->it_id_banco_alinea)->id;

                if (isset($request[$name]) && banco_alinea($alinea->it_id_banco_alinea)->chave) {
                    PerguntaResposta::create([
                        'it_id_correcao' => $correcao->id,
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $alinea->it_id_banco_alinea,
                        'chave' => 1

                    ]);
                } else {
                    PerguntaResposta::create([
                        'it_id_correcao' => $correcao->id,
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $alinea->it_id_banco_alinea,
                        'chave' => 0

                    ]);
                }
            }
        }
        // dd($respostas);
        $response['enunciado'] = $enunciado;

        $response['respostas'] = $respostas;
        $response['ids_perguntas'] = $ids_perguntas;


        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);

        // return view('admin.corregir.proximo.index',  $response);
        // dd( $response['enunciado'] );

    }
    public function finalizar(Request $request)
    {

        $respostas = [];
        $ids_perguntas = [];
        $enunciado = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

               ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->select('enunciados.*', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->where('enunciados.codigo', $request->vc_codigo_enunciado)
            ->first();
        $candidato = Candidato::where('vc_codigo', $request->vc_codigo_estudande)->first();
        if (!$enunciado) {
            return redirect()->route('admin.correcoes.corregir')->with('feedback', ['type' => 'error', 'sms' => 'Enunciado não existe!']);
        }


        $correcao = Correcao::create([
            'it_id_enunciado' => $enunciado->id,
            'it_id_candidato' =>  $candidato->id
        ]);
        foreach (perguntas()->where('perguntas.it_id_enunciado', $enunciado->id)->get() as $pergunta) {
            foreach (alineas_geradas()->where('alinea_geradas.it_id_pergunta', $pergunta->id)->get() as $alinea) {
                $name = $pergunta->id . '_' . banco_alinea($alinea->it_id_banco_alinea)->id;

                if (isset($request[$name]) && banco_alinea($alinea->it_id_banco_alinea)->chave) {
                    PerguntaResposta::create([
                        'it_id_correcao' => $correcao->id,
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $alinea->it_id_banco_alinea,
                        'chave' => 1

                    ]);
                } else {
                    PerguntaResposta::create([
                        'it_id_correcao' => $correcao->id,
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $alinea->it_id_banco_alinea,
                        'chave' => 0

                    ]);
                }
            }
        }
        // dd($respostas);
        $response['enunciado'] = $enunciado;

        $response['respostas'] = $respostas;
        $response['ids_perguntas'] = $ids_perguntas;


        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);

        return redirect()->route('admin.correcoes.corregir')->with('feedback', ['type' => 'success', 'sms' => 'Correção finalizada com sucesso!']);


        // dd( $response['enunciado'] );

    }
}
