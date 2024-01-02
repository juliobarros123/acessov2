 <div class="row">
    @if (isset($userImage))
        <div class="form-group col-sm-3">
            <img src="{{ asset('users/' . $userImage) }}" alt="{{ $user->vc_primeiro_nome }}" width="100%" height="250px">
        </div>
    @endif
</div>
<div class="row">
    <div class="form-group col-sm-4">
        <input class="form-control m-2" type="text" placeholder="Digite o seu primeiro nome " name="vc_primeiro_nome" value="{{ old('vc_primeiro_nome', isset($user->vc_primeiro_nome) ? $user->vc_primeiro_nome : '') }}"  required>
        <input class="form-control m-2" type="text" placeholder="Digite o seu nome do meio" name="vc_nome_meio" value="{{ old('vc_nome_meio', isset($user->vc_nome_meio) ? $user->vc_nome_meio : '') }}"  required>
        <input class="form-control m-2" type="text" placeholder="Digite o seu ultimo nome " name="vc_ultimo_nome" value="{{ old('vc_ultimo_nome', isset($user->vc_ultimo_nome) ? $user->vc_ultimo_nome : '') }}" required>
    </div>
    
    <div class="form-group col-sm-4">
        <input class="form-control m-2" type="file" placeholder="" name="vc_imagem"  {{isset($userImage)?:'required'}}>
        <input class="form-control m-2" type="email" placeholder="Digite o seu E-mail" name="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required>
        <input class="form-control m-2" type="text" placeholder="Digite o numero do BI" name="numero_bi" value="{{ old('numero_bi', isset($user->numero_bi) ? $user->numero_bi : '') }}" required>
    </div>

    <div class="form-group col-sm-4">
        <input class="form-control m-2" type="password" min="6" placeholder="Digite a sua palavra passe" name="password"  {{isset($user->password)?'':'required'}} value="{{ old('password') }}">
        <input class="form-control m-2" type="password" min="6" placeholder="Confirma a sua palavra passe" name="confirm-password"  {{isset($user->password)?'':'required'}} value="{{ old('confirm-password') }}">
        
        <select name="tipo_user" id="" class="form-control m-2">
            @if(isset($user->tipo))
                <option value="{{$user->tipoid}}" selected>{{$user->tipo}}</option>
            @endif
            @foreach ($tipo_users as $tipo_user)
                <option value="{{isset($tipo_user->id) ? $tipo_user->id : ''}}" {{ old('tipo_user') == isset($tipo_user->id) ? 'selected' : '' }}>{{$tipo_user->nome}}</option>
            @endforeach 
        </select>
    </div>
</div>
