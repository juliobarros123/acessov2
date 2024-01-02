<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\BancoPergunta;
use App\Models\Enunciado;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PerguntaController extends Controller
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
            $pergunta = Pergunta::all();
            $tds = DB::table('perguntas')
            ->join('banco_perguntas','banco_perguntas.id','perguntas.it_id_banco_pergunta')
            ->join('enunciados','enunciados.id','perguntas.it_id_enunciado')->select('banco_perguntas.*', 'enunciados.*', 'perguntas.*')
            ->whereNull('perguntas.deleted_at')->get();
            // dd($tds);
            return view('admin.pergunta.index',['perguntas'=>$tds]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bperguntas= BancoPergunta::all();
        $enunciados=Enunciado::all();
        return view('admin.pergunta.create.index',compact('enunciados','bperguntas'));
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
        // dd($request);
        $request->validate([

            'descricao' => 'required|max:255',
            'ch_alinea' => 'required|max:255',
            'it_numero' => 'required|max:255',
            'it_id_banco_pergunta' => 'required|max:255',
            'it_id_enunciado' => 'required|max:255',

        ], [

            'descricao.required' => 'O descricao é um campo obrgatório',
            'ch_alinea.required' => 'O ch_linea é um campo obrgatório',
            'it_numero.required' => 'O it_numero é um campo obrgatório',
            'it_id_banco_pergunta.required' => 'O it_id_banco_pergunta é um campo obrgatório',
            'it_id_enunciado.required' => 'O it_id_enunciado é um campo obrgatório',

        ]);

        try {
            $pergunta = Pergunta::create([
            'descricao' => $request->descricao,
            'ch_alinea' => $request->ch_alinea,
            'it_numero' => $request->it_numero,
            'it_id_banco_pergunta' => $request->it_id_banco_pergunta,
            'it_id_enunciado' => $request->it_id_enunciado,
            

            ]);
            $this->loggerData(" Cadastrou a pergunta " . $request->descricao." - ". $request->ch_alinea." - ". $request->it_numero." - ". $request->it_id_banco_pergunta." - ". $request->it_id_enunciado);
            return redirect()->back()->with('pergunta.create.success',1);
            // return "success"; 
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('pergunta.create.error',1);
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
        $pergunta = Pergunta::all();
        return view('admin.pergunta.edit.index',['pergunta'=>$pergunta]);
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
        
        $pergunta = Pergunta::join('enunciados', 'perguntas.it_id_enunciado', '=', 'enunciados.id')
        ->join('banco_perguntas', 'perguntas.it_id_banco_pergunta', '=', 'banco_perguntas.id')
        ->select('perguntas.*', 'enunciados.codigo as codigo', 'banco_perguntas.it_cotacao as it_cotacao')
        ->findOrFail($id);

        $bperguntas= BancoPergunta::all();
        $enunciados=Enunciado::all();

        return view('admin.pergunta.edit.index',compact('enunciados','bperguntas','pergunta'));
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
        // dd($request);
        $request->validate([
            'descricao' => 'required|max:255',
            'ch_alinea' => 'required|max:255',
            'it_numero' => 'required|max:255'],[
            'descricao.required' => 'O descricao é um campo obrgatório',
            'ch_alinea.required' => 'O ch_linea é um campo obrgatório',
            'it_numero.required' => 'O it_numero é um campo obrgatório',
        ]);

         try {
            //code...
            $pergunta = Pergunta::find($id);

            $bpergunta = Pergunta::findOrFail($id)->update([
            'descricao' => $request->descricao,
            'ch_alinea' => $request->ch_alinea,
            'it_numero' => $request->it_numero,
            'it_id_banco_pergunta' => $request->it_id_banco_pergunta,
            'it_id_enunciado' => $request->it_id_enunciado]);
            $this->loggerData(" Editou a pergunta.  de id, enunciado ($pergunta->id, $pergunta->descricao.' - '.$request->descricao) para ($request->descricao.' - '.$request->descricao)");
            return redirect()->back()->with('pergunta.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('pergunta.update.error',1);
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
        ////
        try {
            //code...
            $pergunta = Pergunta::findOrFail($id);

            Pergunta::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o pergunta  de id, pergunta ($pergunta->descricao.' - '.$pergunta->descricao) ");
            return redirect()->back()->with('pergunta.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('pergunta.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $pergunta = Pergunta::findOrFail($id);
            Pergunta::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o pergunta  de id, pergunta ($pergunta->descricao) ");
            return redirect()->back()->with('pergunta.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('pergunta.purge.error',1);
        }
    }

}
