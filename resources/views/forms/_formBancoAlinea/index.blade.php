<div class="row" style="" >

    <div class="col-md-12">
        <label for="it_id_banco_pergunta">Perguntas</label>
        <select name="it_id_banco_pergunta" class="form-control" id="it_id_banco_pergunta" required>
            @if (isset($banco_alinea->it_id_banco_pergunta))
                <option value="{{ $banco_alinea->it_id_banco_pergunta }}" class="form-control" selected>
                    {{ $banco_alinea->vc_descricao_bp }}</option>
            @else
                {{-- <option selected disabled>Selecciona a pergunta</option> --}}
            @endif
            @foreach ($banco_perguntas as $bpergunta)
                <option value="{{ $bpergunta->id }}" class="form-control">{{ $bpergunta->vc_descricao_bp }}</option>
            @endforeach
        </select>

    </div>
    <div class="form-group col-md-4" hidden >
        <label for="">Chave</label>
        <select type="int" name="chave" class="form-control" >
            @if (isset($banco_alinea->chave))
                <option value="{{ $banco_alinea->chave }}" selected>
                    {{ $banco_alinea->chave == 1 ? 'Verdadeiro' : 'Falso' }}
                </option>
            @endif
            <option class="form-control" value="0">Falso</option>
            @if ($v)
                <option class="form-control" value="1">
                    Verdadeiro</option>
            @else
                <option disabled class="form-control" value="1">
                    Verdadeiro</option>
            @endif
        </select>

    </div>
    <div class="col-md-4" hidden>
        <label for="">Alinea</label>
        <textarea type="textarea" class="form-control" placeholder="Digite a descrição da alínea" name="description" >{{ isset($banco_alinea->description) ? $banco_alinea->description : '' }}</textarea>
    </div>

</div>
