<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FolhaResposta;
use App\Models\Candidato;
use App\Models\Enunciado;
use App\Models\AnoLectivo;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FolhaRespostaController extends Controller
{
    //
    public function __construct(){
        $this->logger=new Logger();
    }
    public function loggerData($mensagem){

        $this->logger->log('info',$mensagem);
    }

    public function index(){

        $data['folhaResposta']=DB::table('folha_respostas')->join('enunciados','folha_respostas.it_id_enunciado','=','enunciados.id')->join('candidatos','folha_respostas.it_id_candidato','=','candidatos.id')->join('ano_lectivos','folha_respostas.it_id_ano_lectivo','=','ano_lectivos.id')->select('folha_respostas.*','enunciados.codigo','candidatos.vc_primeiro_nome','candidatos.vc_bi','candidatos.vc_ultimo_nome','ano_lectivos.ya_inicio','ano_lectivos.ya_fim')->whereNull('folha_respostas.deleted_at')->get();

        $this->loggerData('Listou as Folhas de Respostas');

    return view('admin.folhaResposta.index',$data);}



public function create(){
    $candidato=Candidato::all();
    $enunciado=Enunciado::all();
    $anoLectivo=AnoLectivo::all();
return view('admin.folhaResposta.create.index',compact('candidato','enunciado','anoLectivo'));

}
public function store(Request $request){
$request->validate([
    'id_candidato'=>'required',
    'id_enunciado'=>'required',
    'id_ano_lectivo'=>'required'
],[
    'it_id_candidato'=>'required',
    'it_id_enunciado'=>'required',
    'it_id_ano_lectivo'=>'required'

]);
try{
   $folhaResposta= FolhaResposta::create([
    'it_id_candidato'=>$request->id_candidato,
    'it_id_enunciado'=>$request->id_enunciado,
    'it_id_ano_lectivo'=>$request->id_ano_lectivo

    ]);
    $this->loggerData("Cadastrou a folha " . $request->id_enunciado ." do candidato " . $request->id_candidato . "no ano lectivo" .$request->id_ano_lectivo);



    return redirect()->back()->with('folhaResposta.create.success',1);}

catch(\Throwable $th){

    return redirect()->back()->with('folhaResposta.create.error',1);
}


}

public function show($id){

}
public function edit($id){
$data['folhaResposta']=DB::table('folha_respostas')->join('enunciados','folha_respostas.it_id_enunciado','=','enunciados.id')->join('candidatos','folha_respostas.it_id_candidato','=','candidatos.id')->join('ano_lectivos','folha_respostas.it_id_ano_lectivo','=','ano_lectivos.id')->select('folha_respostas.*','enunciados.codigo','candidatos.vc_primeiro_nome','candidatos.vc_ultimo_nome','candidatos.vc_bi','ano_lectivos.ya_inicio','ano_lectivos.ya_fim')->whereNull('folha_respostas.deleted_at')->where('folha_respostas.id',$id)->first();

$candidato=Candidato::all();
$enunciado=Enunciado::all();
$anoLectivo=AnoLectivo::all();
return view('admin.folhaResposta.edit.index',$data,compact('candidato','enunciado','anoLectivo'));}


public function update(Request $request,$id){
$request->validate([
    'id_candidato'=>'required',
    'id_enunciado'=>'required',
    'id_ano_lectivo'=>'required'

],[
    'it_id_candidato.required'=>'O candidato é um campo obrigatório',
    'it_id_enunciado.required'=>'O enunciado é campo obrigatório',
    ' it_id_ano_lectivo.required'=>'O ano lectivo é um campo obrigatório'
]);

try{
$folhaResposta=FolhaResposta::find($id);
$folha=FolhaResposta::findOrFail($id)->update([
'it_id_candidato'=>$request->id_candidato,
'it_id_enunciado'=>$request->id_enunciado,
'it_id_ano_lectivo'=>$request->id_ano_lectivo

]);




return redirect()->back()->with('folhaResposta.update.success',1);}
catch(\Throwable){
    return redirect()->back()->with('classe.update.error',1);
}

}

public function destroy($id){
    try {
        //code...

$folhaResposta=FolhaResposta::findOrFail($id);
FolhaResposta::findOrFail($id)->delete();
$this->loggerData(" Eliminou a folha de resposta de id, ($folhaResposta->id)");
return redirect()->back()->with('folhaResposta.destroy.success',1);    }
catch (\Throwable $th) {
        //throw $th;

return redirect()->back()->with('folhaResposta.destroy.error',1); }

}

public function purge($id){
    try {
        //code...
        $folhaResposta = FolhaResposta::findOrFail($id);
        FolhaResposta::findOrFail($id)->forceDelete();
        $this->loggerData(" Purgou a folha de resposta  de id, ($folhaResposta->id)");
        return redirect()->back()->with('folhaResposta.purge.success',1);
    } catch (\Throwable $th) {
        //throw $th;
        return redirect()->back()->with('folhaResposta.purge.error',1);
    }



}











}
