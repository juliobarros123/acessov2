<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlineaGerada;
use App\Models\CoordenadaRespotaEnunciado;
use App\Models\Nota;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Enunciado;
use App\Models\Sala;
use App\Models\AnoLectivo;
use App\Models\BancoAlinea;
use App\Models\BancoPergunta;
use App\Models\Disciplina;
use App\Models\Periodo;
use App\Models\Candidato;
use App\Models\Logger;
use App\Models\Pergunta;
use App\Models\Prova;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\CandidatoFolhaResposta;
use App\Models\Curso;
use Imagick;
use ImagickPixel;
use Spatie\PdfToImage\Pdf;

use thiagoalessio\TesseractOCR\TesseractOCR;

class EnunciadoSalaController extends Controller
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

    public function room()
    {
        //
        $data['sala'] = Sala::all();

        // dd($data['sala']);
        $this->loggerData("Listou a sala");

        return view('admin.enunciado.sala.index', $data);
    }

    public function gerar(Request $request)
    {
        // dd( $request);
        $count_cand = 0;
        $alineas = [];
        for ($i = 97; $i <= 122; $i++) {
            $alineas[] = chr($i);
        }
        // dd(     $alineas);
        $contAliania = 0;
        $contOrdemPergunta = 1;
        // dd($request->all());
        $prova = Prova::find($request->it_id_prova);
        // dd( $prova);


        // if (CandidatoFolhaResposta::where(
        //     'it_id_enunciado',
        //     $request->id_enunciado
        // )->whereYear('created_at',date('Y'))->count()) {
        //   return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Candidato já tem enunciado para este ano lectivo!']);
        // }D
        // dd( $prova->it_id_curso);
        $candidatos = Candidato::whereYear('candidatos.created_at', date('Y'))
            ->where('it_id_curso', $prova->it_id_curso)->get();
        // dd($candidatos);
        if ($request->n_enunciados <= $candidatos->count()) {

            // $request->n_enunciados = $candidatos->count();
            $candidatos = Candidato::whereYear('candidatos.created_at', date('Y'))
                ->where('it_id_curso', $prova->it_id_curso)->limit($request->n_enunciados)->get();
        } else {
            $candidatos = Candidato::whereYear('candidatos.created_at', date('Y'))
                ->where('it_id_curso', $prova->it_id_curso)->limit($candidatos->count())->get();
        }
        // dd( $request->n_enunciados);
        // dd(  $candidatos );
        $bps = BancoPergunta::inRandomOrder()->limit($request->it_n_pergunta)->where('it_id_disciplina', $request->it_id_disciplina)->get();

        foreach ($candidatos as $candidato) {

            $c = CandidatoFolhaResposta::join('enunciados', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
                ->join('provas', 'enunciados.it_id_prova', '=', 'provas.id')


                ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

                ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
                ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
                ->where('provas.it_id_sala', $prova->it_id_sala)
                ->where('candidato_folha_respostas.it_id_candidato', $candidato->id)
                ->where('enunciados.it_id_disciplina', $request->it_id_disciplina)
                ->whereYear('candidato_folha_respostas.created_at', date('Y'))
                ->count();
            if (!$c) {
                $enunciado = Enunciado::create([
                    'codigo' => $candidato->id,
                    // 'id_ano_lectivo' =>  $request->it_id_ano_lectivo,
                    'it_id_disciplina' => $request->it_id_disciplina,
                    // 'id_periodo' => $request->id_periodo,
                    // 'it_id_sala' => $request->it_id_sala,
                    'it_id_prova' => $request->it_id_prova,
                    'vc_coordenador' => $request->coordenador
                ]);
                $ya_fim = AnoLectivo::find($prova->it_id_ano_lectivo)->ya_fim;
                Enunciado::find($enunciado->id)->update([
                    'codigo' => "$enunciado->id$request->it_id_disciplina$ya_fim",
                ]);

                // dd(  $c);
                $count_cand++;
                CandidatoFolhaResposta::create([
                    'it_id_enunciado' => $enunciado->id,
                    'it_id_candidato' => $candidato->id
                ]);
                // break;



                foreach ($bps as $bp) {
                    $pergunta = Pergunta::create([
                        'descricao' => $bp->vc_descricao_bp,
                        'ch_alinea' => 1,
                        'it_numero' => $contOrdemPergunta,
                        'it_id_banco_pergunta' => $bp->id,
                        'it_id_enunciado' => $enunciado->id,
                        'it_cotacao' => $request->it_cotacao
                    ]);
                    $bas = BancoAlinea::where('it_id_banco_pergunta', $bp->id)->get();
                    foreach ($bas as $ba) {
                        AlineaGerada::create([
                            'alinea' => $alineas[$contAliania],
                            'it_id_pergunta' => $pergunta->id,
                            'it_id_banco_alinea' => $ba->id
                        ]);
                        $contAliania++;
                    }
                    $contAliania = 0;
                    $contOrdemPergunta++;
                }
                $contOrdemPergunta = 1;
            }
        }
        if ($count_cand) {
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Enunciados gerados com sucesso!']);
        } else {
            return redirect()->back()->with('feedback', ['type' => 'warning', 'sms' => 'Os enunciados já foram atribuídos a todos os candidatos que atendem a esses parâmetros!']);

        }
    }
    // public function gerar(Request $request)
    // {
    //     $url = $request->url();

    //     $alineas = ['a', 'b', 'c', 'd', 'f', 'g', 'h'];
    //     $contAliania = 0;
    //     $contOrdemPergunta = 1;

    //     for ($i = 0; $i < $request->n_enunciados; $i++) {
    //         $enunciado = Enunciado::create([
    //             'codigo' => $i,
    //             'id_ano_lectivo' =>  $request->it_id_ano_lectivo,
    //             'it_id_sala' =>  $request->it_id_sala,
    //             'it_id_prova' =>  $request->it_id_prova,
    //             'it_id_disciplina' => $request->it_id_disciplina,
    //             'id_periodo' => $request->id_periodo,
    //             'vc_coordenador'=> $request->coordenador
    //         ]);
    //         $ya_fim = AnoLectivo::find($request->it_id_ano_lectivo)->ya_fim;
    //         Enunciado::find($enunciado->id)->update([
    //             'codigo' => "$enunciado->id$request->it_id_disciplina$ya_fim",
    //         ]);
    //         $bps =  BancoPergunta::inRandomOrder()->limit($request->it_n_pergunta)->where('it_id_disciplina', $request->it_id_disciplina)->get();
    //         foreach ($bps as $bp) {
    //             $pergunta = Pergunta::create([
    //                 'descricao' => $bp->vc_descricao_bp,
    //                 'ch_alinea' => 1,
    //                 'it_numero' => $contOrdemPergunta,
    //                 'it_id_banco_pergunta' => $bp->id,
    //                 'it_id_enunciado' => $enunciado->id,
    //                 'it_cotacao'=>$request->it_cotacao
    //             ]);
    //             $bas =  BancoAlinea::where('it_id_banco_pergunta', $bp->id)->inRandomOrder()->limit(10)->get();
    //             foreach ($bas as $ba) {
    //                 AlineaGerada::create([
    //                     'alinea' => $alineas[$contAliania],
    //                     'it_id_pergunta' => $pergunta->id,
    //                     'it_id_banco_alinea' => $ba->id
    //                 ]);
    //                 $contAliania++;
    //             }
    //             $contAliania = 0;
    //             $contOrdemPergunta++;
    //         }
    //         $contOrdemPergunta = 1;
    //     }
    //     return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Enunciados gerados com sucesso!']);
    // }
    public function gerar_por_disciplina($id_disciplina)
    {
        $alineas = [];
        for ($i = 97; $i <= 122; $i++) {
            $alineas[] = chr($i);
        }


        // $alineas = ['a', 'b', 'c', 'd', 'f', 'g', 'h', 'e', 'f', 'g'];
        $contAliania = 0;
        $contOrdemPergunta = 1;
        for ($i = 0; $i < 3; $i++) {
            $enunciado = Enunciado::create([
                'codigo' => $i,
                'it_id_sala' => $request->it_id_sala,
                'it_id_prova' => $request->it_id_prova,
                'id_ano_lectivo' => AnoLectivo::orderBy('id', 'desc')->first()->id,
                'it_id_disciplina' => 1,
                'id_periodo' => 1,
            ]);

            $bps = BancoPergunta::inRandomOrder()->limit(4)->where('it_id_disciplina', $id_disciplina)->get();
            foreach ($bps as $bp) {
                $pergunta = Pergunta::create([
                    'descricao' => $bp->vc_descricao_bp,
                    'ch_alinea' => 1,
                    'it_numero' => $contOrdemPergunta,
                    'it_id_banco_pergunta' => $bp->id,
                    'it_id_enunciado' => $enunciado->id
                ]);
                $bas = BancoAlinea::where('it_id_banco_pergunta', $bp->id)->inRandomOrder()->limit(10)->get();
                foreach ($bas as $ba) {
                    AlineaGerada::create([
                        'alinea' => $alineas[$contAliania],
                        'it_id_pergunta' => $pergunta->id,
                        'it_id_banco_alinea' => $ba->id
                    ]);
                    $contAliania++;
                }
                $contAliania = 0;
                $contOrdemPergunta++;
            }
            $contOrdemPergunta = 1;
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Enunciados gerados com sucesso!']);
    }
    public function imprimir($id_enunciado)
    {
        // dd("r");
        $response['enunciado'] =
            $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

                ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
                ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

                ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
                ->join('salas', 'provas.it_id_sala', '=', 'salas.id')


                ->select('enunciados.*', 'salas.vc_nome as sala', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->find($id_enunciado);

        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("Enunciado.pdf", "I");

        // return view('admin.enunciado.imprimir.index',  $response);
    }
    public function imprimir_folha_resposta($id_enunciado)
    {
        // dd("ol");
        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftJoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftJoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            // ->where('provas.id', $id_prova)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->where('enunciados.id', $id_enunciado)->get();
        // $response['candidato'] = Candidato::find($request->id_candidato);
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8'
        ]);

        $mpdf->SetHTMLFooter('<div>Este é o rodapé personalizado da última página.</div>', 'E');

        // Configura a opção para ajustar automaticamente a margem inferior

        // Configura a opção para ajustar automaticamente a margem inferior
        $mpdf->setAutoBottomMargin = 'stretch';
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir-fr-individual.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // return     $html ;  
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta-$id_enunciado.pdf", "I");
        // $pdfContent = $mpdf->Output("Folha de resposta.pdf", "S");
        // // $mpdf->Output("Folha de resposta.pdf", "S");

        // // Salvar o PDF na pasta public
        // $pdfPath = public_path("generated-pdf-$id_enunciado.pdf");
        // file_put_contents($pdfPath, $pdfContent);

        // $mpdf->Output("Folha de resposta.pdf", "S");

        // Converter PDF para imagem JPG usando setasign/fpdi
        // $pdf = new Fpdi();
        // $pdf->AddPage();
        // $pdf->setSourceFile($pdfPath);
        // $tplIdx = $pdf->importPage(1, '/MediaBox');
        // $pdf->useTemplate($tplIdx, 0, 0, 210);

        // // Salvar imagem JPG
        // $imagePath = public_path("generated-pdf-$id_enunciado.jpg");

        // imagejpeg($pdf->Image($imagePath, 0, 0, 210), $imagePath, 100);


    }
    // 
    public function imprimir_fr_massa($id_prova)
    {
        // dd("ola");
        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftjoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftjoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            ->where('provas.id', $id_prova)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'candidatos.vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->orderby('candidatos.vc_primeiro_nome', 'asc')
            ->orderby('candidatos.vc_nome_meio', 'asc')
            ->orderby('candidatos.vc_ultimo_nome', 'asc')
            ->get();
        // dd($response['enunciados']);


        // ->find($id_enunciado);

        // dd($response['enunciados']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        // dd("ao");
        $response["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.gabarito.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        ini_set("pcre.backtrack_limit", "2000000");
        $mpdf->writeHTML($html);
        $mpdf->Output("Gabarito.pdf", "I");
    }

    public function folha_correcao($id_enunciado)
    {
        // dd("ola");
        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftjoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftjoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            ->where('enunciados.id', $id_enunciado)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'candidatos.vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->orderby('candidatos.vc_primeiro_nome', 'asc')
            ->orderby('candidatos.vc_nome_meio', 'asc')
            ->orderby('candidatos.vc_ultimo_nome', 'asc')
            ->get();
        // dd($response['enunciados']);


        // ->find($id_enunciado);

        // dd($response['enunciados']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        // dd("ao");
        $response["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir-folha-correcao.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        ini_set("pcre.backtrack_limit", "2000000");
        $mpdf->writeHTML($html);
        // dd("ola");
        $pdfContent = $mpdf->Output("folha-correcao-$id_enunciado.pdf", "I");
        $pdfPath = public_path("folha-correcao-$id_enunciado.pdf");
        file_put_contents($pdfPath, $pdfContent);

        $mpdf->Output("Folha de resposta-$id_enunciado.pdf", "S");

        // Caminho para o arquivo PDF
        //    $pdfFilePath = public_path("folha-correcao-$id_enunciado.pdf");

        //    // Caminho para salvar a imagem JPG resultante
        //    $imageFilePath = public_path("images/folha-correcao-$id_enunciado.jpg");

        //    // Crie uma instância do objeto Pdf
        //    $pdf = new Pdf($pdfFilePath);

        //    // Converte a primeira página do PDF em uma imagem JPG
        //    $pdf->setPage(1)->saveImage($imageFilePath);

        //    return 'Conversão concluída.';

        // // Salvar imagem JPG
        // $imagePath = public_path("generated-pdf-$id_enunciado.jpg");

        // imagejpeg($pdf->Image($imagePath, 0, 0, 210), $imagePath, 100);
    }
    public function folha_resposta($id_enunciado)
    {
        // dd("ol");
        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftJoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftJoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            // ->where('provas.id', $id_prova)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->where('enunciados.id', $id_enunciado)->get();
        // $response['candidato'] = Candidato::find($request->id_candidato);
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8'
        ]);

        $mpdf->SetHTMLFooter('<div>Este é o rodapé personalizado da última página.</div>', 'E');

        // Configura a opção para ajustar automaticamente a margem inferior

        // Configura a opção para ajustar automaticamente a margem inferior
        $mpdf->setAutoBottomMargin = 'stretch';
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir-folha-resposta.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // return     $html ;  
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta-$id_enunciado.pdf", "I");
        // $pdfContent = $mpdf->Output("Folha de resposta.pdf", "S");
        // // $mpdf->Output("Folha de resposta.pdf", "S");

        // // Salvar o PDF na pasta public
        // $pdfPath = public_path("generated-pdf-$id_enunciado.pdf");
        // file_put_contents($pdfPath, $pdfContent);

        // $mpdf->Output("Folha de resposta.pdf", "S");

        // Converter PDF para imagem JPG usando setasign/fpdi
        // $pdf = new Fpdi();
        // $pdf->AddPage();
        // $pdf->setSourceFile($pdfPath);
        // $tplIdx = $pdf->importPage(1, '/MediaBox');
        // $pdf->useTemplate($tplIdx, 0, 0, 210);

        // // Salvar imagem JPG
        // $imagePath = public_path("generated-pdf-$id_enunciado.jpg");

        // imagejpeg($pdf->Image($imagePath, 0, 0, 210), $imagePath, 100);

    }


    public $cont_imagem = 0;
    public $coordenadas_centro_pintados = [];

    public function carregar_chave(Request $request)
    {
        // dd($request);
        $chave = uploadImage($request, 'chave', 'chave/enunciado');
        //    dd($chave);
        $imagePath = $chave;
        // dd( $imagePath );
        $image = imagecreatefromjpeg($imagePath);
        $contours = $this->contours($image, $imagePath);
        $coordenadas_centro_pintados = $this->ponto_preenchido($image, $contours)['coordenadas_centro_pintados'];

        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);
        // echo "<pre>";
        // print_r($coordenadas_centro_pintados);
        $cont = CoordenadaRespotaEnunciado::where('it_id_enunciado', $request->id_enunciado)->count();
        if ($cont) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Já existe uma chave para este enunciado1']);

        }
        foreach ($coordenadas_centro_pintados as $ccp) {
            // dd($ccp[0]["x"]);
            CoordenadaRespotaEnunciado::create(
                [
                    'it_id_enunciado' => $request->id_enunciado,
                    'x' => $ccp[0]["x"],
                    'y' => $ccp[0]["y"]
                ]
            );
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Chave Carregada com Sucesso!']);

    }
    public function carregar_chave_geral(Request $request)
    {
        // dd($request);
        $chave = uploadImage($request, 'chave', 'chave/enunciado');
        //    dd($chave);
        $imagePath = $chave;
        // dd( $imagePath );
        $image = imagecreatefromjpeg($imagePath);
        $contours = $this->contours($image, $imagePath);
        $coordenadas_centro_pintados = $this->ponto_preenchido($image, $contours)['coordenadas_centro_pintados'];

        // header('Content-Type: image/jpeg');
        // imagejpeg($image);
        // imagedestroy($image);
        // echo "<pre>";
// print_r($coordenadas_centro_pintados);
        $enunciados = Enunciado::where('it_id_prova', $request->it_id_prova)->get();
        // dd(  $enunciados);
        foreach ($enunciados as $enunciado) {
            $cont = CoordenadaRespotaEnunciado::where('it_id_enunciado', $enunciado->id)->count();
            if (!$cont) {
                // return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Já existe uma chave para este enunciado1']);
                foreach ($coordenadas_centro_pintados as $ccp) {
                    // dd($ccp[0]["x"]);
                    CoordenadaRespotaEnunciado::create(
                        [
                            'it_id_enunciado' => $enunciado->id,
                            'x' => $ccp[0]["x"],
                            'y' => $ccp[0]["y"]
                        ]
                    );
                }
            }
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Chave Carregada com Sucesso!']);
    }

    public function corregir_massa_geral($id_prova)
    {
        // $enunciados = Enunciado::where('it_id_prova', $id_prova)->get();
// dd($enunciados);
        //    dd(2);
        // Pasta onde estão as imagens
        $pastaImagens = 'imgs-test';

        // Padrão de busca para arquivos JPG
        $padraoBusca = $pastaImagens . '/*.jpg';

        // Obtém a lista de arquivos JPG na pasta
        $listaImagens = glob($padraoBusca);

        // Verifica se há imagens na pasta
        if ($listaImagens) {
            // Exibe a lista de imagens


            // Transforma a lista de imagens em vetor
            $vetorImagens = $listaImagens;
            $estatistica = [];
            foreach ($vetorImagens as $key => $imagePath) {
                $codigos = extrairCodigosEnunciados($imagePath);
                // dd($codigos );
                if (isset($codigos['codigoEnunciado'])) {
                    $enunciado = Enunciado::where('codigo', $codigos['codigoEnunciado'])->get()->first();
                    // dd($enunciado );
                    if ($enunciado) {
                        $cont = $this->corrigir_individual($enunciado->id, $imagePath);
                        // dd($cont,0);
                        $estatisticas[] = ['codigoEnunciado' => $codigos['codigoEnunciado'], 'codigoCandidato' => $codigos['codigoCandidato'], 'numero' => $key + 1, 'numero' => $key + 1, 'prova' => $imagePath, 'qtCerta' => $cont];
                        // dd($codigos, 0, $estatistica);
                    }

                }
            }
        } else {
            echo "Nenhuma imagem encontrada na pasta.\n";
        }
        
        // dd($estatistica);
        $this->registrar_notas($estatisticas);
        return redirect()->route('admin.notas.imprimir', $id_prova)
        ;

        // $this->corrigir_individual($$id_enunciado, $imagePath);
    }
    public function registrar_notas($estatisticas)
    {
        foreach ($estatisticas as $estatistica) {
            // dd();
            if (isset($estatistica['codigoEnunciado'])) {


                $enunciado = Enunciado::where('codigo', $estatistica['codigoEnunciado'])->first();
                // dd($enunciado);
                $candidato = Candidato::where('vc_codigo', $estatistica['codigoCandidato'])->first();
                $count_nota = Nota::where('it_id_candidato', $candidato->id)->where(
                    'it_id_enunciado', $enunciado->id)->count();
                if (!$count_nota) {
                    Nota::create([
                        'nota' => $estatistica['qtCerta']->sum('cotacao'),
                        'it_id_candidato' => $candidato->id,
                        'it_id_enunciado' => $enunciado->id

                    ]
                    );
                }

            }
            //
        }
    }
    public function corregir_massa($id_enunciado)
    {
        //    dd(2);
        // Pasta onde estão as imagens
        $pastaImagens = 'imgs-test';

        // Padrão de busca para arquivos JPG
        $padraoBusca = $pastaImagens . '/*.jpg';

        // Obtém a lista de arquivos JPG na pasta
        $listaImagens = glob($padraoBusca);

        // Verifica se há imagens na pasta
        if ($listaImagens) {
            // Exibe a lista de imagens


            // Transforma a lista de imagens em vetor
            $vetorImagens = $listaImagens;
            $estatistica = [];
            foreach ($vetorImagens as $key => $imagePath) {
                $cont = $this->corrigir_individual($id_enunciado, $imagePath);
                // dd($cont,0);
                $estatistica[] = ['numero' => $key + 1, 'prova' => $imagePath, 'qtCerta' => $cont];
                $codigos = extrairCodigosEnunciados($imagePath);
                dd($codigos, 0, $estatistica);
            }
        } else {
            echo "Nenhuma imagem encontrada na pasta.\n";
        }
        dd($estatistica);

        // $this->corrigir_individual($$id_enunciado, $imagePath);
    }


    function orderCoordernadas($vetor)
    {
        $vetor = $vetor->toArray();
        // Ordenar o vetor com base na função de comparação
//  usort($vetor, 'compararPorX');
        usort($vetor, function ($a, $b) {
            return floatval($a["x"]) - floatval($b["y"]);
        });
        // Exibir o vetor organizado
        echo "Vetor organizado:\n";
        //  print_r($vetor);
        return collect($vetor);
    }
    public function corrigir_individual($id_enunciado, $imagePath)
    {
        // dd($request);
        $cordenadas_verificas = collect();
        $qt_respontas = 0;

        // dd( $imagePath );
        $image = imagecreatefromjpeg($imagePath);
        $contours = $this->contours($image, $imagePath);
        $contours_pintados = $this->ponto_preenchido($image, $contours)['contours_pintados'];
        //    dd($contours_pintados);
        // echo '<pre>';
        // print_r($contours_pintados);
        $perguntas = perguntas()->where('perguntas.it_id_enunciado', $id_enunciado)->get();
        // dd($perguntas);
        $contours_pintados = collect($contours_pintados);
        //    dd($contours_pintados);
        $coordenadas_centro = CoordenadaRespotaEnunciado::where('it_id_enunciado', $id_enunciado)->orderBy('y', 'asc')->orderBy('x', 'asc')->get();
        //    dd($coordenadas_centro->toArray());
        // $coordenadas_centro = $this->orderCoordernadas($coordenadas_centro);
        // $array = $coordenadas_centro->toArray();
        // usort($array, function ($a, $b) {
        //     $produtoA = $a['x'] * $a['y'];
        //     $produtoB = $b['x'] * $b['y'];

        //     return $produtoA - $produtoB;
        // });

        // Exibir o array ordenado
        // $coordenada_centro=$array;
        $coordenadas_centro = $coordenadas_centro->toArray();

        foreach ($coordenadas_centro as $coordenada_centro) {

            foreach ($contours_pintados as $contour_pintado) {

                // $xy = ['x' => 189, 'y' => 943];
                $x = intval($coordenada_centro['x']);
                $y = intval($coordenada_centro['y']);

                $contour_pintado = collect($contour_pintado);
                $linha = $contour_pintado->where('x', $x)->where('y', $y);
                // $linha = $linha;

                // dd($contour_pintado);
                if ($linha->count()) {
                    // dd($perguntas);
                    $cordenadas_verificas->push(['numero' => $perguntas[$qt_respontas]->it_numero, 'pergurta' => $perguntas[$qt_respontas]->descricao, 'coordenada_resposta' => $linha->first(), 'cotacao' => $perguntas[$qt_respontas]->it_cotacao]);

                }


            }
            $qt_respontas++;
        }

        // header('Content-Type: image/jpeg');
        // imagejpeg($image);
        // imagedestroy($image);
        // $cordenadas_verificas = $cordenadas_veri;
        // return $cordenadas_verificas->count();
        return $cordenadas_verificas;

    }
    public function corrigir_prova(Request $request)
    {
        // dd($request);
        $cordenadas_verificas = [];
        $qt_respontas = 0;
        $prova = uploadImage($request, 'prova', 'provas');

        //    dd($request);
        $imagePath = $prova;
        // dd( $imagePath );
        $image = imagecreatefromjpeg($imagePath);
        $contours = $this->contours($image, $imagePath);
        $contours_pintados = $this->ponto_preenchido($image, $contours)['contours_pintados'];
        //    dd($contours_pintados);
        $contours_pintados = collect($contours_pintados);
        //    dd($contours_pintados[5]);
        foreach ($contours_pintados as $contour_pintado) {
            $coordenadas_centro = CoordenadaRespotaEnunciado::where('it_id_enunciado', $request->id_enunciado)->get();

            foreach ($coordenadas_centro as $coordenada_centro) {
                // $xy = ['x' => 189, 'y' => 943];
                $contour_pintado = collect($contour_pintado);
                $linha = $contour_pintado->where('x', intval($coordenada_centro->x));
                $linha = $linha->where('y', intval($coordenada_centro->y));

                // dd($contour_pintado);
                if ($linha->count()) {
                    $cordenadas_verificas[] = $linha;
                }
                // $contour_pintado=$contour_pintado->where('y',(int)$coordenada_centro->y);
                // dd

                // $contour_pintado=$contour_pintado->where('x',(int)$coordenada_centro->x);
                // $contour_pintado=$contour_pintado->where('y',(int)$coordenada_centro->y);
                // if( $contour_pintado->count()){
                //     $qt_respontas++;
                //     $cordenadas_verificas[]=$contour_pintado;
                // }else{
                //     $contour_pintado=$contour_pintado->where('x',$coordenada_centro->x);
                //     $contour_pintado=$contour_pintado->where('y',$coordenada_centro->y);
                //     if(  $contour_pintado->count()){
                //     $qt_respontas++;
                //     $cordenadas_verificas[]=$contour_pintado;


                //     }
                // }


            }

        }

        // header('Content-Type: image/jpeg');
        // imagejpeg($image);
        // imagedestroy($image);
        $cordenadas_verificas = collect($cordenadas_verificas);
        // dd($qt_respontas, $cordenadas_verificas);

    }
    function ponto_preenchido($image, $contours)
    {
        global $coordenadas_centro_pintados;
        global $cont_imagem;
        $cont = 0;
        $cont_imagem = 0;
        $contours_pintados = [];

        foreach ($contours as $contour) {

            // Calcular a área do contorno
            $area = $this->contourArea($contour);

            //  return var_dump($area,$contour);
// exit;
            // Se a área for suficientemente grande, considerar como um ponto preenchido
            // if ($area >= 1000 && $area <= 2065) {
            if ($area > 100) {
                //              echo $area;
//    exit;
                //    return 0;
                // echo '</pre>';
                // Calcular o centro do contorno
                // $contours_pintados[] = $contour;
                $center = $this->contourCenter($contour);
                // if ($cont == 2) {
                //     print_r($center);
                //     exit;
                // }
                // $qtPoints++;
                $coordenadas_centro_pintados[$cont_imagem][] = $center;
                // echo '</pre>';
                // var_dump($cont_imagem);
                // exit;
                // Desenhar um círculo no centro do contorno (ponto preenchido)
                imagefilledellipse($image, $center['x'], $center['y'], 20, 20, imagecolorallocate($image, 0, 255, 0));
                // $cont=$cont+1;
                // echo   $cont;
                $cont++;
                $contours_pintados[] = $contour;
                $cont_imagem++;

            }


        }
        // 
        //              echo '</pre>';
        //         var_dump($coordenadas_centro_pintados);
        // exit;
        $response['contours_pintados'] = $contours_pintados;
        $response['coordenadas_centro_pintados'] = $coordenadas_centro_pintados;

        return $response;
    }
    function compararVectores($vetor1, $vetor2)
    {
        $cont = 0;
        $resultado_comparacao = array();
        foreach ($vetor1 as $i => $figura1) {
            foreach ($vetor2 as $j => $figura2) {
                $igualdade = $this->compararFiguras($figura1, $figura2);
                $probabilidade = $this->calcularProbabilidade($figura1, $figura2);

                $mensagem = "O $i º elemento do vetor 1 ";
                $mensagem .= $igualdade ? "é igual" : "não é igual";
                $mensagem .= " ao $j º elemento do vetor 2 ";
                $mensagem .= "com uma probabilidade de $probabilidade.";

                echo $mensagem . "($i,$j)<br>";
                if ($probabilidade > -10) {
                    $resultado_comparacao[] = ["elemento_v1" => $i, "elemento_v2" => $j, "comparacao" => $igualdade, "probabilidade" => $probabilidade];

                }
            }
        }
        echo '<pre>';
        return print_r($resultado_comparacao);
    }

    function compararFiguras($figura1, $figura2)
    {
        if (count($figura1) !== count($figura2)) {
            return false;
        }

        foreach ($figura1 as $i => $ponto) {
            if (!isset($figura2[$i]) || !$this->pontosProximos($ponto, $figura2[$i])) {
                return false;
            }
        }

        return true;
    }
    function pontosProximos($ponto1, $ponto2)
    {
        $distancia = $this->calcularDistanciaEuclidiana($ponto1, $ponto2);
        // Defina um limite para a proximidade (ajuste conforme necessário)
        $limiteProximidade = 5;

        return $distancia <= $limiteProximidade;
    }
    function calcularDistanciaEuclidiana($ponto1, $ponto2)
    {
        $dx = $ponto1['x'] - $ponto2['x'];
        $dy = $ponto1['y'] - $ponto2['y'];

        return sqrt($dx * $dx + $dy * $dy);
    }
    function calcularProbabilidade($figura1, $figura2)
    {
        $distancia = 0;

        foreach ($figura1 as $i => $ponto) {
            if (isset($figura2[$i])) {
                $distancia += $this->calcularDistanciaEuclidiana($ponto, $figura2[$i]);
            }
        }

        // Normalizando a distância para obter um valor de probabilidade entre 0 e 1
        $maxDistancia = count($figura1) * sqrt(2);
        $probabilidade = 1 - ($distancia / $maxDistancia);

        return $probabilidade;
    }
    function contours($image, $imagePath)
    {
        // global $image;
        // Converter a imagem para tons de cinza

        $pedacos = imagefilter($image, IMG_FILTER_GRAYSCALE);
        // var_dump($pedacos);
        // exit();
        // Aplicar uma limiarização para binarizar a imagem
        $threshold = 100; // Ajuste este valor conforme necessário
        imagefilter($image, IMG_FILTER_BRIGHTNESS, ($threshold - 128) * 2);

        // Encontrar contornos
        $contours = $this->findContours($image);
        return $contours;
    }
    // echo '<pre>';
// var_dump($qtPoints,$contours);
// exit();
// Exibir a imagem com os pontos preenchidos marcados

    // echo '<pre>';
// return   var_dump(count($contours), count($contours2));


    // Função para encontrar contornos usando GD
    function findContours($image)
    {
        $contours = [];
        $width = imagesx($image);
        $height = imagesy($image);
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $color = imagecolorat($image, $x, $y);
                if ($color === 0) { // Píxel preto
                    $contour = [];
                    $this->findContour($image, $x, $y, $contour);
                    //     if(count($contour)>3){
                    //         echo '<pre>';
                    //         var_dump($contour);
                    //    echo '</pre>';
                    //    exit();
                    //     }
                    $contours[] = $contour;
                }
            }
        }

        return $contours;
    }
    // Função para encontrar um contorno recursivamente
    function findContour($image, $x, $y, &$contour)
    {
        if ($x < 0 || $y < 0 || $x >= imagesx($image) || $y >= imagesy($image)) {
            return;
        }

        $color = imagecolorat($image, $x, $y);

        if ($color === 0) { // Píxel preto
            $contour[] = ['x' => $x, 'y' => $y];
            imagesetpixel($image, $x, $y, imagecolorallocate($image, 255, 255, 255)); // Marcar o píxel como visitado

            // Explorar vizinhos
            $this->findContour($image, $x + 1, $y, $contour);
            $this->findContour($image, $x - 1, $y, $contour);
            $this->findContour($image, $x, $y + 1, $contour);
            $this->findContour($image, $x, $y - 1, $contour);
        }
    }

    // Função para calcular a área de um contorno
    function contourArea($contour)
    {
        return count($contour);
    }

    // Função para calcular o centro de um contorno
    function contourCenter($contour)
    {
        $sumX = 0;
        $sumY = 0;

        foreach ($contour as $point) {
            $sumX += $point['x'];
            $sumY += $point['y'];
        }

        $count = count($contour);

        return ['x' => ($count > 0) ? $sumX / $count : 0, 'y' => ($count > 0) ? $sumY / $count : 0];
    }


    // Exemplo de uso
    public function imprimir_enunciado($id_enunciado)
    {

        $response['enunciado'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftjoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftjoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            ->where('enunciados.id', $id_enunciado)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'candidatos.vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->orderby('candidatos.vc_primeiro_nome', 'asc')
            ->orderby('candidatos.vc_nome_meio', 'asc')
            ->orderby('candidatos.vc_ultimo_nome', 'asc')
            ->get()->first();
        // dd($response['enunciados']);


        // ->find($id_enunciado);

        // dd($response['enunciados']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
//admin.cartaos.imprimir.pesquisar
// dd("ao");
        $response["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir-enunciado.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        ini_set("pcre.backtrack_limit", "2000000");
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta.pdf", "I");
    }
    public function imprimir_enunciados_massa($id_prova)
    {
        // dd("ola");
        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->leftjoin('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->leftjoin('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')
            ->where('provas.id', $id_prova)
            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'candidatos.vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->orderby('candidatos.vc_primeiro_nome', 'asc')
            ->orderby('candidatos.vc_nome_meio', 'asc')
            ->orderby('candidatos.vc_ultimo_nome', 'asc')
            ->get();
        // dd($response['enunciados']);


        // ->find($id_enunciado);

        // dd($response['enunciados']);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        // dd("ao");
        $response["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        // dd("ola");
        $html = view('admin.enunciado.sala.enunciado.imprimir-enunciados.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        ini_set("pcre.backtrack_limit", "2000000");
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta.pdf", "I");
    }
    public function enunciado_tem_pergunta($id_enunciado, $id_pb)
    {
        return Pergunta::where('it_id_banco_pergunta', $id_enunciado)
            ->where('it_id_enunciado', $id_pb)->count();
    }
    public function index($id_prova, $id_sala)
    {
        //  dd($id_prova);
        // $id_sala=$id_sala;
        $response['it_id_sala'] = $id_sala;
        $response['it_id_prova'] = $id_prova;
        $response['disciplinas'] = Disciplina::all();
        $response['periodos'] = Periodo::all();
        $response['candidatos'] = Candidato::all();
        $response['ano'] = AnoLectivo::all();

        $response['prova'] = Prova::where('id', $id_prova)->first();
        $response['curso'] = Curso::find($response['prova']->it_id_curso);
        $response['sala'] = Sala::where('id', $id_sala)->first();
        $response['disciplinas'] = fh_cursos_disciplinas()
            ->where('cursos.id', $response['curso']->id)->select('disciplinas.*')->get();
        // dd( $response['cursos_disciplinas'] );
        $response['cursos'] = Curso::all();

        $response['enunciados'] = Enunciado::join('provas', 'enunciados.it_id_prova', '=', 'provas.id')
            ->join('disciplinas', 'disciplinas.id', 'enunciados.it_id_disciplina')

            ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
            ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')

            ->join('ano_lectivos', 'provas.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'provas.it_id_sala', '=', 'salas.id')
            ->where('provas.it_id_sala', $id_sala)
            ->where('enunciados.it_id_prova', $id_prova)
            ->where('provas.id', $id_prova)
            ->select('enunciados.*', 'salas.vc_nome as sala', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim', 'disciplinas.vc_nome as disciplina')

            ->get();


        // dd( $response['enunciados']);
        // dd(     $response['enunciados']);
        return view('admin.enunciado.sala.enunciado.index', $response);
    }



    public function imprimir_folha_resposta_post(Request $request)
    {
        // dd("ola");
        // $response['enunciado'] =  Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
        //     ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
        //     ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
        //     ->join('provas','provas.it_id_sala','salas.id')
        //     ->select('enunciados.*', 'periodos.vc_nome as periodo', 'salas.vc_nome as sala', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')->find($request->id_enunciado);
        $response['enunciado'] = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'enunciados.it_id_sala', 'salas.id')
            ->join('provas', 'provas.it_id_sala', 'salas.id')
            ->join('candidato_folha_respostas', 'candidato_folha_respostas.it_id_enunciado', 'enunciados.id')
            ->join('candidatos', 'candidatos.id', 'candidato_folha_respostas.it_id_candidato')

            ->select(
                'enunciados.*',
                'salas.vc_nome as sala',
                'periodos.vc_nome as periodo',
                'ano_lectivos.ya_inicio as ya_inicio',
                'ano_lectivos.ya_fim as ya_fim',
                'candidatos.vc_codigo',
                'candidatos.vc_codigo',
                'candidatos.vc_primeiro_nome',
                'candidatos.vc_nome_meio',
                'candidatos.vc_ultimo_nome'
            )
            ->orderby('candidatos.vc_primeiro_nome', 'asc')
            ->orderby('candidatos.vc_nome_meio', 'asc')
            ->orderby('candidatos.vc_ultimo_nome', 'asc')
            ->find($request->id_enunciado);
        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciados']);



        // ->find($id_enunciado);
        // dd(perguntas());
        // dd($response['enunciado']);
        // if (CandidatoFolhaResposta::where(
        //     'it_id_enunciado',
        //     $request->id_enunciado
        // )->whereYear('created_at',date('Y'))->count()) {
        //   return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Candidato já tem enunciado para este ano lectivo!']);
        // }
        CandidatoFolhaResposta::create([
            'it_id_enunciado' => $request->id_enunciado,
            'it_id_candidato' => $request->id_candidato
        ]);
        $response['candidato'] = Candidato::find($request->id_candidato);
        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        // dd("ola");
        $mpdf->setHeader();
        // $this->loggerData('Imprimiu Lista de pedidos de cartão');
        //admin.cartaos.imprimir.pesquisar
        $data["bootstrap"] = file_get_contents("assets/css/bootstrap.min.css");
        // $data["css"] = file_get_contents("css/listas/style.css");
        $html = view('admin.enunciado.sala.enunciado.imprimir-fr-individual.index', $response);
        // $mpdf->WriteHTML($data["bootstrap"], \Mpdf\HTMLParserMode::HEADER_CSS);
        // $mpdf->WriteHTML($data["css"], \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->writeHTML($html);
        $mpdf->Output("Folha de resposta.pdf", "I");
    }




    /**
     * Show the form for creating o new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $anos = AnoLectivo::all();
        $periodos = Periodo::all();
        return view('admin.enunciado.sala.enunciado.create.index', compact('periodos', 'anos'));
    }

    /**
     * Store o newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $codigo = Str::random(6);
        while (Enunciado::where('codigo', $codigo)->exists()) {
            $codigo = Str::random(6);
        }
        ;
        $request->validate([
            'id_ano' => 'required|max:255',
            'id_periodo' => 'required|max:255'
        ], [
            'id_ano.required' => 'O ano lectivo do enunciado é um campo obrigatório.',
            'id_periodo.required' => 'O nome do enunciado é um campo obrigatório.',
        ]);

        try {

            $enunciado = Enunciado::create([
                'codigo' => $codigo,
                'id_ano_lectivo' => $request->id_ano,
                'id_periodo' => $request->id_periodo,
                'it_id_sala' => $request->it_id_sala,
            ]);
            $this->loggerData(" Cadastrou o enunciado " . $codigo);
            return redirect()->back()->with('enunciado.create.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.create.error', 1);
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
        $enunciado = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
            ->join('provas', 'enunciados.it_id_prova', '=', 'provas.id')
            ->select('enunciados.*', 'salas.vc_nome as sala', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->get();
        return view('admin.enunciado.sala.enunciado.edit.index', ['enunciado' => $enunciado]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $enunciado = Enunciado::join('periodos', 'enunciados.id_periodo', '=', 'periodos.id')
            ->join('ano_lectivos', 'enunciados.id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'enunciados.it_id_sala', '=', 'salas.id')
            ->join('provas', 'enunciados.it_id_prova', '=', 'provas.id')
            // ->join('provas','provas.it_id_sala','sala.id')
            ->select('enunciados.*', 'salas.vc_nome as sala', 'periodos.vc_nome as periodo', 'ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim')
            ->findOrFail($id);
        $anos = AnoLectivo::all();
        $periodos = Periodo::all();
        return view('admin.enunciado.sala.enunciado.edit.index', compact('periodos', 'anos', 'enunciado'));
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
            'id_ano' => 'required|max:255',
            'id_periodo' => 'required|max:255'
        ], [
            'id_ano.required' => 'O ano lectivo do enunciado é um campo obrigatório.',
            'id_periodo.required' => 'O nome do enunciado é um campo obrigatório.',
        ]);

        try {
            //code...

            $enunciado = Enunciado::findOrFail($id)->update([
                'id_ano_lectivo' => $request->id_ano_lectivo,
                'id_periodo' => $request->id_periodo,
                'it_id_sala' => $request->it_id_sala,
            ]);

            $this->loggerData(" Editou o enunciado.  de id, enunciado ($enunciado->id, $enunciado->id_ano_lectivo,$enunciado->id_periodo) para ($request->id_ano_lectivo,$request->id_periodo)");
            return redirect()->back()->with('enunciado.update.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.update.error', 1);
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
            $enunciado = Enunciado::findOrFail($id);
            Enunciado::findOrFail($id)->delete();
            $this->loggerData(" Eliminou o enunciado  de id, fisciplina ($enunciado->codigo) ");
            return redirect()->back()->with('enunciado.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $enunciado = Enunciado::findOrFail($id);
            Enunciado::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou o enunciado  de id, enunciado ($enunciado->codigo) ");
            return redirect()->back()->with('enunciado.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('enunciado.purge.error', 1);
        }
    }
}