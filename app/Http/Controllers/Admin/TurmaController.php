<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Candidato;
use App\Models\Classe;
use App\Models\Curso;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    //
    public function sge()
    {
        $response['turmas'] = turmas_sge();
        // dd(   $response['turmas']);
        return view('admin.turma.sge.index', $response);
    }
    public function alunos_sge_download($id_turma)
    {
        $alunos = alunos_sge($id_turma);
        //   dd($alunos);
        $turma = collect(turmas_sge())->where('id', $id_turma)->first();
        //   "vc_imagem" => "images/patrimonios/vc_foto_3326.png"
        //   "vc_primeiroNome" => "Alegria"
        //   "vc_ultimoaNome" => "Aolo"
        //   "vc_nomedoMeio" => "Joaquina Malumba"
        //   "id" => 13941
        //   "dt_dataNascimento" => "2005-02-25"
        //   "it_telefone" => 900000000
        //   "vc_genero" => "Feminino"
        //   "vc_email" => null
        //   "vc_namePai" => "JOAQUIM MOIO A OLO"
        //   "vc_nameMae" => "GLÓRIA JOANA"

        $arraySplit = explode('-', $turma['vc_anoLectivo']);
        $ano_lectivo = AnoLectivo::where('ya_inicio', $arraySplit[0])->
            where('ya_fim', $arraySplit[1])->first();
      
        $classe = Classe::where("vc_nome", $turma['vc_classeTurma'])->first();
        // dd(   $classe );
        if (!$classe) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro, não existe a classe ' . $turma['vc_classeTurma'] . ' no acesso']);
        }

        $arraySplit = explode('-', $turma['vc_anoLectivo']);
        $ano_lectivo = AnoLectivo::where('ya_inicio', $arraySplit[0])->
            where('ya_fim', $arraySplit[1])->first();
        if (!$ano_lectivo) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro, não existe o ano lectivo ' . $turma['vc_anoLectivo'] . ' no acesso']);
        }

        $curso = Curso::where('vc_nome', $turma['vc_cursoTurma'])->first();
        if (!$curso) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro, não existe curso ' . $turma['vc_cursoTurma'] . ' no acesso']);
        }
        // dd($arraySplit);
        foreach ($alunos as $aluno) {
            // dd($aluno);
            $c = Candidato::where('vc_bi', $aluno['vc_bi'])->count();
            if (!$c) {
                $candidato = Candidato::create([
                    'vc_primeiro_nome' =>$aluno['vc_primeiroNome'],
                    'vc_nome_meio' => $aluno['vc_nomedoMeio']?$aluno['vc_nomedoMeio']:$aluno['vc_ultimoaNome'],
                    'vc_ultimo_nome' => $aluno['vc_ultimoaNome'],
                    'it_id_classe' => $classe->id,
                    'dt_data_nascimento' => $aluno['dt_dataNascimento'],
                    'vc_naturalidade' => $aluno['vc_naturalidade'],
                    'vc_provincia' => $aluno['vc_provincia']? $aluno['vc_provincia']:'Pendente',
                    'vc_nome_pai' => $aluno['vc_namePai']?$aluno['vc_namePai']:'Pendente',
                    'vc_nome_mae' => $aluno['vc_nameMae']?$aluno['vc_nameMae']:'Pendente',
                    'vc_deficiencia' => $aluno['vc_dificiencia']?$aluno['vc_dificiencia']:'Pendente',
                    'vc_estado_civil' => $aluno['vc_estadoCivil'],
                    'vc_genero' => $aluno['vc_genero'],
                    'it_telefone' => $aluno['it_telefone'],
                    'vc_email' => $aluno['vc_email']?$aluno['vc_email']:$aluno['vc_primeiroNome'].$aluno['vc_primeiroNome'].'@fake.com',
                    'vc_residencia' => $aluno['vc_residencia'],
                    'vc_bi' => $aluno['vc_bi'],
                    'dt_data_emissao' => $aluno['dt_emissao'],
                    'dt_ano_candidatura' => $aluno['dt_anoCandidatura']?$aluno['dt_anoCandidatura']:date('Y-m-d'),
                    'it_idade' => calcularIdade($aluno['dt_dataNascimento']),
                    'vc_local_emissao' => $aluno['vc_localEmissao']?$aluno['vc_localEmissao']:'Pendente',
                    'vc_escola_anterior' => $aluno['vc_EscolaAnterior']?$aluno['vc_EscolaAnterior']:'Pendente',
                    'ya_ano_conclusao' => $aluno['ya_anoConclusao']?$aluno['ya_anoConclusao']:date('Y')-2000,
                   
                    'it_media' =>$aluno['it_media']?$aluno['it_media']:0,
                    'it_id_ano_lectivo' => $ano_lectivo->id,
                
                    'vc_foto' => $aluno['vc_imagem'],
                    'it_id_curso' => $curso->id

                ]);
                Candidato::find($candidato->id)->update(['vc_codigo' => "$candidato->id" . date('Y')]);
            }
        }
        return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Download realizado com sucesso']);

    }
}