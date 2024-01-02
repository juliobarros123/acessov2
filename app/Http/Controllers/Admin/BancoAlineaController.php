<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BancoAlinea;
use App\Models\BancoPergunta;
use App\Models\Pergunta;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BancoAlineaController extends Controller
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
        $banco_alinea = BancoAlinea::all();
        $tds = DB::table('banco_alineas')
            ->join('banco_perguntas', 'banco_perguntas.id', 'banco_alineas.it_id_banco_pergunta')->select('banco_perguntas.*', 'banco_alineas.*')
            ->whereNull('banco_alineas.deleted_at')->get();
        // dd($tds);
        return view('admin.banco_alinea.index', ['banco_alineas' => $tds]);
        // return view('admin.pergunta.index',['banco_perguntas'=>$pergunta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $response['banco_perguntas'] = BancoPergunta::all();
        return view('admin.banco_alinea.create.index', $response);
    }
    public function add_alinea($id_pergunta)
    {
        $v = 1;
        if (
            BancoAlinea::where('it_id_banco_pergunta', $id_pergunta)
                ->where('chave', "1")
                ->exists()
        ) {
            $v = 0;
        }
        $response['v'] = $v;
        $response['banco_perguntas'] = BancoPergunta::where('id', $id_pergunta)->get();
        return view('admin.banco_alinea.create.index', $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // dd($request);   
        if (!$request->alinea || count($request->alinea) < 1) {
            return redirect()->back()->with('banco_alinea.create.error', 1);
        }

        foreach ($request->alinea as $alinea) {
            # code...

            if ($alinea['chave'] == "1") {
                if (
                    BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                        ->where('chave', "1")
                        ->exists()
                ) {
                    return redirect()->back()->with('chave.error', 1);
                }

                $request->description = $alinea['description'];
                $request->chave = $alinea['chave'];
                /*    $request->validate([
                       'description' => 'required|max:1000',
                       'chave' => 'required|max:255',
                   ], [
                           'description.required' => 'A descrição é um campo obrigatório.',
                           'chave.required' => 'Campo obrigatório.',
                       ]); */
            }
        }
        /* if ($request->chave == "1") {
            if (
                BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                    ->where('chave', "1")
                    ->exists()
            ) {
                return redirect()->back()->with('chave.error', 1);
            }
        } */


        /*  $request->validate([
             'description' => 'required|max:1000',
             'it_id_banco_pergunta' => 'required|max:255',
             'chave' => 'required|max:255',
         ], [
                 'description.required' => 'A descrição é um campo obrigatório.',
                 'it_id_banco_pergunta.required' => 'Campo obrigatório.',
                 'chave.required' => 'Campo obrigatório.',
             ]); */


        $request->validate([
            'it_id_banco_pergunta' => 'required|max:255',
        ], [
                'it_id_banco_pergunta.required' => 'Campo obrigatório.',
            ]);

        try {

            foreach ($request->alinea as $alinea) {
                if ($alinea['chave'] == "1") {
                    if (
                        BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                            ->where('chave', "1")
                            ->exists()
                    ) {
                        return redirect()->back()->with('chave.error', '1');
                    }
                }
                // dd($request);
                $chave = array_search($alinea, $request->alinea);

                $vc_imagem_ba = uploadImage($request, 'vc_imagem_ba' . $chave, 'assets/images/alinea');
                // dd($vc_imagem_ba);
                $banco_alinea = BancoAlinea::create([
                    'description' => $alinea['description'],
                    'it_id_banco_pergunta' => $request->it_id_banco_pergunta,
                    'chave' => $alinea['chave'],
                    'vc_imagem_ba' => $vc_imagem_ba
                ]);
                //dd($banco_alinea); 
                $this->loggerData(" Cadastrou uma alínea " . $alinea['description'] . " - " . $request->it_id_banco_pergunta . " - " . $request['chave']);
            }
            /* if ($request->chave == "1") {
                if (
                    BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                        ->where('chave', "1")
                        ->exists()
                ) {
                    return redirect()->back()->with('chave.error', '1');
                }
            } */



            /* $banco_alinea = BancoAlinea::create([
                'description' => $request->description,
                'it_id_banco_pergunta' => $request->it_id_banco_pergunta,
                'chave' => $request->chave,
            ]);
            //dd($banco_alinea); 
            $this->loggerData(" Cadastrou uma alínea " . $request->description . " - " . $request->it_id_banco_pergunta . " - " . $request->chave); */

            return redirect()->back()->with('banco_alinea.create.success', 1);

        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('banco_alinea.create.error', 1);
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
        $banco_alinea = BancoAlinea::all();
        return view('admin.banco_alinea.edit.index', ['banco_alinea' => $banco_alinea]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response['banco_alinea'] = BancoAlinea::findOrFail($id);

        $response['banco_perguntas'] = Pergunta::all();
        $v = 1;
        if (
            BancoAlinea::where('it_id_banco_pergunta', $response['banco_alinea']->it_id_banco_pergunta)
                ->where('chave', "1")
                ->exists()
        ) {
            $v = 0;
        }
        $response['v'] = $v;

        $response['banco_alinea'] = DB::table('banco_alineas')
            ->join('banco_perguntas', 'banco_perguntas.id', 'banco_alineas.it_id_banco_pergunta')->select('banco_perguntas.*', 'banco_alineas.*')

            ->where('banco_alineas.id', $id)
            ->select('banco_perguntas.*', 'banco_alineas.*')->first();

        return view('admin.banco_alinea.edit.index', $response);
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
        if ($request->chave == "1") {
            if (
                BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                    ->where('chave', "1")
                    ->exists()
            ) {
                return redirect()->back()->with('banco_alinea.update.error', 1);
            }
        }

        //
        // dd($request);
        $request->validate([
            'description' => 'required|max:1000',
            'it_id_banco_pergunta' => 'required|max:255',
            'chave' => 'required|max:255',
        ], [
                'description.required' => 'A alinea é um campo obrigatório.',
                'it_id_banco_pergunta.required' => 'Campo obrigatório',
                'chave.required' => 'Campo obrigatório',
            ]);

        try {
            //code...
            if ($request->chave == "1") {
                if (
                    BancoAlinea::where('it_id_banco_pergunta', $request->it_id_banco_pergunta)
                        ->where('chave', "1")
                        ->exists()
                ) {
                    return redirect()->back()->with('chave.error', '1');
                }
            }
            $banco_alinea = BancoAlinea::find($id);
            $ano = BancoAlinea::findOrFail($id)->update([
                'description' => $request->description,
                'it_id_banco_pergunta' => $request->it_id_banco_pergunta,
                'chave' => $request->chave,
            ]);
            $vc_imagem_ba = uploadImage($request, 'vc_imagem_ba', 'assets/images/alinea');
            // dd($vc_imagem_ba);
            if ($vc_imagem_ba) {
                $ano = BancoAlinea::findOrFail($id)->update([
                    'vc_imagem_ba' => $vc_imagem_ba
                ]);
            }

            $this->loggerData(" Editou a alinea.  de id, banco_alinea ($banco_alinea->id, $banco_alinea->description) para ($request->it_id_banco_pergunta)");
            return redirect()->back()->with('banco_alinea.update.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('banco_alinea.update.error', 1);
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
            $banco_alinea = BancoAlinea::findOrFail($id);
            BancoAlinea::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a alínea  de id, banco_alinea ($banco_alinea->description. ' - ' .$banco_alinea->it_id_banco_pergunta. ' - ' .$banco_alinea->chave) ");
            return redirect()->back()->with('banco_alinea.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('banco_alinea.destroy.error', 1);
        }
    }
    public function purge($id)
    {
        //
        try {
            //code...
            $banco_alinea = BancoAlinea::findOrFail($id);
            BancoAlinea::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a alinea  de id, banco_alinea ($banco_alinea->description. ' - ' .$banco_alinea->it_id_banco_pergunta. ' - ' .$banco_alinea->chave) ");
            return redirect()->back()->with('banco_alinea.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('banco_alinea.purge.error', 1);
        }
    }
}