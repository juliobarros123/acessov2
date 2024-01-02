<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class DisciplinaController extends Controller
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
        $disciplinas = Disciplina::all();
        return view('admin.disciplina.index',['disciplinas'=>$disciplinas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.disciplina.create.index');
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
        //dd($request);
        $request->validate([
            'vc_nome' => 'required|max:255',
        ], [
            'vc_nome.required' => 'O nome da disciplina é um campo obrigatório.',
        ]);

         try {

            $disciplina = Disciplina::create([
                'vc_nome' => $request->vc_nome,
            ]);
            $this->loggerData(" Cadastrou a disciplina " . $request->vc_nome);
            return redirect()->back()->with('disciplina.create.success',1);
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('disciplina.create.error',1);
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $disciplinas = Disciplina::all();
        return view('admin.disciplina.edit.index',['disciplinas'=>$disciplinas]);
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
        $data["disciplina"] = Disciplina::find($id);

        return view('admin.disciplina.edit.index',$data);
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
            'vc_nome' => 'required|max:255'],[
            'vc_nome.required' => 'O nome da disciplina é um campo obrigatório.',
        ]);

         try {
            //code...
            $disciplina = Disciplina::find($id);

            $ano = Disciplina::findOrFail($id)->update([
                'vc_nome' => $request->vc_nome]);
            $this->loggerData(" Editou a disciplina  de id, disciplina ($disciplina->id, $disciplina->vc_nome) para ($request->vc_nome)");

            return redirect()->back()->with('disciplina.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('disciplina.update.error',1);
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
            $disciplina = Disciplina::findOrFail($id);
            Disciplina::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a disciplina  de id, fisciplina ($disciplina->vc_nome) ");
            return redirect()->back()->with('disciplina.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('disciplina.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $disciplina = Disciplina::findOrFail($id);
            Disciplina::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a disciplina  de id, disciplina ($disciplina->vc_nome) ");
            return redirect()->back()->with('disciplina.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('disciplina.purge.error',1);
        }
    }
}
