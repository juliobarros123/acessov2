<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Classe;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

    class ClasseController extends Controller
    {
        //


    public function __construct(){

        $this->logger=new Logger();

    }
    public function loggerData($mensagem){

    $this->logger->Log('info',$mensagem);
    }


    public function index(){
    $data['classe']=Classe::all();
    //dd($data['ano_lectivos']);
    $this->loggerData("Listou Anos Lectivos");

    return view('admin.classe.index', $data);
        
    }
    public function create(){


    return view('admin.classe.create.index');  
  }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request){
        $request->validate([
            'vc_nome'=>'required'


        ],[
            'vc_nome.required'=>'O nome é um campo obrigatório'
        ]);

        try{
            $classe=Classe::create([
                'vc_nome'=>$request->vc_nome
            ]);

            $this->loggerData(" Cadastrou a classe " . $request->vc_nome);

            return redirect()->back()->with('classe.create.success',1);
       
         } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('classe.create.error',1);
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

    public function edit($id)
    {
        //
        $data["classe"] = Classe::find($id);
        
        return view('admin.classe.edit.index',$data);
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
         //dd($request);
         $request->validate([
            'vc_nome'=>'required'


        ],[
            'vc_nome.required'=>'O nome é um campo obrigatório'
        ]);

        
          try {
             //code...
             $classe = classe::find($id);
             
             $c =Classe::findOrFail($id)->update([
                 'vc_nome' => $request->vc_nome
                 
             ]);
             $this->loggerData(" Editou a classe  de id ($classe->id) para ($request->vc_nome)");
           
             return redirect()->back()->with('classe.update.success',1);
     
          } catch (\Throwable $th) {
          
             return redirect()->back()->with('classe.update.error',1);
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
            $classe =Classe::findOrFail($id);

            Classe::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a classe  de id, ($classe->vc_nome)");
            return redirect()->back()->with('classe.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('classe.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $classe = Classe::findOrFail($id);
            Classe::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a classe  de id, ano lectivo ($classe->vc_nome)");
            return redirect()->back()->with('classe.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('classe.purge.error',1);
        }
    }

 
    }
