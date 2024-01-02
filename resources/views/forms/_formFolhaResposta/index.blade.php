<div class="row">
    <div class="form-group col-sm-6">
    <select class="form-control" name="id_candidato">
    @if(isset($candidato))
    @if(isset($folhaResposta))
        <option value="{{$folhaResposta->it_id_candidato }}">{{$folhaResposta->vc_primeiro_nome}} {{$folhaResposta->vc_ultimo_nome}}</option>

    @endif
    <option > Selecione um candidato</option>
    @foreach ($candidato as $candidatos )
        <option value="{{$candidatos->id }}"   >{{$candidatos->vc_primeiro_nome}} {{$candidatos->vc_ultimo_nome}}</option>
    @endforeach
    @else
    <option>Não existem Candidatos</option>
    @endif
    </select><br>
    </div>
    <div class="form-group col-sm-6">
    <select class="form-control" name="id_enunciado">
    @if(isset($enunciado))
    @if(isset($folhaResposta))
                <option value="{{ $folhaResposta->it_id_enunciado}}" > {{$folhaResposta->codigo}}</option>

    @endif
        <option>Selecione um enunciado</option>
        @foreach ($enunciado as $enunciados )
            <option value="{{ $enunciados->id}}" > {{$enunciados->codigo}}</option>
        @endforeach
        @else
        <option>Não existem enunciados</option>
        @endif
    </select>
    <br>
    </div>
    <div class="form-group col-sm-6">
    <select class="form-control" name="id_ano_lectivo">
    @if(isset($anoLectivo))
    @if(isset($folhaResposta))
     <option value=" {{$folhaResposta->it_id_candidato}}"   >{{$folhaResposta->ya_inicio}}- {{$folhaResposta->ya_fim}}</option>
    @else
    <option>Selecione o ano lectivo</option>
    @endif
    @foreach ($anoLectivo as $anoLectivos )
        <option value=" {{$anoLectivos->id}}"   >{{$anoLectivos->ya_inicio}}- {{$anoLectivos->ya_fim}}</option>
    @endforeach
    @else
    <option>Não existe um ano lectivo</option>
    @endif

    </select><br>

    </div>
    </div>
