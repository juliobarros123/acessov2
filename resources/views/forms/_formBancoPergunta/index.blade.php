<div class="row">

    <div class="form-group col-sm-4">
        <label for="">Pergunta</label>
        <input type="text" required placeholder="Digite a pergunta" class="form-control" name="vc_descricao_bp"
            min="1" max="20"value="{{ isset($data->vc_descricao_bp) ? $data->vc_descricao_bp : '' }}">
        @if ($errors->has('vc_descricao_bp'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('vc_descricao_bp') }}.</small>
        @endif
    </div>
    <div class="form-group col-sm-4">
        <label for="">Cotacao</label>
        <input type="number" required placeholder="Digite a Cotaçao" class="form-control" name="it_cotacao"
            min="1" max="20"value="{{ isset($data->it_cotacao) ? $data->it_cotacao : '' }}">
        @if ($errors->has('it_cotacao'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('it_cotacao') }}.</small>
        @endif
    </div>
    <div class="form-group col-sm-4">
        <label for="" class="form-label">Ano Letivo</label>
        <select required name="it_id_ano_lectivo" class="form-control">
            @if (isset($data->it_cotacao))
                <option value="{{ $data->it_id_ano_lectivo }}" selected>{{ $data->ya_inicio }} - {{ $data->ya_fim }}
                </option>
            @endif
            @foreach ($ano as $d)
                <option value="{{ isset($d->id) ? $d->id : '' }}">{{ $d->ya_inicio }} - {{ $d->ya_fim }}</option>
            @endforeach
        </select>
        @if ($errors->has('it_id_ano_lectivo'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('it_id_ano_lectivo') }}.</small>
        @endif
    </div>
    <div class="form-group col-sm-4">
        <label for="" class="form-label">Disciplina</label>
        <select required name="it_id_disciplina" class="form-control">
            @if (isset($data->it_cotacao))
                <option value="{{ $data->it_id_disciplina }}" selected>{{ $data->vc_nome }}</option>
            @endif
            @foreach ($disciplinas as $disciplina)
                <option value="{{ isset($disciplina->id) ? $disciplina->id : '' }}">{{ $disciplina->vc_nome }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('it_id_disciplina'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('it_id_disciplina') }}.</small>
        @endif
    </div>
    <div class="form-group col-sm-4">
        <label for="">Imagem:</label>
        <input type="file"   class="form-control" name="vc_imagem_bp"
            min="1" max="20"value="{{ isset($data->vc_imagem_bp) ? $data->vc_imagem_bp : '' }}">
        @if ($errors->has('vc_imagem_bp'))
            <small id="emailHelp" class="form-text text-danger"> {{ $errors->first('vc_imagem_bp') }}.</small>
        @endif
    </div>
</div>
