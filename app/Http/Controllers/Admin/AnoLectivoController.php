<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnoLectivo;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AnoLectivoController extends Controller
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
        //
       $data['ano_lectivos'] = AnoLectivo::all();

        //dd($data['ano_lectivos']);
       $this->loggerData("Listou Anos Lectivos");

        return view('admin.ano_lectivo.index', $data);
    //    return "ola";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.ano_lectivo.create.index');
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
        if ($request->ya_inicio >= $request->input('ya_fim')) {
            return redirect()->back()->with('ano_mismatch', 'O ano de inicio não pode ser maior ou igual ao ano de termino');
        } 
        $request->validate([
            'ya_inicio' => 'required|max:255',
            'ya_fim' => 'required|max:255',
        ], [
            'ya_inicio.required' => 'O ano de inicio é um campo obrigatório.',
            'ya_fim.required' => 'O ano de término é um campo obrigatório.',
        ]);

         try {

            $ano_lectivo = AnoLectivo::create([

                'ya_inicio' => $request->ya_inicio,
                'ya_fim' => $request->ya_fim,
            ]);

            $this->loggerData(" Cadastrou o ano lectivo " . $request->ya_inicio." - ".$request->ya_fim);

            return redirect()->back()->with('ano_lectivo.create.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('ano_lectivo.create.error',1);
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
        $data["ano_lectivo"] = AnoLectivo::find($id);

        return view('admin.ano_lectivo.edit.index',$data);
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
        if ($request->ya_inicio >= $request->input('ya_fim')) {
            return redirect()->back()->with('ano_mismatch', 'O ano de inicio não pode ser maior ou igual ao ano de termino');
        } 
        $request->validate([
            'ya_inicio' => 'required|max:255',
            'ya_fim' => 'required|max:255',
        ],[
            'ya_inicio.required' => 'O ano de inicio é um campo obrigatório.',
            'ya_fim.required' => 'O ano de término é um campo obrigatório.',
        ]);

         try {
            //code...
            $ano_lectivo = AnoLectivo::find($id);

            $ano = AnoLectivo::findOrFail($id)->update([
                'ya_inicio' => $request->ya_inicio,
                'ya_fim' => $request->ya_fim,
            ]);
            $this->loggerData(" Editou a o ano lectivo  de id, ano lectivo ($ano_lectivo->id, $ano_lectivo->ya_inicio.' - '.$ano_lectivo->ya_inicio) para ($request->ya_inicio.' - '.$request->ya_inicio)");

            return redirect()->back()->with('ano_lectivo.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('ano_lectivo.update.error',1);
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
            $ano_lectivo = AnoLectivo::findOrFail($id);

            AnoLectivo::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o ano lectivo  de id, ano lectivo ($ano_lectivo->ya_inicio.' - '.$ano_lectivo->ya_inicio) ");
            return redirect()->back()->with('ano_lectivo.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('ano_lectivo.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $ano_lectivo = AnoLectivo::findOrFail($id);
            AnoLectivo::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o ano lectivo  de id, ano lectivo ($ano_lectivo->ya_inicio.' - '.$ano_lectivo->ya_inicio) ");
            return redirect()->back()->with('ano_lectivo.purge.success',1);
        } catch (\Throwable $th) {
           
            return redirect()->back()->with('ano_lectivo.purge.error',1);
        }
    }
}
