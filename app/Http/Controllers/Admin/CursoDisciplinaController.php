<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\CursoDisciplina;
use App\Models\Disciplina;
use App\Models\Logger;

class CursoDisciplinaController extends Controller
{
    //
    //
    //
    private $Logger;
    public function __construct()
    {

        $this->Logger = new Logger();
    }
    public function loggerData($mensagem)
    {

        $this->Logger->Log('info', $mensagem);
    }
    //
    public function vincular($id_curso)
    {
        // dd($id_curso);
        $response['curso'] = Curso::find($id_curso);
        $response['disciplinas']= Disciplina::all();
        // dd( $response['curso'] );
        return view('admin.curso-disciplina.vincular.index', $response);
    }
    public function index()
    {
        //
        // dd("ola");
        $data['cursos_disciplinas'] = fh_cursos_disciplinas()->get();
        // dd($data['cursos_disciplinas']);
        $this->loggerData("Listou vinculação de curso com disciplina");

        return view('admin.curso-disciplina.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.curso-disciplina.create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
            // dd($this->vinculo_existe($request->except(['_token'])));
            if ($this->vinculo_existe($request->except(['_token']))) {
                return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Vinculação de curso com disciplina já existe!']);
            }
            CursoDisciplina::create($request->all());
            $this->loggerData(" Vinculou curso com disciplina ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Vínculo cadastrada com sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao víncular curso com disciplina!!']);
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
        $response['cursos'] = CursoDisciplina::all();
        return view('admin.curso-disciplina.edit.index', $response);
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
        $response["curso_disciplina"] = fh_cursos_disciplinas()->find($id);
        $response['disciplinas']= Disciplina::all();

// dd(  $response["curso_disciplina"]);

        return view('admin.curso-disciplina.edit.index', $response);
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


        try {
            //code...
            // dd($request->all());
            if ($this->curso_existe($request->vc_nome)) {
                // dd("o");
                return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Curso existe!']);
            }

            CursoDisciplina::findOrFail($id)->update($request->all());
            $this->loggerData(" Editou  o curso $request->vc_nome ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Curso actualizado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao cadastrado curso!']);
        }
    }
    public function vinculo_existe($vinculo)
    {
        return CursoDisciplina::where($vinculo)->count();
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
            $curso = CursoDisciplina::findOrFail($id);
            $curso_disciplina = fh_cursos_disciplinas()->find($id);
            CursoDisciplina::findOrFail($id)->delete();
            $this->loggerData(" Eliminou vínculo do curso $curso_disciplina->curso com disciplina $curso_disciplina->disciplina ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Vínculo eliminado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao eliminar vínculo!']);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $curso = CursoDisciplina::findOrFail($id);
            $curso_disciplina = fh_cursos_disciplinas()->find($id);
            CursoDisciplina::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou vínculo do curso $curso_disciplina->curso com disciplina $curso_disciplina->disciplina ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Vínculo Purgoda com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao Purgoda vínculo!']);
        }
    }
}
