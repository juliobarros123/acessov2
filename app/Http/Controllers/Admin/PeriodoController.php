<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periodo;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
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
       $data['periodos'] = Periodo::all();

        //dd($data['periodos']);
       $this->loggerData("Listou Periodos");

       return view('admin.periodo.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.periodo.create.index');
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
             'vc_nome.required' => 'O periodo é um campo obrigatório.',
         ]);
        
          try {
            
             $periodo = Periodo::create([
            
                 'vc_nome' => $request->vc_nome,
             ]);
             
             $this->loggerData(" Cadastrou o periodo " . $request->vc_nome);
 
             return redirect()->back()->with('periodo.create.success',1);
        
          } catch (\Throwable $th) {
             //throw $th;
             return redirect()->back()->with('periodo.create.error',1);
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
        $data["periodo"] = Periodo::find($id);

        return view('admin.periodo.edit.index',$data);
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
            'vc_nome' => 'required|max:255',
        ], [
            'vc_nome.required' => 'O periodo é um campo obrigatório.',
        ]);
       
         try {
            //code...
            $periodo = Periodo::find($id);
            
            $periodo = Periodo::findOrFail($id)->update([
                'vc_nome' => $request->vc_nome,
            ]);
            $this->loggerData(" Editou o periodo  de id, periodo ($periodo->id, $periodo->vc_nome.' - '.$periodo->vc_nome) para ($request->vc_nome.' - '.$request->vc_nome)");
          
            return redirect()->back()->with('periodo.update.success',1);
    
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('periodo.update.error',1);
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
            $periodo = Periodo::findOrFail($id);

            Periodo::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o periodo  de id, periodo ($periodo->vc_nome)");
            return redirect()->back()->with('periodo.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('periodo.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $periodo = Periodo::findOrFail($id);
            Periodo::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o periodo  de id, periodo ($periodo->vc_nome) ");
            return redirect()->back()->with('periodo.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('periodo.purge.error',1);
        }
    }

}