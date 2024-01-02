<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Logger;

class CursoController extends Controller
{
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
    public function index()
    {
        //
        $data['cursos'] = Curso::all();

        //dd($data['cursos']);
        $this->loggerData("Listou cursos");

        return view('admin.curso.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.curso.create.index');
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
            // dd($request);
            if ($this->curso_existe($request->vc_nome)) {
                return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Curso existe!']);
            }
            Curso::create($request->all());
            $this->loggerData(" Cadastrou curso " . $request->vc_name);
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Curso cadastrado com sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao cadastrar curso!']);
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
        $response['cursos'] = Curso::all();
        return view('admin.curso.edit.index', $response);
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
        $response["curso"] = Curso::find($id);

        return view('admin.curso.edit.index', $response);
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
        
            Curso::findOrFail($id)->update($request->all());
            $this->loggerData(" Editou  o curso $request->vc_nome ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Curso actualizado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao cadastrado curso!']);
        }
    }
    public function curso_existe($curso)
    {
        return Curso::where('vc_nome', $curso)->count();
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
            $curso = Curso::findOrFail($id);

            Curso::findOrFail($id)->delete();
            $this->loggerData(" Eliminou curso com o nome ($curso->vc_name) ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Curso elimanado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao eliminar curso!']);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $curso = Curso::findOrFail($id);

            Curso::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou curso com o nome ($curso->vc_name) ");
            return redirect()->back()->with('feedback', ['type' => 'success', 'sms' => 'Curso elimanado com sucesso!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('feedback', ['type' => 'error', 'sms' => 'Erro ao purgar curso!']);
        }
    }
}
