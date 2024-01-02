<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SalaController extends Controller
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
       $data['sala'] = Sala::all();

        //dd($data['sala']);
       $this->loggerData("Listou a sala");

       return view('admin.sala.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sala.create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capacidade_total
        // dd($request);
        $request->validate([
            'vc_name' => 'required|max:3',
            'capacidade_total' => 'required|max:2',
        ], [
            'vc_name.max' => 'Este campo admite apenas 3 caracteres',
            'capacidade_total.max' => 'Este campo admite apenas numeros na ordem das dezenas ',
        ]);
       
         try {
            // dd($request);
            $sala = Sala::create([
           
                'vc_nome' => $request->vc_name,
                'capacidade_total' => $request->capacidade_total,
            ]);
            
            $this->loggerData(" Cadastrou a sala " . $request->vc_name);

            return redirect()->back()->with('sala.create.success',1);
       
         } catch (\Throwable $th) {
           dd($th);
            return redirect()->back()->with('sala.create.error',1);
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
        $sala = Sala::all();
        return view('admin.sala.edit.index',['sala'=>$sala]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sala["sala"] = Sala::find($id);

        return view('admin.sala.edit.index',$sala);
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
            'vc_name' => 'required|max:3',
            'capacidade_total' => 'required|max:2',
        ], [
            'vc_name.max' => 'Este campo admite apenas 3 caracteres',
            'capacidade_total.max' => 'Este campo admite apenas numeros na ordem das dezenas ',
        ]);

         try {
            //code...
            $sala= Sala::find($id);

            $ano = Sala::findOrFail($id)->update([
                'vc_nome' => $request->vc_name,
                'capacidade_total' => $request->capacidade_total,
                
            ]);
            $this->loggerData(" Editou a sala   de id, sala ($sala->id, $sala->vc_name) para ($request->vc_name.' - '.$request->vc_name)");

            return redirect()->back()->with('sala.update.success',1);

         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('sala.update.error',1);
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
            $sala = Sala::findOrFail($id);

            Sala::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a sala  de id, sala ($sala->vc_name) ");
            return redirect()->back()->with('sala.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('sala.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $sala = Sala::findOrFail($id);
            Sala::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a sala de id, sala ($sala->vc_name) ");
            return redirect()->back()->with('sala.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('sala.purge.error',1);
        }
    }
}
