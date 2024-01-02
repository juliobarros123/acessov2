<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logger;
use Illuminate\Support\Facades\Hash;
use App\Models\TipoUser;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
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
        $users = User::join('tipo_users', 'users.it_tipo_usuario', '=', 'tipo_users.id')
        ->select('users.*', 'tipo_users.nome as tipo')
        ->get();
        return view('admin.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $users = User::join('tipo_users', 'users.it_tipo_usuario', '=', 'tipo_users.id')
        ->select('users.*', 'tipo_users.nome as tipo')
        ->get();
        $tipo_users=TipoUser::all();
        return view('admin.user.create.index',['users'=>$users,'tipo_users'=>$tipo_users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request);
        $request->validate([
            'vc_primeiro_nome'=> 'required|max:255',
            'vc_nome_meio'=> 'required|max:255',
            'vc_ultimo_nome'=> 'required|max:255',
            'email'=> 'required|max:255',
            'password'=> 'required|max:255',
            'numero_bi'=> 'required|max:255',
            'tipo_user'=> 'required|max:255',
            'vc_imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'vc_primeiro_nome.required' => 'O primeiro nome do usuario é um campo obrigatório.',
            'vc_nome_meio.required' => 'O nome do meio do usuario é um campo obrigatório.',
            'vc_ultimo_nome.required' => 'O ultimo nome do usuario é um campo obrigatório.',
            'email.required' => 'O email do usuario é um campo obrigatório.',
            'password.required' => 'A password do usuario é um campo obrigatório.',
            'numero_bi.required' => 'O numero do BI do usuario é um campo obrigatório.',
            'tipo_user.required' => 'O tipo de  do usuario é um campo obrigatório.',
            'vc_imagem.required' => 'O campo de imagem é obrigatório.',
            'vc_imagem.image' => 'O arquivo enviado deve ser uma imagem.',
            'vc_imagem.mimes' => 'A imagem deve ser um dos seguintes formatos: jpeg, png, jpg ou gif.',
            'vc_imagem.max' => 'O tamanho máximo permitido para a imagem é de 2048 kilobytes.'
        ]);
        if ($request->password != $request->input('confirm-password')) {
            return redirect()->back()->with('password_mismatch', 'As senhas não correspondem');
        }  
        try {
            if (!$request->hasFile('vc_imagem') || !$request->file('vc_imagem')->isValid()) {
                return redirect()->back()->with('user.img.error',1);
            }
            //dd($request);
    
            $file = $request->file('vc_imagem');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('users/'), $fileName);
            
            $user = User::create([
                'vc_primeiro_nome' => $request->vc_primeiro_nome,
                'vc_nome_meio' => $request->vc_nome_meio,
                'vc_ultimo_nome' => $request->vc_ultimo_nome,
                'email' => $request->email,
                'vc_imagem' => $fileName,
                'password' => Hash::make($request->password),
                'numero_bi' => $request->numero_bi,
                'it_tipo_usuario' => $request->tipo_user,
            ]);          
            $this->loggerData(" Cadastrou a usuario " . $request->vc_primeiro_nome );
            return redirect()->back()->with('user.create.success',1);
         } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with('user.create.error',1);
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
        
        $users = User::join('tipo_users', 'users.it_tipo_usuario', '=', 'tipo_users.id')
        ->select('users.*', 'tipo_users.nome as tipo')
        ->get();
        $tipo_users=TipoUser::all();
        return view('admin.user.create.index',['users'=>$users,'tipo_users'=>$tipo_users]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::join('tipo_users', 'users.it_tipo_usuario', '=', 'tipo_users.id')
        ->select('users.*', 'tipo_users.nome as tipo','tipo_users.id as tipoid')
        ->findOrFail($id);
        $userImage = $user->vc_imagem; 
        $tipo_users=TipoUser::all();
        return view('admin.user.edit.index',['user'=>$user,'tipo_users'=>$tipo_users,'userImage'=>$userImage]);
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
        if ($request->password != $request->input('confirm-password')) {
            return redirect()->back()->with('password_mismatch', 'As senhas não correspondem');
        }        
        if($request->vc_imagem){
            $request->validate([
                'vc_primeiro_nome'=> 'required|max:255',
                'vc_nome_meio'=> 'required|max:255',
                'vc_ultimo_nome'=> 'required|max:255',
                'email'=> 'required|max:255',
                'password'=> 'required|max:255',
                'numero_bi'=> 'required|max:255',
                'tipo_user'=> 'required|max:255',
                'vc_imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ], [
                'vc_primeiro_nome' => 'O primeiro nome do usuario é um campo obrigatório.',
                'vc_nome_meio' => 'O nome do meio do usuario é um campo obrigatório.',
                'vc_ultimo_nome' => 'O ultimo nome do usuario é um campo obrigatório.',
                'email' => 'O email do usuario é um campo obrigatório.',
                'password' => 'A password do usuario é um campo obrigatório.',
                'numero_bi' => 'O numero do BI do usuario é um campo obrigatório.',
                'tipo_user' => 'O tipo de  do usuario é um campo obrigatório.',
                'vc_imagem.required' => 'O campo de imagem é obrigatório.',
                'vc_imagem.image' => 'O arquivo enviado deve ser uma imagem.',
                'vc_imagem.mimes' => 'A imagem deve ser um dos seguintes formatos: jpeg, png, jpg ou gif.',
                'vc_imagem.max' => 'O tamanho máximo permitido para a imagem é de 5 MB.'
            ]);
        }else{
            $request->validate([
                'vc_primeiro_nome'=> 'required|max:255',
                'vc_nome_meio'=> 'required|max:255',
                'vc_ultimo_nome'=> 'required|max:255',
                'email'=> 'required|max:255',
                'password'=> 'required|max:255',
                'numero_bi'=> 'required|max:255',
                'tipo_user'=> 'required|max:255',
            ], [
                'vc_primeiro_nome' => 'O primeiro nome do usuario é um campo obrigatório.',
                'vc_nome_meio' => 'O nome do meio do usuario é um campo obrigatório.',
                'vc_ultimo_nome' => 'O ultimo nome do usuario é um campo obrigatório.',
                'email' => 'O email do usuario é um campo obrigatório.',
                'password' => 'A password do usuario é um campo obrigatório.',
                'numero_bi' => 'O numero do BI do usuario é um campo obrigatório.',
                'tipo_user' => 'O tipo de  do usuario é um campo obrigatório.',                
            ]);
        }
        //dd($request->tipo_user);
        try {
                $user = User::findOrFail($id);            
                if ($request->hasFile('vc_imagem') && $request->file('vc_imagem')->isValid()) {
                    $file = $request->file('vc_imagem');
                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->move(public_path('users/'), $fileName);
                                       
                    $user->vc_imagem = $fileName;
                } else {
                    echo 'O arquivo não foi carregado corretamente.';
                }                                   
            $user->vc_primeiro_nome = $request->vc_primeiro_nome;
            $user->vc_nome_meio = $request->vc_nome_meio;
            $user->vc_ultimo_nome = $request->vc_ultimo_nome;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->numero_bi = $request->numero_bi;
            $user->it_tipo_usuario = $request->tipo_user;            
            $user->save();
            
    
            $this->loggerData("Atualizou o usuário " . $user->vc_primeiro_nome . " " . $user->vc_ultimo_nome);
            return redirect()->back()->with('user.update.success', 1);
        } catch (\Throwable $th) {
            throw $th;
            dd($th);
            return redirect()->back()->with('user.update.error', 1);
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
            $user = User::findOrFail($id);

            User::findOrFail($id)->delete();
            $this->loggerData(" Eliminou a user  de id, fisciplina ($user->vc_nome) ");
            return redirect()->back()->with('user.destroy.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('user.destroy.error',1);
        }
    }

    public function purge($id)
    {
        //
        try {
            //code...
            $user = User::findOrFail($id);
            User::findOrFail($id)->forceDelete();
            $this->loggerData(" Purgou a user  de id, user ($user->vc_nome) ");
            return redirect()->back()->with('user.purge.success',1);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('user.purge.error',1);
        }
    }
}
