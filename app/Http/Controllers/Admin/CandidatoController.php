<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Logger;
use Illuminate\Support\Facades\Hash;
use App\Models\Sala;
use Carbon\Carbon;
use App\Models\Periodo;
use App\Models\AnoLectivo;
use App\Models\Classe;
use App\Models\Curso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CandidatoController extends Controller
{
    //
    //


    public function __construct(Hash $hash)
    {
        $this->hash = $hash;
        $this->Logger = new Logger();
    }
    public function loggerData($mensagem)
    {
        $this->Logger->Log('info', $mensagem);
    }
    //
    public function index()
    {
        $candidatos = Candidato::join('classes', 'candidatos.it_id_classe', '=', 'classes.id')
            ->join('ano_lectivos', 'candidatos.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('cursos', 'cursos.id', '=', 'candidatos.it_id_curso')
            ->select('candidatos.*', 'classes.vc_nome as nome_classe', 'ano_lectivos.ya_inicio as ya_inicio','cursos.vc_nome as curso' )
            ->get();
        return view('admin.candidato.index', ['candidatos' => $candidatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $response['periodos'] = Periodo::all();
        $response['anos'] = AnoLectivo::all();
        $response['classes'] = Classe::all();
        $response['salas'] = Sala::all();
        $response['cursos'] = Curso::all();

        return view('admin.candidato.create.index', $response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'vc_primeiro_nome' => 'required|max:255',
            'vc_nome_meio' => 'required|max:255',
            'vc_ultimo_nome' => 'required|max:255',
            'it_id_classe' => 'required|max:255',
            'dt_data_nascimento' => 'required|date',
            'vc_naturalidade' => 'required|max:255',
            'vc_provincia' => 'required|max:255',
            'vc_nome_pai' => 'required|max:255',
            'vc_nome_mae' => 'required|max:255',
            'vc_deficiencia' => 'nullable|max:255',
            'vc_estado_civil' => 'required|max:255',
            'vc_genero' => 'required|max:255',
            'it_telefone' => 'required|max:255',
            'vc_email' => 'required|max:255',
            'vc_residencia' => 'required|max:255',
            'vc_bi' => 'required|max:255',
            'dt_data_emissao' => 'required|date',
            'vc_local_emissao' => 'required|max:255',
            'vc_escola_anterior' => 'required|max:255',
            'ya_ano_conclusao' => 'required|integer',
            //'vc_nome_curso' => 'required|max:255',
            'it_media' => 'required|numeric',
            'it_id_ano_lectivo' => 'required|integer',
            // 'it_id_sala' => 'required|integer',
            // 'it_id_periodo' => 'required|integer',
            'vc_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'vc_primeiro_nome.required' => 'O primeiro nome do usuário é um campo obrigatório.',
            'vc_nome_meio.required' => 'O nome do meio do usuário é um campo obrigatório.',
            'vc_ultimo_nome.required' => 'O último nome do usuário é um campo obrigatório.',
            'it_id_classe.required' => 'A classe do usuário é um campo obrigatório.',
            'dt_data_nascimento.required' => 'A data de nascimento do usuário é um campo obrigatório.',
            'vc_naturalidade.required' => 'A naturalidade do usuário é um campo obrigatório.',
            'vc_provincia.required' => 'A província do usuário é um campo obrigatório.',
            'vc_nome_pai.required' => 'O nome do pai do usuário é um campo obrigatório.',
            'vc_nome_mae.required' => 'O nome da mãe do usuário é um campo obrigatório.',
            'vc_estado_civil.required' => 'O estado civil do usuário é um campo obrigatório.',
            'vc_genero.required' => 'O gênero do usuário é um campo obrigatório.',
            'it_telefone.required' => 'O telefone do usuário é um campo obrigatório.',
            'vc_email.required' => 'O email do usuário é um campo obrigatório.',
            'vc_residencia.required' => 'A residência do usuário é um campo obrigatório.',
            'vc_bi.required' => 'O número do BI do usuário é um campo obrigatório.',
            'dt_data_emissao.required' => 'A data de emissão do BI do usuário é um campo obrigatório.',
            'vc_local_emissao.required' => 'O local de emissão do BI do usuário é um campo obrigatório.',
            'vc_escola_anterior.required' => 'A escola anterior do usuário é um campo obrigatório.',
            'vc_escola_anterior.required' => 'O nome da escola anterior do usuário é um campo obrigatório.',
            'ya_ano_conclusao.required' => 'O ano de conclusão da escola anterior do usuário é um campo obrigatório.',
            //'vc_nome_curso.required' => 'O nome do curso do usuário é um campo obrigatório.',
            'it_media.required' => 'A média do usuário é um campo obrigatório.',
            'it_id_ano_lectivo.required' => 'O ano letivo do usuário é um campo obrigatório.',
            //'it_id_sala.required' => 'A sala do usuário é um campo obrigatório.',
            'it_id_periodo.required' => 'O período do usuário é um campo obrigatório.',
            'vc_foto.required' => 'A foto do usuário é um campo obrigatório.',
            'vc_foto.image' => 'O arquivo enviado deve ser uma imagem.',
            'vc_foto.mimes' => 'A imagem deve ser um dos seguintes formatos: jpeg, png, jpg ou gif.',
            'vc_foto.max' => 'O tamanho máximo permitido para a imagem é de 2048 kilobytes.'
        ]);
        
        $data_nascimento = Carbon::createFromFormat('Y-m-d', $request->input('dt_data_nascimento'));
        $idade = $data_nascimento->diffInYears(Carbon::now()); 

        try {
            // dd("ola");
             if (!$request->hasFile('vc_foto') || !$request->file('vc_foto')->isValid()) {
                //  dd("ola");
                 $path='images/candidato/avatar.png';
                //  return redirect()->back()->with('candidato.img.error', 1);
             }else{
              
                $file = $request->file('vc_foto');
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->move(public_path('candidatos/'), $fileName);
             }
            //  dd("oll");
             //dd($request);    
           
            $candidato = Candidato::create([
                'vc_primeiro_nome' => $request->vc_primeiro_nome,
                'vc_nome_meio' => $request->vc_nome_meio,
                'vc_ultimo_nome' => $request->vc_ultimo_nome,
                'it_id_classe' => $request->it_id_classe,
                'dt_data_nascimento' => $request->dt_data_nascimento,
                'vc_naturalidade' => $request->vc_naturalidade,
                'vc_provincia' => $request->vc_provincia,
                'vc_nome_pai' => $request->vc_nome_pai,
                'vc_nome_mae' => $request->vc_nome_mae,
                'vc_deficiencia' => $request->vc_deficiencia,
                'vc_estado_civil' => $request->vc_estado_civil,
                'vc_genero' => $request->vc_genero,
                'it_telefone' => $request->it_telefone,
                'vc_email' => $request->vc_email,
                'vc_residencia' => $request->vc_residencia,
                'vc_bi' => $request->vc_bi,
                'dt_data_emissao' => $request->dt_data_emissao,
                'dt_ano_candidatura' => $request->dt_data_candidatura,
                'it_idade' => $idade,
                'vc_local_emissao' => $request->vc_local_emissao,
                'vc_escola_anterior' => $request->vc_escola_anterior,
                'ya_ano_conclusao' => $request->ya_ano_conclusao,
                //'vc_nome_curso' => $request->vc_nome_curso,
                'it_media' => $request->it_media,
                'it_id_ano_lectivo' => $request->it_id_ano_lectivo,
                // 'it_id_sala' => $request->it_id_sala,
                // 'it_id_periodo' => $request->it_id_periodo,
                'vc_foto' => $path,
                'it_id_curso' => $request->it_id_curso,

            ]);
            Candidato::find($candidato->id)->update(['vc_codigo' => "$candidato->id" . date('Y')]);

            $this->loggerData(" Cadastrou a usuario " . $request->vc_primeiro_nome);
            return redirect()->back()->with('candidato.create.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with('candidato.create.error', 1);
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

        $candidatos = Candidato::join('classes', 'candidatos.it_id_classe', '=', 'classes.id')
            ->join('ano_lectivos', 'candidatos.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('salas', 'candidatos.it_id_sala', '=', 'salas.id')
            ->join('periodos', 'candidatos.it_id_periodo', '=', 'periodos.id')
            ->select('candidatos.*', 'classes.vc_nome as nome_classe', 'ano_lectivos.ya_inicio as ya_inicio', 'salas.vc_nome as nome_sala', 'periodos.vc_nome as nome_periodo')
            ->get();
        return view('admin.candidato.create.index', ['candidatos' => $candidatos]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd("ola");
        $candidato = Candidato::join('classes', 'candidatos.it_id_classe', '=', 'classes.id')
            ->join('ano_lectivos', 'candidatos.it_id_ano_lectivo', '=', 'ano_lectivos.id')
            ->join('cursos', 'cursos.id', '=', 'candidatos.it_id_curso')
           
            ->select('candidatos.*','classes.vc_nome as nome_classe','cursos.vc_nome as curso','ano_lectivos.ya_inicio as ya_inicio', 'ano_lectivos.ya_fim as ya_fim', 'ano_lectivos.id as idAno')
            ->findOrFail($id);
            // dd(       $candidato );
        $candidatoImage = $candidato->vc_foto;
        $response['periodos'] = Periodo::all();
        $response['anos'] = AnoLectivo::all();
        $response['classes'] = Classe::all();
        $response['salas'] = Sala::all();
        $response['cursos'] = Curso::all();
        $response['candidatoImage'] = $candidatoImage;
        $response['candidato'] = $candidato;
        //dd($candidato->idSala);
        return view('admin.candidato.edit.index',$response);
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
    ;
 
         try {
     
            //  if ($request->hasFile('vc_foto') && $request->file('vc_foto')->isValid()) {
            //      $file = $request->file('vc_foto');
            //      $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            //      $path = $file->move(public_path('candidatos/'), $fileName);
            //      $candidato->vc_foto = 'candidatos/' . $fileName;
            //      //dd($candidato->vc_foto);
            //  } else {
            //      echo 'O arquivo não foi carregado corretamente.';
            //  }
//  dd($request->all());
             $candidato = Candidato::find($id)->update($request->all());;
             $candidato = Candidato::find($id);
             $this->loggerData("Atualizou o candidato " . $candidato->vc_primeiro_nome . " " . $candidato->vc_ultimo_nome);
             return redirect()->back()->with('candidato.update.success', 1);
         } catch (\Throwable $th) {
             throw $th;
             dd($th);
             return redirect()->back()->with('candidato.update.error', 1);
         }
     }
    // public function update(Request $request, $id)
    // {
    //     //dd($request->it_id_classe);      
    //     $request->validate([
    //         'vc_primeiro_nome' => 'required|max:255',
    //         'vc_nome_meio' => 'required|max:255',
    //         'vc_ultimo_nome' => 'required|max:255',
    //         'it_id_classe' => 'required|max:255',
    //         'dt_data_nascimento' => 'required|date',
    //         'vc_naturalidade' => 'required|max:255',
    //         'vc_provincia' => 'required|max:255',
    //         'vc_nome_pai' => 'required|max:255',
    //         'vc_nome_mae' => 'required|max:255',
    //         'vc_deficiencia' => 'nullable|max:255',
    //         'vc_estado_civil' => 'required|max:255',
    //         'vc_genero' => 'required|max:255',
    //         'it_telefone' => 'required|max:255',
    //         'vc_email' => 'required|max:255',
    //         'vc_residencia' => 'required|max:255',
    //         'vc_bi' => 'required|max:255',
    //         'dt_data_emissao' => 'required|date',
    //         'vc_local_emissao' => 'required|max:255',
    //         'vc_escola_anterior' => 'required|max:255',
    //         'ya_ano_conclusao' => 'required|integer',
    //         'vc_nome_curso' => 'required|max:255',
    //         'it_media' => 'required|numeric',
    //         'it_id_ano_lectivo' => 'required|integer',
    //         // 'it_id_sala' => 'required|integer',
    //         // 'it_id_periodo' => 'required|integer',
    //         'vc_foto' => empty($request->vc_foto) ? 'nullable' : 'image|mimes:jpeg,png,jpg,gif|max:2048'

    //     ], [
    //         'vc_primeiro_nome.required' => 'O primeiro nome do usuário é um campo obrigatório.',
    //         'vc_nome_meio.required' => 'O nome do meio do usuário é um campo obrigatório.',
    //         'vc_ultimo_nome.required' => 'O último nome do usuário é um campo obrigatório.',
    //         'it_id_classe.required' => 'A classe do usuário é um campo obrigatório.',
    //         'dt_data_nascimento.required' => 'A data de nascimento do usuário é um campo obrigatório.',
    //         'vc_naturalidade.required' => 'A naturalidade do usuário é um campo obrigatório.',
    //         'vc_provincia.required' => 'A província do usuário é um campo obrigatório.',
    //         'vc_nome_pai.required' => 'O nome do pai do usuário é um campo obrigatório.',
    //         'vc_nome_mae.required' => 'O nome da mãe do usuário é um campo obrigatório.',
    //         'vc_estado_civil.required' => 'O estado civil do usuário é um campo obrigatório.',
    //         'vc_genero.required' => 'O gênero do usuário é um campo obrigatório.',
    //         'it_telefone.required' => 'O telefone do usuário é um campo obrigatório.',
    //         'vc_email.required' => 'O email do usuário é um campo obrigatório.',
    //         'vc_residencia.required' => 'A residência do usuário é um campo obrigatório.',
    //         'vc_bi.required' => 'O número do BI do usuário é um campo obrigatório.',
    //         'dt_data_emissao.required' => 'A data de emissão do BI do usuário é um campo obrigatório.',
    //         'vc_local_emissao.required' => 'O local de emissão do BI do usuário é um campo obrigatório.',
    //         'vc_escola_anterior.required' => 'A escola anterior do usuário é um campo obrigatório.',
    //         'vc_escola_anterior.required' => 'O nome da escola anterior do usuário é um campo obrigatório.',
    //         'ya_ano_conclusao.required' => 'O ano de conclusão da escola anterior do usuário é um campo obrigatório.',
    //         'vc_nome_curso.required' => 'O nome do curso do usuário é um campo obrigatório.',
    //         'it_media.required' => 'A média do usuário é um campo obrigatório.',
    //         // 'it_id_ano_lectivo.required' => 'O ano letivo do usuário é um campo obrigatório.',
    //         // 'it_id_sala.required' => 'A sala do usuário é um campo obrigatório.',
    //         'it_id_periodo.required' => 'O período do usuário é um campo obrigatório.',
    //         empty($request->vc_foto) ? '' : 'vc_foto.required' => 'A foto do usuário é um campo obrigatório.',
    //         empty($request->vc_foto) ? '' : 'vc_foto.image' => 'O arquivo enviado deve ser uma imagem.',
    //         empty($request->vc_foto) ? '' : 'vc_foto.mimes' => 'A imagem deve ser um dos seguintes formatos: jpeg, png, jpg ou gif.',
    //         empty($request->vc_foto) ? '' : 'vc_foto.max' => 'O tamanho máximo permitido para a imagem é de 2048 kilobytes.',

    //     ]);

    //     try {
    //         $candidato = Candidato::findOrFail($id);
    //         if ($request->hasFile('vc_foto') && $request->file('vc_foto')->isValid()) {
    //             $file = $request->file('vc_foto');
    //             $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
    //             $path = $file->move(public_path('candidatos/'), $fileName);
    //             $candidato->vc_foto = 'candidatos/' . $fileName;
    //             //dd($candidato->vc_foto);
    //         } else {
    //             echo 'O arquivo não foi carregado corretamente.';
    //         }

    //         $candidato->vc_primeiro_nome = $request->vc_primeiro_nome;
    //         $candidato->vc_nome_meio = $request->vc_nome_meio;
    //         $candidato->vc_ultimo_nome = $request->vc_ultimo_nome;
    //         $candidato->it_id_classe = $request->it_id_classe;
    //         $candidato->dt_data_nascimento = $request->dt_data_nascimento;
    //         $candidato->vc_naturalidade = $request->vc_naturalidade;
    //         $candidato->vc_provincia = $request->vc_provincia;
    //         $candidato->vc_nome_pai = $request->vc_nome_pai;
    //         $candidato->vc_nome_mae = $request->vc_nome_mae;
    //         $candidato->vc_deficiencia = $request->vc_deficiencia;
    //         $candidato->vc_estado_civil = $request->vc_estado_civil;
    //         $candidato->vc_genero = $request->vc_genero;
    //         $candidato->it_telefone = $request->it_telefone;
    //         $candidato->vc_email = $request->vc_email;
    //         $candidato->vc_residencia = $request->vc_residencia;
    //         $candidato->vc_bi = $request->vc_bi;
    //         $candidato->dt_data_emissao = $request->dt_data_emissao;
    //         $candidato->vc_local_emissao = $request->vc_local_emissao;
    //         $candidato->vc_escola_anterior = $request->vc_escola_anterior;
    //         $candidato->ya_ano_conclusao = $request->ya_ano_conclusao;
    //         $candidato->vc_nome_curso = $request->vc_nome_curso;
    //         $candidato->it_media = $request->it_media;
    //         $candidato->it_id_ano_lectivo = $request->it_id_ano_lectivo;
    //         $candidato->it_id_curso=$request->it_id_curso;
    //         // $candidato->it_id_sala = $request->it_id_sala;
    //         // $candidato->it_id_periodo = $request->it_id_periodo;
    //         $candidato->save();

    //         $this->loggerData("Atualizou o candidato " . $candidato->vc_primeiro_nome . " " . $candidato->vc_ultimo_nome);
    //         return redirect()->back()->with('candidato.update.success', 1);
    //     } catch (\Throwable $th) {
    //         throw $th;
    //         dd($th);
    //         return redirect()->back()->with('candidato.update.error', 1);
    //     }
    // }





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
            $candidato = Candidato::findOrFail($id);

            Candidato::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a candidato  de id, fisciplina ($candidato->vc_primeiro_nome) ");
            return redirect()->back()->with('candidato.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('candidato.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $candidato = Candidato::findOrFail($id);
            Candidato::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a candidato  de id, candidato ($candidato->vc_primeiro_nome) ");
            return redirect()->back()->with('candidato.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('candidato.purge.error', 1);
        }
    }
}
