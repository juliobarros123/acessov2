<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use Illuminate\Http\Request;
use App\Models\BancoPergunta;
use App\Models\Disciplina;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\String\b;

class BancoPerguntaController extends Controller
{
    public function __construct()
    {

        $this->Logger = new Logger();
    }
    public function add_pergunta($id_disciplina)
    {

        $response['disciplinas'] = Disciplina::where('id', $id_disciplina)->get();
        $response['ano'] = AnoLectivo::all();
        return view('admin.banco_pergunta.create.index', $response);


    }
    public function loggerData($mensagem)
    {

        $this->Logger->Log('info', $mensagem);
    }
    //
    public function index()
    {
        //
        $data['banco_perguntas'] = BancoPergunta::all();
        $lista = DB::table('banco_perguntas')->
            join('ano_lectivos', 'ano_lectivos.id', '=', 'banco_perguntas.it_id_ano_lectivo')
            ->
            join('disciplinas', 'disciplinas.id', '=', 'banco_perguntas.it_id_disciplina')
            ->select('ano_lectivos.*', 'banco_perguntas.*', 'disciplinas.vc_nome as disciplina')->whereNull('banco_perguntas.deleted_at')->get();
        ;
        $this->loggerData("Listou Banco Perguntas");
        return view('admin.banco_pergunta.index', compact('lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response['ano'] = AnoLectivo::all();
        $response['disciplinas'] = Disciplina::all();
        //dd($data);
        return view('admin.banco_pergunta.create.index', $response);
        // return view('test', compact('ano'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // $fieldName, $destinationPath
        //    dd($request->vc_imagem_bp);
        $vc_imagem_bp = uploadImage($request, 'vc_imagem_bp', 'assets/images/pergunta');
        //   dd($im);
        $request->validate([
            'it_cotacao' => 'required|numeric|between:0,20',
            'it_id_ano_lectivo' => 'required',
        ], [
                'it_cotacao.required' => 'A cotaão é um campo obrigatório.',
                'id_ano.required' => 'O Ano Lectivo é um campo obrigatório.',
                'it_cotacao.numeric' => 'O campo Cotação deve conter apenas números.',
                'it_cotacao.between' => 'O campo Cotacao deve estar entre 0 à 20.',
            ]);

        try {

            if (BancoPergunta::where('vc_descricao_bp', $request->vc_descricao_bp)->exists()) {
                return redirect()->back()->with('bp.existe_pergunta.warning', 1);
            }

            $banco_pergunta = BancoPergunta::create([
                'vc_descricao_bp' => $request->vc_descricao_bp,
                'it_cotacao' => $request->it_cotacao,
                'it_id_ano_lectivo' => $request->it_id_ano_lectivo,
                'it_id_disciplina' => $request->it_id_disciplina,
                'vc_imagem_bp' => $vc_imagem_bp
                //'it_cotacao' => 20,
                //'it_id_ano_lectivo' => 2022,
            ]);

            //dd($banco_pergunta);

            $this->loggerData(" Cadastrou a cotaçao " . $request->it_cotacao . " - " . $request->it_id_ano_lectivo);

            return redirect()->back()->with('banco_pergunta.create.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th);
            return redirect()->back()->with('banco_pergunta.create.error', 1);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $response['data'] = BancoPergunta::find($id);
        $response['disciplinas'] = Disciplina::all();
        $response['data'] = DB::table('banco_perguntas')
            ->join('ano_lectivos', 'ano_lectivos.id', '=', 'banco_perguntas.it_id_ano_lectivo')
            ->join('disciplinas', 'disciplinas.id', '=', 'banco_perguntas.it_id_disciplina')
            ->where('banco_perguntas.id', $id)->select('ano_lectivos.*', 'banco_perguntas.*', 'disciplinas.vc_nome')->first();
        //dd($data);
        $response['ano'] = AnoLectivo::all();
        return view('admin.banco_pergunta.edit.index', $response);
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
     

        $request->validate([
            'it_cotacao' => 'required|numeric|between:0,20',
            'it_id_ano_lectivo' => 'required',
        ], [
                'it_cotacao.required' => 'A cotaão é um campo obrigatório.',
                'id_ano.required' => 'O Ano Lectivo é um campo obrigatório.',
                'it_cotacao.numeric' => 'O campo Cotação deve conter apenas números.',
                'it_cotacao.between' => 'O campo Cotacao deve estar entre 0 à 20.',
            ]);



        try {
            //code...
            $banco_pergunta = BancoPergunta::find($id);
            if ($request->vc_descricao_bp != $banco_pergunta->vc_descricao_bp) {
                if (BancoPergunta::where('vc_descricao_bp', $request->vc_descricao_bp)->exists()) {
                    return redirect()->back()->with('bp.existe_pergunta.warning', 1);
                }
            }
            $join = DB::table('ano_lectivos')->join('banco_perguntas', 'banco_perguntas.it_id_ano_lectivo', '=', 'ano_lectivos.id')->where('ano_lectivos.id', $banco_pergunta->it_id_ano_lectivo)->select('ano_lectivos.*')->first();
            // dd($request);
            $vc_imagem_bp = uploadImage($request, 'vc_imagem_bp', 'assets/images/pergunta');
            // dd($vc_imagem_bp);
            if ($vc_imagem_bp) {
                $ano = BancoPergunta::findOrFail($id)->update([
                    'vc_descricao_bp' => $request->vc_descricao_bp,
                    'it_id_disciplina' => $request->it_id_disciplina,
                    'it_cotacao' => $request->it_cotacao,
                    'it_id_ano_lectivo' => $request->it_id_ano_lectivo,
                    'vc_imagem_bp' => $vc_imagem_bp
                ]);
            } else {
                $ano = BancoPergunta::findOrFail($id)->update([
                    'vc_descricao_bp' => $request->vc_descricao_bp,
                    'it_id_disciplina' => $request->it_id_disciplina,
                    'it_cotacao' => $request->it_cotacao,
                    'it_id_ano_lectivo' => $request->it_id_ano_lectivo
                ]);
            }

            //dd($ano);
            // dd($request->it_id_ano_lectivo);
            $ano_lectivo = AnoLectivo::find($request->it_id_ano_lectivo);

            $this->loggerData(" Editou a Cotação de id, do ano lectivo ($join->id, $join->ya_inicio.' - '.$ $join->ya_inicio) para ($ano_lectivo->ya_inicio.' - '.$ano_lectivo->ya_inicio)");
            //return "sucesso";
            return redirect()->back()->with('banco_pergunta.update.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th);
            return redirect()->back()->with('banco_pergunta.update.error', 1);
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
            $banco_pergunta = BancoPergunta::findOrFail($id);
            BancoPergunta::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a Cotação de id, do ano lectivo ($banco_pergunta->ya_inicio.' - '.$banco_pergunta->ya_inicio)");
            return redirect()->back()->with('banco_pergunta.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            return redirect()->back()->with('banco_pergunta.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $banco_pergunta = BancoPergunta::findOrFail($id);
            $join = DB::table('ano_lectivos')->join('banco_perguntas', 'banco_perguntas.it_id_ano_lectivo', '=', 'ano_lectivos.id')->where('ano_lectivos.id', $banco_pergunta->it_id_ano_lectivo)->select('ano_lectivos.*')->first();
            BancoPergunta::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a cotação de id, ano lectivo ( $join->ya_inicio.' - '. $join->ya_inicio) ");
            return redirect()->back()->with('banco_pergunta.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('banco_pergunta.purge.error', 1);
        }
    }
}