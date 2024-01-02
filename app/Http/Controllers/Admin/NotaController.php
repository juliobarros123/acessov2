<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    //
    public function imprimir($id_prova){
        $response['id_prova']=$id_prova;
        $response['notas']=notas()->where('enunciados.it_id_prova',$id_prova)->get();
// dd( $notas);
        // $response['disciplinas'] = Disciplina::get();
        // dd($response['candidatos'] );;
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view("admin.pdfs.nota.index", $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("lista de resultados.pdf", "I");
    }

}
