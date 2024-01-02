<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;
use Carbon\Carbon;
use App\Models\Logger;
use App\Models\Periodo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class HorarioController extends Controller
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
        $horarios = Horario::join('periodos', 'horarios.it_id_periodo', '=', 'periodos.id')
                            ->select('horarios.*', 'periodos.vc_nome as periodo')
                            ->get();
        
        $this->loggerData("Listou Anos Lectivos");
        
        return view('admin.horario.index', compact('horarios'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.horario.create.index');
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
         //dd($request->inicio_prova);
         if ($request->inicio_prova >= $request->input('termino_prova')) {
            return redirect()->back()->with('horario_mismatch', 'O ano de inicio não pode ser maior ou igual ao ano de termino');
        } 
        $request->validate([
            'inicio_prova' => 'required|max:255',
            'termino_prova' => 'required|max:255',
        ], [
            'inicio_prova.required' => 'O ano de inicio é um campo obrigatório.',
            'termino_prova.required' => 'O ano de término é um campo obrigatório.',
        ]);

        $inicio_prova = Carbon::parse($request->inicio_prova);
        $termino_prova = Carbon::parse($request->termino_prova);
        
        if ($termino_prova->lt($inicio_prova)) {
            return redirect()->back()->with('horario_mismatch', 'O horário de término não pode ser menor que o horário de início.');
        }
        
        if ($inicio_prova->between(Carbon::parse('05:00:00'), Carbon::parse('12:00:00'))) {
            $periodo = Periodo::where("vc_nome","Manhã")->first();
            $it_id_periodo=$periodo->id;
        } elseif ($inicio_prova->between(Carbon::parse('12:00:00'), Carbon::parse('18:00:00'))) {
            $periodo = Periodo::where("vc_nome","Tarde")->first();
            $it_id_periodo=$periodo->id;
        } else {
            $periodo = Periodo::where("vc_nome","Noite")->first();
            $it_id_periodo=$periodo->id;
        }
        
        
        try {
            
            
            //dd($request->inicio_prova);

            $horario = Horario::create([
                'it_id_periodo' => $it_id_periodo,
                'inicio_prova' => $inicio_prova,
                'termino_prova' => $termino_prova,
            ]);
        
            $this->loggerData("Cadastrou o horário " . $inicio_prova . " - " . $termino_prova);
        
            return redirect()->back()->with('horario.create.success', 1);
        
        } catch (\Throwable $th) {
            throw $th;
            dd($th);
            return redirect()->back()->with('horario.create.error', 1);
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
        $data["horario"] = Horario::find($id);

        return view('admin.horario.edit.index',$data);
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
        if ($request->inicio_prova >= $request->input('termino_prova')) {
            return redirect()->back()->with('horario_mismatch', 'O ano de inicio não pode ser maior ou igual ao ano de termino');
        } 
        $request->validate([
            'inicio_prova' => 'required|max:255',
            'termino_prova' => 'required|max:255',
        ],[
            'inicio_prova.required' => 'O ano de inicio é um campo obrigatório.',
            'termino_prova.required' => 'O ano de término é um campo obrigatório.',
        ]);

         try {
            //code...
            $horario = Horario::find($id);

            $ano = Horario::findOrFail($id)->update([
                'it_id_periodo'=>2,
                'inicio_prova' => $request->inicio_prova,
                'termino_prova' => $request->termino_prova,
            ]);
            $this->loggerData(" Editou a o horário  de id, horário ($horario->id, $horario->inicio_prova.' - '.$horario->termino_prova) para ($request->inicio_prova.' - '.$request->termino_prova)");

            return redirect()->back()->with('horario.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('horario.update.error',1);
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
            $horario = Horario::findOrFail($id);

            Horario::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o horário  de id, horário ($horario->inicio_prova.' - '.$horario->termino_prova) ");
            return redirect()->back()->with('horario.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('horario.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $horario = Horario::findOrFail($id);
            Horario::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o horário  de id, horário ($horario->inicio_prova.' - '.$horario->termino_prova) ");
            return redirect()->back()->with('horario.purge.success',1);
        } catch (\Throwable $th) {
           
            return redirect()->back()->with('horario.purge.error',1);
        }
    }
}
