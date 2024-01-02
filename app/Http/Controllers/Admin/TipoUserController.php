<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoUser;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class TipoUserController extends Controller
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
        $tipo_users = TipoUser::all();
        return view('admin.tipo_user.index',['tipo_users'=>$tipo_users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tipo_user.create.index');
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
            'vc_nome.required' => 'O nome da tipo_user é um campo obrigatório.',
        ]);
         try {

            $tipo_user = TipoUser::create([
                'nome' => $request->vc_nome,
            ]);
            $this->loggerData(" Cadastrou a tipo_user " . $request->vc_nome);
            return redirect()->back()->with('tipo_user.create.success',1);
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('tipo_user.create.error',1);
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
        $tipo_users = TipoUser::all();
        return view('admin.tipo_user.edit.index',['tipo_users'=>$tipo_users]);
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
        $data["tipo_user"] = TipoUser::find($id);
        return view('admin.tipo_user.edit.index',$data);
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
            'vc_nome.required' => 'O nome da tipo_user é um campo obrigatório.',
        ]);

         try {
            //code...
            $tipo_user = TipoUser::find($id);
            $ano = TipoUser::findOrFail($id)->update([
                'nome' => $request->vc_nome]);
            $this->loggerData(" Editou a tipo_user  de id, tipo_user ($tipo_user->id, $tipo_user->nome) para ($request->vc_nome)");

            return redirect()->back()->with('tipo_user.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('tipo_user.update.error',1);
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
            $tipo_user = TipoUser::findOrFail($id);

            TipoUser::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a tipo_user  de id, fisciplina ($tipo_user->nome) ");
            return redirect()->back()->with('tipo_user.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('tipo_user.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $tipo_user = TipoUser::findOrFail($id);
            TipoUser::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a tipo_user  de id, tipo_user ($tipo_user->nome) ");
            return redirect()->back()->with('tipo_user.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('tipo_user.purge.error',1);
        }
    }
}
