<?php

use App\Models\AlineaGerada;
use App\Models\BancoAlinea;
use App\Models\Correcao;
use App\Models\CursoDisciplina;
use App\Models\Disciplina;
use App\Models\Enunciado;
use App\Models\Nota;
use App\Models\Pergunta;
use Carbon\Carbon;
use thiagoalessio\TesseractOCR\TesseractOCR;


function disciplinas(){
  return  Disciplina::orderBy('id','desc');
}
function extrairPartesEspecificas($array)
{
    $partesEspecificas = [];

    foreach ($array as $subvetor) {
        // Verificar se o subvetor começa com "Enunciado:" ou "Candidato:"
        if (strpos($subvetor[0], 'Enunciado:') === 0) {
            $partesEspecificas['Enunciado'] = explode(":", $subvetor[0])[1];
        } elseif (strpos($subvetor[0], 'Candidato:') === 0) {
            $partesEspecificas['Candidato'] = $subvetor[1];
        }
    }

    return $partesEspecificas;
}
function extrairCodigos($texto)
{
    // Dividir o texto por espaços em branco
    // echo$text    o;
    $palavras = explode("Cód. ", $texto);

    $novoArray = [];

    foreach ($palavras as $texto) {
        // Dividir o texto por espaços em branco
        $palavras = preg_split('/\s+/', $texto);

        // Adicionar as palavras ao novo array
        $novoArray[] = $palavras;
    }
    $novoArray = extrairPartesEspecificas($novoArray);
    // dd($novoArray);

    // Retornar os códigos encontrados
    return [
        'codigoCandidato' => $novoArray['Candidato'],
        'codigoEnunciado' => $novoArray['Enunciado'],
    ];
}

function notas()
{
    $notas = Nota::join('enunciados', 'enunciados.id', 'notas.it_id_enunciado')
        ->join('disciplinas', 'disciplinas.id', 'enunciados.it_id_disciplina')
        ->join('candidatos', 'candidatos.id', 'notas.it_id_candidato');
    return $notas;
}
function extrairCodigosEnunciados($imagemPath)
{
    // Extrair texto da imagem usando TesseractOCR
// use TesseractOCR\TesseractOCR;
// $TesseractOCR=new  TesseractOCR($imagemPath);
    $texto = (new TesseractOCR($imagemPath))
        ->lang('por')  // Defina o idioma para português
        ->run();
    // Dividir o texto em linhas
    // Dividir o texto por espaços em branco
    $codigos = extrairCodigos($texto);
    return $codigos;

}
function perguntas()
{
    return Pergunta::join('banco_perguntas', 'banco_perguntas.id', 'perguntas.it_id_banco_pergunta')
        ->select('perguntas.*', 'banco_perguntas.vc_descricao_bp', 'banco_perguntas.vc_imagem_bp')
        ->orderBy('perguntas.it_numero', 'asc');
}
function hoje_extenso()
{
    $data = Carbon::now()->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY');
    return $data;
}
// function notas($cod_candidato, $id_disciplina,$id_correcao)
// {
//     $c =  Correcao::join('candidatos', 'candidatos.id', 'correcaos.it_id_candidato')
//         ->join('enunciados', 'enunciados.id', 'correcaos.it_id_enunciado')
//         ->join('disciplinas', 'disciplinas.id', 'enunciados.it_id_disciplina')
//         ->join('perguntas', 'perguntas.it_id_enunciado', 'enunciados.id')
//         ->join('pergunta_respostas', 'pergunta_respostas.it_id_correcao', 'correcaos.id')
//         // ->where('enunciados.codigo', $codigo)
//         ->where('correcaos.id', $id_correcao)

//         ->where('pergunta_respostas.chave', 1)
//         ->select('pergunta_respostas.*')
//         ->distinct()
//         // ->get();
//         // dd($c);
//           ->sum('perguntas.it_cotacao');
//   return  $c;
// }
// function notas($cod_candidato, $id_disciplina)
// {
//     $c = Correcao::join('candidatos', 'candidatos.id', 'correcaos.it_id_candidato')
//         ->join('enunciados', 'enunciados.id', 'correcaos.it_id_enunciado')
//         ->join('disciplinas', 'disciplinas.id', 'enunciados.it_id_disciplina')
//         ->join('pergunta_respostas', 'pergunta_respostas.it_id_correcao', 'correcaos.id')
//         ->join('perguntas', 'perguntas.it_id_enunciado', 'enunciados.id')
//         ->where('candidatos.vc_codigo', $cod_candidato)
//         // ->where('correcaos.id', $id_correcao)
//         ->where('disciplinas.id', $id_disciplina)
//         ->where('pergunta_respostas.chave', 1)
//         ->distinct()
//         ->select('pergunta_respostas.*', 'perguntas.it_cotacao')
//         ->get();
//     // ->sum('perguntas.it_cotacao')    ;
//     //   dd($c->sum('it_cotacao'));
//     return $c;
// }
function provas()
{
    $tds = DB::table('provas')
        ->join('salas', 'salas.id', 'provas.it_id_sala')
        ->join('cursos', 'provas.it_id_curso', '=', 'cursos.id')
        ->Join('horarios', 'provas.it_id_horario', '=', 'horarios.id')
        ->Join('periodos', 'periodos.id', '=', 'horarios.it_id_periodo')
        // ->where('salas.id', $id)
        ->select('salas.*', 'salas.vc_nome as sala', 'cursos.vc_nome as curso', 'provas.*', 'horarios.inicio_prova as inicio_prova', 'horarios.termino_prova as termino_prova', 'periodos.vc_nome as periodo')
        ->whereNull('provas.deleted_at');
    return $tds;
}
function fh_cursos_disciplinas()
{
    return CursoDisciplina::join('cursos', 'cursos.id', 'curso_disciplinas.it_id_curso')
        ->join('disciplinas', 'disciplinas.id', 'curso_disciplinas.it_id_disciplina')
        ->select('curso_disciplinas.*', 'cursos.vc_nome as curso', 'disciplinas.vc_nome as disciplina');
}
function calcularIdade($data)
{
    $idade = 0;
    $data_nascimento = date('Y-m-d', strtotime($data));
    $data = explode("-", $data_nascimento);
    $anoNasc = $data[0];
    $mesNasc = $data[1];
    $diaNasc = $data[2];

    $anoAtual = date("Y");
    $mesAtual = date("m");
    $diaAtual = date("d");

    $idade = $anoAtual - $anoNasc;
    if ($mesAtual < $mesNasc) {
        $idade -= 1;
    } elseif (($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc)) {
        $idade -= 1;
    }

    return $idade;
}
function turmas_sge()
{
    $response = Http::withHeaders([
        'Authorization' => 'Basic eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9',
        'Content-Type' => 'application/json'
    ])->get("http://192.168.10.38:8000/api/v1/turmas/turmas_ultimo_ano");
    $response = $response->json();
    return $response;
}
function uploadImage($request, $fieldName, $destinationPath)
{
    // Verificar se uma imagem foi enviada
    if ($request->hasFile($fieldName)) {
        // Obter o arquivo de imagem enviado
        $image = $request->file($fieldName);

        // Verificar se o diretório de destino existe, caso contrário, criar
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Gerar um nome único para a imagem
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Mover o arquivo de imagem para o diretório de destino
        $image->move($destinationPath, $imageName);

        // Retornar o caminho completo da imagem para uso posterior
        $imagePath = $destinationPath . '/' . $imageName;

        return $imagePath;
    }

    return null;
}

function uploadImage1($request, $fieldName, $destinationPath)
{
    // Verificar se uma imagem foi enviada
    // if ($request->hasFile($fieldName)) {
    // Obter o arquivo de imagem enviado
    $image = $request->file($fieldName);
    dd($image);
    // Verificar se o diretório de destino existe, caso contrário, criar
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    // Gerar um nome único para a imagem
    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

    // Mover o arquivo de imagem para o diretório de destino
    $image->move($destinationPath, $imageName);

    // Retornar o caminho completo da imagem para uso posterior
    $imagePath = $destinationPath . '/' . $imageName;

    return $imagePath;
    // }

    return null;
}

function dt_eua_to_pt($dt)
{

    $dataOriginal = $dt;
    $dataConvertida = date('d/m/Y', strtotime($dataOriginal));

    return $dataConvertida;
}
function alunos_sge($id_turma)
{
    $response = Http::withHeaders([
        'Authorization' => 'Basic eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9',
        'Content-Type' => 'application/json'
    ])->get("http://192.168.10.38:8000/api/v1/turmas/alunos_sge/$id_turma");
    $response = $response->json();
    return $response;
}
function disciplina_por_enunciado($id_enunciado)
{
    return Enunciado::join('disciplinas', 'disciplinas.id', 'enunciados.it_id_disciplina')
        ->where('enunciados.id', $id_enunciado)
        ->select('disciplinas.*')
        ->first();
}
function abreviarDisciplina($nomeDisciplina)
{
    $cont = 1;
    $palavras = explode(" ", $nomeDisciplina); // divide o nome da disciplina em palavras
    $abreviacao = "";
    foreach ($palavras as $palavra) {
        $palavra = removerAcentos($palavra);
        if (count($palavras) == 1) {
            $abreviacao .= substr($palavra, 0, 3);
        } else
            if ($cont == 1) {
                $abreviacao .= substr($palavra, 0, $cont); // adiciona as três primeiras letras de cada palavra à abreviação
                $cont = 0;
            } else {
                $abreviacao .= '.' . substr($palavra, 0, 3);
            }
    }
    return strtoupper($abreviacao); // converte a abreviação para letras maiúsculas
}
function removerAcentos($texto)
{
    $acentos = array(
        'À',
        'Á',
        'Â',
        'Ã',
        'Ä',
        'Å',
        'Æ',
        'Ç',
        'È',
        'É',
        'Ê',
        'Ë',
        'Ì',
        'Í',
        'Î',
        'Ï',
        'Ð',
        'Ñ',
        'Ò',
        'Ó',
        'Ô',
        'Õ',
        'Ö',
        'Ø',
        'Ù',
        'Ú',
        'Û',
        'Ü',
        'Ý',
        'ß',
        'à',
        'á',
        'â',
        'ã',
        'ä',
        'å',
        'æ',
        'ç',
        'è',
        'é',
        'ê',
        'ë',
        'ì',
        'í',
        'î',
        'ï',
        'ñ',
        'ò',
        'ó',
        'ô',
        'õ',
        'ö',
        'ø',
        'ù',
        'ú',
        'û',
        'ü',
        'ý',
        'ÿ'
    );

    $semAcentos = array(
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'AE',
        'C',
        'E',
        'E',
        'E',
        'E',
        'I',
        'I',
        'I',
        'I',
        'D',
        'N',
        'O',
        'O',
        'O',
        'O',
        'O',
        'O',
        'U',
        'U',
        'U',
        'U',
        'Y',
        'ss',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'ae',
        'c',
        'e',
        'e',
        'e',
        'e',
        'i',
        'i',
        'i',
        'i',
        'n',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y'
    );

    $textoSemAcentos = str_replace($acentos, $semAcentos, $texto);
    return $textoSemAcentos;
}

function alineas_geradas()
{
    $als = AlineaGerada::join('perguntas', 'perguntas.id', 'alinea_geradas.it_id_pergunta')
        ->join('banco_perguntas', 'banco_perguntas.id', 'perguntas.it_id_banco_pergunta')
        // ->join('banco_alineas','banco_alineas.it_id_banco_pergunta','banco_perguntas.id')
        ->select('alinea_geradas.*', 'alinea_geradas.alinea')
        // ->where('perguntas.id',9)
        ->orderBy('alinea_geradas.alinea', 'asc');
    return $als;
}
function alinea_certa($it_id_banco_pergunta, $it_id_banco_alinea)
{
    // dd($it_id_banco_pergunta);

    $ba = BancoAlinea::where('it_id_banco_pergunta', $it_id_banco_pergunta)->where('id', $it_id_banco_alinea)->get()->first();
    //    dd($ba);
    if ($ba) {
        return $ba->chave;
    } else {
        return 0;

    }
    // return $als;
}
function banco_alinea($id)
{
    return BancoAlinea::find($id);
    // return   $als;
}